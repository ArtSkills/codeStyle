<?php
namespace ArtSkills\Test;
class VariableTest extends AppTest
{
	public function testCamelCaseVariable() {
		$res = $this->executePhpmd('Variable/CamelCaseVariableName.php', 'Variable/CamelCaseVariableName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase переменных: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Variable/CamelCaseVariableNameBad.php', 'Variable/CamelCaseVariableName.xml');
		$this->assertEquals(10, $res['count'], 'Ошибки при проверке некорректных camelCase переменных: ' . var_export($res['messages'], true));
	}

	public function testDeprecateGlobalVariable() {
		$res = $this->executePhpmd('Variable/DeprecateGlobalVariable.php', 'Variable/DeprecateGlobalVariable.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке глобальных переменных: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Variable/DeprecateGlobalVariableBad.php', 'Variable/DeprecateGlobalVariable.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректной глобальной переменной: ' . var_export($res['messages'], true));
	}
}