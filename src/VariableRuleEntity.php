<?php
namespace Codestyle;

use \PHPMD\AbstractRule;
use \PHPMD\Rule\MethodAware;
use \PHPMD\Rule\FunctionAware;
use \PHPMD\AbstractNode;

class VariableRuleEntity extends AbstractRule implements MethodAware, FunctionAware
{
	/**
	 * @inheritdoc
	 */
	public function apply(AbstractNode $node) {
		// noop
	}
}