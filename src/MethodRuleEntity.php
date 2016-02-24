<?php
namespace Codestyle;

use \PHPMD\AbstractRule;
use \PHPMD\Rule\MethodAware;
use \PHPMD\AbstractNode;
class MethodRuleEntity extends AbstractRule implements MethodAware
{
	/**
	 * @inheritdoc
	 */
	public function apply(AbstractNode $node) {
		// noop
	}
}