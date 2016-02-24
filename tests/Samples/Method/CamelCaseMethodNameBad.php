<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class CamelCaseMethodNameBad
{
	public function numberProblem2() {

	}

	public function _badPublic() {

	}

	public function BadAnotherPublic() {

	}

	private function badPrivate() {

	}

	private function _badNumberPrivate2() {

	}

	public static function BadStatic() {

	}

	public static function _badAnotherStatic() {

	}

	public static function badNumberStatic2() {

	}
}