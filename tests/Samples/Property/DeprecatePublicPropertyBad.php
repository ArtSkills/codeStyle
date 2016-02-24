<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class DeprecatePublicPropertyBad
{
	public $publicMethod = false;

	public static $staticPublicMethod = [];
}