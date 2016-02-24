<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Method;
class MethodDocComment
{
	/**
	 * MethodDoc constructor.
	 *
	 * @param string $arg
	 */
	public function __construct($arg) {

	}

	/**
	 * Тестовый метод
	 *
	 * @param string $inputArg
	 * @return string
	 */
	public function publicMethod($inputArg) {
		return $inputArg;
	}

}