<?php

/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class PropertyDocComment
{
	/**
	 * @var int
	 */
	protected $protectedProperty = 0;

	/**
	 * @inheritdoc
	 */
	private $_privateProperty = null;

	/**
	 * Ггг
	 *
	 * @var \DsmPreview
	 */
	protected $DsmPreview = null;
}