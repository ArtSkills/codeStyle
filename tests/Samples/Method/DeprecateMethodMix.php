<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class DeprecateMethodMix
{
	private function __construct() {

	}

	public static function getInstance() {
		static $instance;
		if (is_null($instance)) {
			$instance = new self();
		}
		return $instance;
	}

	private static function privateStatic() {
		return 'private';
	}

	public function getTestData() {
		return 'test';
	}
}