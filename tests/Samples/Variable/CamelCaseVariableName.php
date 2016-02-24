<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Variable;
class CamelCaseVariableName
{
	private static $_testStatic = [];

	/**
	 * @var \DsmPreview
	 */
	private $DsmPreview = null;

	public function test($firstArg, $secondArg, $index) {
		for ($i=0; $i<10; $i++) {
			self::$_testStatic[] = $i;
		}

		self::$_testStatic[$index] = $firstArg;

		$temp = $secondArg / $firstArg;
		$recs = $this->DsmPreview->find('all');

		$testArray = [];

		return self::$_testStatic[$secondArg];
	}
}