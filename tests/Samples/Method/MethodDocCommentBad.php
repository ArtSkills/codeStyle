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

	/**
	 * @param string $first
	 * @param int $second
	 */
	public function secondMethod($first, $second) {

	}

	/**
	 * Описание, но параметров нет
	 */
	public function thirdMethod($first, $second) {

	}

	/**
	 * Количество параметов не совпадают
	 *
	 * @param string $first
	 */
	public function forthMethod($first, $second) {

	}

	/**
	 * У одного параметра не указан тип
	 *
	 * @param $first
	 * @param int $second
	 */
	public function fifthMethod($first, $second) {

	}

	/**
	 * Опять же не указан тип, но по-другому
	 *
	 * @param string $first
	 * @param $second урлала траляля
	 */
	public function sixthMethod($first, $second) {

	}
}