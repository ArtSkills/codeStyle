<?php
namespace ArtSkills\CodeStyle\Variable;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\VariableRuleEntity;

class DeprecateGlobalVariable extends VariableRuleEntity
{
	/**
	 * Глобальные переменные запрещены
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		foreach ($node->findChildrenOfType('GlobalStatement') as $globalVariable) {
			$this->addViolation($globalVariable, [$node->getName()]);
		}
	}
}
