<?php
namespace ArtSkills\CodeStyle\Property;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\ClassRuleEntity;

final class CamelCasePropertyName extends ClassRuleEntity
{
	/**
	 * Проверка на именование методов
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$fieldDeclarations = $node->findChildrenOfType('FieldDeclaration');
		foreach ($fieldDeclarations as $fieldDeclaration) {
			/** @noinspection PhpUndefinedMethodInspection */
			$isPublic = $fieldDeclaration->isPublic();
			$variableDeclarators = $fieldDeclaration->findChildrenOfType('VariableDeclarator');
			foreach ($variableDeclarators as $variableDeclarator) {
				$propertyName = $variableDeclarator->getName();

				if ($isPublic) {
					$pattern = '/^\$[a-z][a-zA-Z]*$/';
				} else {
					$pattern = '/^\$\_[a-z][a-zA-Z]*$/';
				}

				if (!preg_match($pattern, $propertyName)) {
					if ($this->checkPropertyForCakeException($variableDeclarator, $fieldDeclaration, $node)) {
						continue;
					}

					$this->addViolation($variableDeclarator, [$propertyName,]);
				}
			}
		}
	}
}
