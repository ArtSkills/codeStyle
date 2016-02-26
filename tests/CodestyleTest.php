<?php

class CodestyleTest extends PHPUnit_Framework_TestCase
{
	const PHPMD_RELATIVE_PATH = '/../bin/'; // относительный путь от этого файла к запускаемому скрипту phpmd

	/**
	 * Запуск файла $testFile на проверку по правилу $testRule
	 *
	 * @param string $testFile
	 * @param string $testRule
	 * @return array ['count' => <кол-во сообщений>, 'messages' => <массив строк результата от phpmd>]
	 */
	private function _executePhpmd($testFile, $testRule) {
		$curDir = dirname(__FILE__);

		exec('"'.$curDir . '/../vendor/bin/phpmd" "' . $curDir . '/Samples/' . $testFile . '" text "' . $curDir . '/Samples/' . $testRule.'"', $execOutput);
		$outputSize = count($execOutput) - 1;
		return [
			'count' => $outputSize < 0 ? 0 : $outputSize,
			'messages' => $execOutput,
		];
	}

	public function testCamelCaseMethod() {
		$res = $this->_executePhpmd('Method/CamelCaseMethodName.php', 'Method/CamelCaseMethodName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase методов: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Method/CamelCaseMethodNameBad.php', 'Method/CamelCaseMethodName.xml');
		$this->assertEquals(8, $res['count'], 'Ошибки при проверке некорректных camelCase методов: ' . var_export($res['messages'], true));
	}

	public function testCamelCaseProperty() {
		$res = $this->_executePhpmd('Property/CamelCasePropertyName.php', 'Property/CamelCasePropertyName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase свойств: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Property/CamelCasePropertyNameBad.php', 'Property/CamelCasePropertyName.xml');
		$this->assertEquals(8, $res['count'], 'Ошибки при проверке некорректных camelCase свойств: ' . var_export($res['messages'], true));
	}

	public function testCamelCaseVariable() {
		$res = $this->_executePhpmd('Variable/CamelCaseVariableName.php', 'Variable/CamelCaseVariableName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase переменных: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Variable/CamelCaseVariableNameBad.php', 'Variable/CamelCaseVariableName.xml');
		$this->assertEquals(10, $res['count'], 'Ошибки при проверке некорректных camelCase переменных: ' . var_export($res['messages'], true));
	}

	public function testPublicProperty() {
		$res = $this->_executePhpmd('Property/DeprecatePublicProperty.php', 'Property/DeprecatePublicProperty.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке публичных свойств: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Property/DeprecatePublicPropertyBad.php', 'Property/DeprecatePublicProperty.xml');
		$this->assertEquals(2, $res['count'], 'Ошибки при проверке некорректных публичных свойств: ' . var_export($res['messages'], true));
	}

	public function testMethodMix() {
		$res = $this->_executePhpmd('Method/DeprecateMethodMix.php', 'Method/DeprecateMethodMix.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке обычных/абстрактных публичных методов: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Method/DeprecateMethodMixBad.php', 'Method/DeprecateMethodMix.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректных обычных/абстрактных публичных методов: ' . var_export($res['messages'], true));
	}

	public function testMethodDoc() {
		$res = $this->_executePhpmd('Method/MethodDocComment.php', 'Method/MethodDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к методу: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Method/MethodDocCommentBad.php', 'Method/MethodDocComment.xml');
		$this->assertEquals(7, $res['count'], 'Ошибки при проверке некорректного комментария к методу: ' . var_export($res['messages'], true));
	}

	public function testPropertyDoc() {
		$res = $this->_executePhpmd('Property/PropertyDocComment.php', 'Property/PropertyDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к свойству: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Property/PropertyDocCommentBad.php', 'Property/PropertyDocComment.xml');
		$this->assertEquals(4, $res['count'], 'Ошибки при проверке некорректного комментария к свойству: ' . var_export($res['messages'], true));
	}

	public function testFunctionDoc() {
		$res = $this->_executePhpmd('PhpFunction/FunctionDocComment.php', 'PhpFunction/FunctionDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к функции: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('PhpFunction/FunctionDocCommentBad.php', 'PhpFunction/FunctionDocComment.xml');
		$this->assertEquals(6, $res['count'], 'Ошибки при проверке некорректного комментария к функции: ' . var_export($res['messages'], true));
	}

	public function testClassName() {
		$res = $this->_executePhpmd('PhpClass/ClassFileName.php', 'PhpClass/ClassFileName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке расположения класса: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('PhpClass/ClassFileNameBad.php', 'PhpClass/ClassFileName.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректного расположения класса: ' . var_export($res['messages'], true));
	}

	public function testUpperCaseConstant() {
		$res = $this->_executePhpmd('PhpClass/UpperCaseConstantName.php', 'PhpClass/UpperCaseConstantName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке имени константы: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('PhpClass/UpperCaseConstantNameBad.php', 'PhpClass/UpperCaseConstantName.xml');
		$this->assertEquals(3, $res['count'], 'Ошибки при проверке некорректного имени констант: ' . var_export($res['messages'], true));
	}

	public function testDeprecateGlobalVariable() {
		$res = $this->_executePhpmd('Variable/DeprecateGlobalVariable.php', 'Variable/DeprecateGlobalVariable.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке глобальных переменных: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Variable/DeprecateGlobalVariableBad.php', 'Variable/DeprecateGlobalVariable.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректной глобальной переменной: ' . var_export($res['messages'], true));
	}

	public function testPropertyInitialize() {
		$res = $this->_executePhpmd('Property/PropertyInitialize.php', 'Property/PropertyInitialize.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке инициализации свойств: ' . var_export($res['messages'], true));

		$res = $this->_executePhpmd('Property/PropertyInitializeBad.php', 'Property/PropertyInitialize.xml');
		$this->assertEquals(3, $res['count'], 'Ошибки при проверке некорректной инициализации свойств: ' . var_export($res['messages'], true));
	}
}