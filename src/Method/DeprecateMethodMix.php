<?php
namespace Codestyle\Method;

use \PHPMD\AbstractNode;
use \PDepend\Source\AST\ASTMethod;
use Codestyle\ClassRuleEntity;


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
		$hasPublicStaticMethods = false;
		$hasPublicMethods = false;
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
					$hasPublicStaticMethods = true;
				}
				else {
					$hasPublicMethods = true;
				}
			}
		}

		if ($hasPublicStaticMethods && $hasPublicMethods) {
			$this->addViolation($node, [$node->getName(),]);
		}
	}
}