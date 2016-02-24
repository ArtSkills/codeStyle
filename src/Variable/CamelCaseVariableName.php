<?php
namespace Codestyle\Variable;

use PHPMD\AbstractNode;
use Codestyle\VariableRuleEntity;
use PDepend\Source\AST\ASTParameter;

class CamelCaseVariableName extends VariableRuleEntity
{
	/**
	 * Список уже прошедших проверку переменных
	 *
	 * @var array
	 */
	private static $_testedVariableList = [];

	/**
	 * @var array
	 */
	private $exceptions = [
		'$php_errormsg',
		'$http_response_header',
		'$GLOBALS',
		'$_SERVER',
		'$_GET',
		'$_POST',
		'$_FILES',
		'$_COOKIE',
		'$_SESSION',
		'$_REQUEST',
		'$_ENV',
		'$i',
		'$j',
		'$k',
	];

	/**
	 * Проверка переменных и статических свойств
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		// переменные
		foreach ($node->findChildrenOfType('Variable') as $variable) {
			if (!$this->_checkVariable($variable->getImage(), $variable->getNode()->getParent())) {
				$this->addViolation($variable, [$variable->getImage()]);
			}
		}

		// параметры
		$formalParameters = $node->findChildrenOfType('FormalParameter');
		if (count($formalParameters)) {
			$parPos = 0;
			foreach ($formalParameters as $formalParameter) {
				$parameter = new ASTParameter($formalParameter->getNode());
				$parameter->setDeclaringFunction($node->getNode());
				$parameter->setPosition($parPos++);


				if (!$this->_checkVariable($parameter->getName())) {
					$this->addViolation($formalParameter, [$parameter->getName()]);
				}
			}
		}
	}

	/**
	 * Проверка имени переменной на CamelCase
	 *
	 * @param $variableName
	 * @param \PDepend\Source\AST\ASTNode|null $parentNode
	 * @return bool|int
	 */
	private function _checkVariable($variableName, \PDepend\Source\AST\ASTNode $parentNode = null) {
		if (in_array($variableName, $this->exceptions)) {
			return true;
		}

		if (isset(self::$_testedVariableList[$variableName])) {
			return self::$_testedVariableList[$variableName];
		}

		$localVarExpression = '/^\$[a-z][a-zA-Z]*$/';
		if ($parentNode) {
			if ($parentNode instanceof \PDepend\Source\AST\ASTPropertyPostfix) {
				$exp = '/^\$\_[a-z][a-zA-Z]*$/';
			} elseif ($parentNode instanceof \PDepend\Source\AST\ASTArrayIndexExpression) { // Foo::$_bar[$index] - не проверяем, т.к. в такой наркомании не получишь типа
				return true;
			} else {
				$exp = $localVarExpression;
			}
		} else {
			$exp = $localVarExpression;
		}

		$result = preg_match($exp, $variableName);
		self::$_testedVariableList[$variableName] = $result;
		return $result;
	}
}
