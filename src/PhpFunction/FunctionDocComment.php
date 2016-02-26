<?php
namespace ArtSkills\CodeStyle\PhpFunction;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\FunctionRuleEntity;
use phpDocumentor\Reflection\DocBlock;

class FunctionDocComment extends FunctionRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к функциям
	 *
	 * @param AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$this->checkDocComment($node);
	}
}