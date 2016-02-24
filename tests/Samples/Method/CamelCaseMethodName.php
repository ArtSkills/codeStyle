<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class CamelCaseMethodName
{
	public function __construct() {

	}

	protected function doProtectedTest() {
		$this->_doPrivateTest();
	}

	private function _doPrivateTest() {

	}

	public function doPublicTest() {

	}

	public static function getInstance() {

	}
}