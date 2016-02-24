<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class MethodDocCommentBad
{
	public function __construct($arg) {

	}

	// Тестовый метод
	public function publicMethod($inputArg) {
		return $inputArg;
	}

}