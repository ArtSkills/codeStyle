<?php
namespace ArtSkills\CodeStyle\Method;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\MethodRuleEntity;

class MethodDocComment extends MethodRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к методам
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