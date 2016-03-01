<?php
namespace ArtSkills\Test;
class PropertyTest extends AppTest
{
	public function testCamelCaseProperty() {
		$res = $this->executePhpmd('Property/CamelCasePropertyName.php', 'Property/CamelCasePropertyName.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке camelCase свойств: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Property/CamelCasePropertyNameBad.php', 'Property/CamelCasePropertyName.xml');
		$this->assertEquals(8, $res['count'], 'Ошибки при проверке некорректных camelCase свойств: ' . var_export($res['messages'], true));
	}

	public function testPublicProperty() {
		$res = $this->executePhpmd('Property/DeprecatePublicProperty.php', 'Property/DeprecatePublicProperty.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке публичных свойств: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Property/DeprecatePublicPropertyBad.php', 'Property/DeprecatePublicProperty.xml');
		$this->assertEquals(2, $res['count'], 'Ошибки при проверке некорректных публичных свойств: ' . var_export($res['messages'], true));
	}

	public function testPropertyDoc() {
		$res = $this->executePhpmd('Property/PropertyDocComment.php', 'Property/PropertyDocComment.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке комментария к свойству: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Property/PropertyDocCommentBad.php', 'Property/PropertyDocComment.xml');
		$this->assertEquals(4, $res['count'], 'Ошибки при проверке некорректного комментария к свойству: ' . var_export($res['messages'], true));
	}

	public function testPropertyInitialize() {
		$res = $this->executePhpmd('Property/PropertyInitialize.php', 'Property/PropertyInitialize.xml');
		$this->assertEquals(0, $res['count'], 'Ошибки при проверке инициализации свойств: ' . var_export($res['messages'], true));

		$res = $this->executePhpmd('Property/PropertyInitializeBad.php', 'Property/PropertyInitialize.xml');
		$this->assertEquals(3, $res['count'], 'Ошибки при проверке некорректной инициализации свойств: ' . var_export($res['messages'], true));
	}
}