<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class CamelCasePropertyName
{
	protected $_protectedProperty = 0;

	protected $_anotherProtectedProperty = [];

	private $_privateProperty = null;

	private static $_privateStaticProperty = false;

	/**
	 * @var DsmPreview
	 */
	public $DsmPreview = null;

	/**
	 * CakePHP 3
	 *
	 * @var \App\Model\CatalogItemTable
	 */
	public $CatalogItem = null;

}