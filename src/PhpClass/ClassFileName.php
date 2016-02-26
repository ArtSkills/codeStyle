<?php
namespace ArtSkills\CodeStyle\PhpClass;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\ClassRuleEntity;

class ClassFileName extends ClassRuleEntity
{
	/**
	 * Класс должен находиться в файле с таким же именем
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$fNameArr = explode('/', $node->getFileName());
		if ($node->getName() . '.php' != $fNameArr[count($fNameArr) - 1]) {
			$this->addViolation($node, [$node->getName(),]);
		}
	}
}