<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class CamelCasePropertyNameBad
{
	protected $BadProtected;

	protected $badNumProtected2 = 0;

	private $badPrivate = null;

	private $_BadPrivate = 2;

	private $BadAnotherPrivate = [];

	private $_badNumberPrivate2 = 2;

	/**
	 * Блаблабла
	 */
	public $CatalogItem = null;

	/**
	 * @var null
	 */
	public $DsmPreview = null;
}