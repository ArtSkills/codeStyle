<?php
namespace ArtSkills\CodeStyle\Method;

use \PHPMD\AbstractNode;
use \PDepend\Source\AST\ASTMethod;
use ArtSkills\CodeStyle\ClassRuleEntity;


class DeprecateMethodMix extends ClassRuleEntity
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
		'getInstance',
	];

	/**
	 * Запрет на наличие в одном классе абстрактных и обычных публичных методов
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$hasStaticMethods = false;
		$hasPublicMethods = false;
		/** @noinspection PhpUndefinedMethodInspection */
		$methods = $node->getNode()->getMethods();

		/**
		 * @var ASTMethod $method
		 */
		foreach ($methods as $method) {
			if (in_array($method->getName(), $this->_ignoredMethods)) {
				continue;
			}

			if ($method->isPublic()) {
				if ($method->isStatic()) {
					$hasStaticMethods = true;
				}
				else {
					$hasPublicMethods = true;
				}
			}
		}

		if ($hasStaticMethods && $hasPublicMethods) {
			$this->addViolation($node, [$node->getName(),]);
		}
	}
}