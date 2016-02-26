<?php
namespace ArtSkills\CodeStyle;

use PHPMD\AbstractRule;
use PHPMD\Node\ClassNode;
use PHPMD\Rule\ClassAware;
use PDepend\Source\AST\ASTProperty;
use PDepend\Source\AST\ASTFieldDeclaration;
use PDepend\Source\AST\ASTVariableDeclarator;
use PDepend\Source\AST\ASTClass;

abstract class ClassRuleEntity extends AbstractRule implements ClassAware
{
	const PHPDOC_PROPERTY_TYPE_EXPRESSION = '/\@var\s([a-zA-Z0-9\\\]+)/'; // описание типа к комментарию свойсва
	const CAKEPHP_OBJECT_NAME_EXPRESSION = '/^\$[A-Z][a-zA-Z]+$/'; // именование объектов CakePHP

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

		$className = $this->getPropertyTypeFromComments($property->getComment());
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
		/**
		 * @var ASTFieldDeclaration $fieldNode
		 * @var ClassNode $class
		 */
		$fieldNode = $fieldDeclaration->getNode();
		/**
		 * @var ASTVariableDeclarator $variableNode
		 */
		$variableNode = $variableDeclarator->getNode();
		$property = new ASTProperty($fieldNode, $variableNode);

		/**
		 * @var $classNode ASTClass
		 */
		$classNode = $class->getNode();
		$property->setDeclaringClass($classNode);
		/** @noinspection PhpUndefinedMethodInspection */
		$property->setCompilationUnit($class->getCompilationUnit());
		return $property;
	}
}