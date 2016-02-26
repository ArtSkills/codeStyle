<?php
namespace ArtSkills\CodeStyle\Variable;

use PDepend\Source\AST\ASTVariable;
use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\VariableRuleEntity;
use PDepend\Source\AST\ASTParameter;
use PDepend\Source\AST\ASTNode;
use PDepend\Source\AST\ASTPropertyPostfix;
use PDepend\Source\AST\ASTArrayIndexExpression;
use PDepend\Source\AST\ASTFormalParameter;
use PDepend\Source\AST\AbstractASTCallable;

class CamelCaseVariableName extends VariableRuleEntity
{
	/**
	 * Список исключений
	 *
	 * @var array
	 */
	private $_exceptions = [
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
			/**
			 * @var ASTVariable $pdNode
			 */
			$pdNode = $variable->getNode();
			if (!$this->_checkVariable($variable->getImage(), $pdNode->getParent())) {
				$this->addViolation($variable, [$variable->getImage()]);
			}
		}

		// параметры
		$formalParameters = $node->findChildrenOfType('FormalParameter');
		if (count($formalParameters)) {
			$parPos = 0;
			foreach ($formalParameters as $formalParameter) {
				/**
				 * @var ASTFormalParameter $formalNode
				 */
				$formalNode = $formalParameter->getNode();
				/**
				 * @var AbstractASTCallable $pdNode
				 */
				$pdNode = $node->getNode();
				$parameter = new ASTParameter($formalNode);
				$parameter->setDeclaringFunction($pdNode);
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
	 * @param string $variableName
	 * @param ASTNode|null $parentNode
	 * @return bool|int
	 */
	private function _checkVariable($variableName, ASTNode $parentNode = null) {
		if (in_array($variableName, $this->_exceptions)) {
			return true;
		}

		$localVarExpression = '/^\$[a-z][a-zA-Z]*$/';
		if ($parentNode) {
			if ($parentNode instanceof ASTPropertyPostfix) {
				$exp = '/^\$\_[a-z][a-zA-Z]*$/';
			} elseif ($parentNode instanceof ASTArrayIndexExpression) { // Foo::$_bar[$index] - не проверяем, т.к. в такой наркомании не получишь типа
				return true;
			} else {
				$exp = $localVarExpression;
			}
		} else {
			$exp = $localVarExpression;
		}

		$result = preg_match($exp, $variableName);
		return $result;
	}
}
