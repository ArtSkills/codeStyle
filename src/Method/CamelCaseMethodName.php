<?php
namespace ArtSkills\CodeStyle\Method;

use \PHPMD\AbstractNode;
use ArtSkills\CodeStyle\MethodRuleEntity;

class CamelCaseMethodName extends MethodRuleEntity
{
	/**
	 * Не проверяем их
	 *
	 * @var array
	 */
	private $_ignoredMethods = [
		'__construct',
		'__destruct',
		'__set',
		'__get',
		'__call',
		'__callStatic',
		'__isset',
		'__unset',
		'__sleep',
		'__wakeup',
		'__toString',
		'__invoke',
		'__set_state',
		'__clone',
		'__debugInfo',
	];


	/**
	 * Проверка на CamelCase именование методов, приватные начинаются с одного "_"
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$methodName = $node->getName();
		if (!in_array($methodName, $this->_ignoredMethods)) {
			$isPrivate = $node->isPrivate();
			if ($isPrivate) {
				$exp = '/^\_[a-z][a-zA-Z]*$/';

			} else {
				$exp = '/^[a-z][a-zA-Z]+$/';
			}

			if (!preg_match($exp, $methodName)) {
				$this->addViolation($node, [$methodName,]);
			}
		}
	}
}