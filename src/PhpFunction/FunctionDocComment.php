<?php
namespace ArtSkills\CodeStyle\PhpFunction;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\FunctionRuleEntity;

class FunctionDocComment extends FunctionRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к функциям
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		if (!strlen($node->getDocComment())) {
			$this->addViolation($node, [$node->getName(),]);
		}
	}
}