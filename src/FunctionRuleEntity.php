<?php
namespace ArtSkills\CodeStyle;

use \PHPMD\AbstractRule;
use \PHPMD\Rule\FunctionAware;
use \PHPMD\AbstractNode;

class FunctionRuleEntity extends AbstractRule implements FunctionAware
{
	/**
	 * @inheritdoc
	 */
	public function apply(AbstractNode $node) {
		// noop
	}
}