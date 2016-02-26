<?php
namespace ArtSkills\CodeStyle;

use PHPMD\AbstractNode;
use PHPMD\AbstractRule;
use PHPMD\Rule\ClassAware;
use PDepend\Source\AST\ASTProperty;

class ClassRuleEntity extends AbstractRule implements ClassAware
{
	const PHPDOC_PROPERTY_TYPE_EXPRESSION = '/\@var\s([a-zA-Z0-9\\\]+)/'; // описание типа к комментарию свойсва
	const CAKEPHP_OBJECT_NAME_EXPRESSION = '/^\$[A-Z][a-zA-Z]+$/'; // именование объектов CakePHP

	/**
	 * @inheritdoc
	 */
	public function apply(AbstractNode $node) {
		// noop
	}

	/**
	 * Выцепляем из PHPDoc комментария тип переменной
	 *
	 * @param string $propComments
	 * @return bool|string
	 */
	protected function getPropertyTypeFromComments($propComments) {
		if (strlen($propComments) && preg_match(self::PHPDOC_PROPERTY_TYPE_EXPRESSION, $propComments, $matches)) {
			return $matches[1];
		} else {
			return false;
		}
	}

	/**
	 * Формирует список классов-исключений CakePHP, для которых не действуют проверки PHPMD
	 *
	 * @param string $propertyName
	 * @return array
	 */
	protected function buildCakePropertyExceptions($propertyName) {
		$string = mb_substr($propertyName, 1);
		return [
			$string,
			$string . 'Helper',
			$string . 'Component',
			$string . 'Table',
		];
	}

	/**
	 * Проверка на объект CakePHP $CatalogItem и т.п. - их явно ссылают на класс
	 *
	 * @param \PHPMD\AbstractNode $variableDeclarator
	 * @param \PHPMD\AbstractNode $fieldDeclaration
	 * @param \PHPMD\AbstractNode $class
	 * @return bool
	 */
	protected function checkPropertyForCakeException($variableDeclarator, $fieldDeclaration, $class) {
		$property = $this->createPropertyFromDeclarator($variableDeclarator, $fieldDeclaration, $class);
		$propertyName = $property->getName();
		if (!preg_match(self::CAKEPHP_OBJECT_NAME_EXPRESSION, $propertyName)) {
			return false;
		}

		$className = $this->getPropertyTypeFromComments($property->getDocComment());
		if (strlen($className)) {
			if (strstr($className, "\\")) {
				$stringArr = explode("\\", $className);
				$className = $stringArr[count($stringArr) - 1];
			}

			$testClassList = $this->buildCakePropertyExceptions($propertyName);
			return in_array($className, $testClassList);
		} else {
			return false;
		}
	}

	/**
	 * Создаём объект свойства ASTProperty
	 *
	 * @param \PHPMD\AbstractNode $variableDeclarator
	 * @param \PHPMD\AbstractNode $fieldDeclaration
	 * @param \PHPMD\AbstractNode $class
	 * @return ASTProperty
	 */
	protected function createPropertyFromDeclarator($variableDeclarator, $fieldDeclaration, $class) {
		$property = new ASTProperty($fieldDeclaration->getNode(), $variableDeclarator->getNode());
		$property->setDeclaringClass($class->getNode());
		$property->setCompilationUnit($class->getCompilationUnit());
		return $property;
	}
}