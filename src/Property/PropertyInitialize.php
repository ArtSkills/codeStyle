<?php
namespace ArtSkills\CodeStyle\Property;

use PHPMD\AbstractNode;
use PDepend\Source\AST\ASTProperty;
use ArtSkills\CodeStyle\ClassRuleEntity;

class PropertyInitialize extends ClassRuleEntity
{
	/**
	 * Проверка на обязательную инициализацию свойств
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
				if (!$property->isDefaultValueAvailable()) {
					$this->addViolation($variableDeclarator, [$property->getName(),]);
				}
			}
		}
	}
}