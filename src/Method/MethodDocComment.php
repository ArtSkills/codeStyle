<?php
namespace ArtSkills\CodeStyle\Method;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\MethodRuleEntity;

class MethodDocComment extends MethodRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к методам
	 *
	 * @param AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$this->checkDocComment($node);
	}
}