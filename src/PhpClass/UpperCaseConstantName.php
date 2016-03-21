<?php
namespace ArtSkills\CodeStyle\PhpClass;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\ClassRuleEntity;


class UpperCaseConstantName extends ClassRuleEntity
{
	/**
	 * Имена всех констант должны быть в верхнем регистре с символом подчёркивания
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		foreach ($node->findChildrenOfType('ConstantDeclarator') as $constant) {
			$constantName = $constant->getImage();

			if (!preg_match('/^[A-Z][A-Z\_0-9]+$/', $constantName)) {
				$this->addViolation($constant, [$constantName]);
			}
		}
	}
}