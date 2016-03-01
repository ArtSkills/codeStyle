<?php
namespace ArtSkills\Test;
class FunctionTest extends AppTest
{
	public function testFunctionDoc() {
		$res = $this->executePhpmd('PhpFunction/FunctionDocComment.php', 'PhpFunction/FunctionDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к функции: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('PhpFunction/FunctionDocCommentBad.php', 'PhpFunction/FunctionDocComment.xml');
		$this->assertEquals(6, $res['count'], 'Ошибки при проверке некорректного комментария к функции: ' . var_export($res['messages'], true));
	}
}