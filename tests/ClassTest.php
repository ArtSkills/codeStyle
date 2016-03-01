<?php
namespace ArtSkills\Test;
class ClassTest extends AppTest
{
	public function testClassName() {
		$res = $this->executePhpmd('PhpClass/ClassFileName.php', 'PhpClass/ClassFileName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке расположения класса: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('PhpClass/ClassFileNameBad.php', 'PhpClass/ClassFileName.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректного расположения класса: ' . var_export($res['messages'], true));
	}

	public function testUpperCaseConstant() {
		$res = $this->executePhpmd('PhpClass/UpperCaseConstantName.php', 'PhpClass/UpperCaseConstantName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке имени константы: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('PhpClass/UpperCaseConstantNameBad.php', 'PhpClass/UpperCaseConstantName.xml');
		$this->assertEquals(3, $res['count'], 'Ошибки при проверке некорректного имени констант: ' . var_export($res['messages'], true));
	}
}