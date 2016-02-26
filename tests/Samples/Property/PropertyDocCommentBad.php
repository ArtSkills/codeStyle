<?php

/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class PropertyDocCommentBad
{
	// int
	protected $protectedProperty = 0;


	private $_privateProperty = null;

	/**
	 * @var null
	 */
	protected $DsmPreview = null;

	/**
	 * Без типа
	 */
	protected $noType = 0;
}