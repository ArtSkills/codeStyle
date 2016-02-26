<?php
// Файл проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет

function firstFunction($first, $second) {
	return 'test';
}

/**
 * @param string $first
 * @param int $second
 */
function secondFunction($first, $second) {

}

/**
 * Описание, но параметров нет
 */
function thirdFunction($first, $second) {

}

/**
 * Количество параметов не совпадают
 *
 * @param string $first
 */
function forthFunction($first, $second) {

}

/**
 * У одного параметра не указан тип
 *
 * @param $first
 * @param int $second
 */
function fifthFunction($first, $second) {

}

/**
 * Опять же не указан тип, но по-другому
 *
 * @param string $first
 * @param $second урлала траляля
 */
function sixthFunction($first, $second) {

}