<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Variable;
class CamelCaseVariableNameBad
{
	public function badTest($arg1, $arg2) {
		$HTTP_SESSION_VARS = [];

		$BadVariable = 10;
		$bad_array = [1, $BadVariable];

		static $_ggg;
		$_ggg = $arg2;

		return $arg1 + $arg2;
	}
}