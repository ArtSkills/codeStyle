<?php
namespace Codestyle\Variable;

use PHPMD\AbstractNode;
use Codestyle\VariableRuleEntity;

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
