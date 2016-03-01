<?php
namespace ArtSkills\Test;
class MethodTest extends AppTest
{
	public function testCamelCaseMethod() {
		$res = $this->executePhpmd('Method/CamelCaseMethodName.php', 'Method/CamelCaseMethodName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase методов: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Method/CamelCaseMethodNameBad.php', 'Method/CamelCaseMethodName.xml');
		$this->assertEquals(8, $res['count'], 'Ошибки при проверке некорректных camelCase методов: ' . var_export($res['messages'], true));
	}

	public function testMethodMix() {
		$res = $this->executePhpmd('Method/DeprecateMethodMix.php', 'Method/DeprecateMethodMix.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке обычных/абстрактных публичных методов: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Method/DeprecateMethodMixBad.php', 'Method/DeprecateMethodMix.xml');
		$this->assertEquals(1, $res['count'], 'Ошибки при проверке некорректных обычных/абстрактных публичных методов: ' . var_export($res['messages'], true));
	}

	public function testMethodDoc() {
		$res = $this->executePhpmd('Method/MethodDocComment.php', 'Method/MethodDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к методу: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Method/MethodDocCommentBad.php', 'Method/MethodDocComment.xml');
		$this->assertEquals(7, $res['count'], 'Ошибки при проверке некорректного комментария к методу: ' . var_export($res['messages'], true));
	}

}