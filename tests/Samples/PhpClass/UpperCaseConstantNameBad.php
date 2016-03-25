<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\PhpClass;
class UpperCaseConstantNameBad
{
	const badConstant = 1;

	const _BAD_CONSTANT = 2;
}