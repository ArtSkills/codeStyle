<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class DeprecateMethodMixBad
{
	public static function staticFunction() {
		return 1;
	}

	public function publicFunction() {
		return 2;
	}
}