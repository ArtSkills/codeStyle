<?php
namespace Codestyle\Property;

use \PHPMD\AbstractNode;
use \PDepend\Source\AST\ASTProperty;
use Codestyle\ClassRuleEntity;

class PropertyDocComment extends ClassRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к свойствам
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$fieldDeclarations = $node->findChildrenOfType('FieldDeclaration');
		foreach ($fieldDeclarations as $fieldDeclaration) {
			$variableDeclarators = $fieldDeclaration->findChildrenOfType('VariableDeclarator');
			foreach ($variableDeclarators as $variableDeclarator) {
				$property = $this->createPropertyFromDeclarator($variableDeclarator, $fieldDeclaration, $node);
				$propertyComment = $property->getDocComment();
				if (!strlen($propertyComment)) {
					$this->addViolation($node, [$property->getName(),]);
				} else {
					if (stristr($propertyComment, '@inheritdoc')) { // не проверяем наследование коммента
						continue;
					}

					$propertyType = $this->getPropertyTypeFromComments($propertyComment);
					if (!strlen($propertyType)) { // комментарий есть, а тип не указан
						$this->addViolation($variableDeclarator, [$property->getName(),]);
					}
				}
			}
		}
	}
}