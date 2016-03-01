<?php
namespace ArtSkills\Test;
abstract class AppTest extends \PHPUnit_Framework_TestCase
{
	const PHPMD_RELATIVE_PATH = '/../bin/'; // относительный путь от этого файла к запускаемому скрипту phpmd

	/**
	 * Запуск файла $testFile на проверку по правилу $testRule
	 *
	 * @param string $testFile
	 * @param string $testRule
	 * @return array ['count' => <кол-во сообщений>, 'messages' => <массив строк результата от phpmd>]
	 */
	protected function executePhpmd($testFile, $testRule) {
		$curDir = dirname(__FILE__);

		exec('"' . $curDir . '/../vendor/bin/phpmd" "' . $curDir . '/Samples/' . $testFile . '" text "' . $curDir . '/Samples/' . $testRule . '"', $execOutput);
		$outputSize = count($execOutput) - 1;
		return [
			'count' => $outputSize < 0 ? 0 : $outputSize,
			'messages' => $execOutput,
		];
	}
}