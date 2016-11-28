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
		$curDir = __DIR__;
		exec('"' . $curDir . '/../vendor/bin/phpmd" "' . $curDir . '/Samples/' . $testFile . '" xml "' . $curDir . '/Samples/' . $testRule . '"', $execOutput);

		$xml = simplexml_load_string(implode("\n", $execOutput));
		$messages = [];
		if (!empty($xml->file)) {
			foreach ($xml->file as $xmlFile) {
				foreach ($xmlFile->violation as $errorMessage) {
					$messages[] = (string)$errorMessage;
				}
			}
		}

		return [
			'count' => count($messages),
			'messages' => $execOutput,
		];
	}
}