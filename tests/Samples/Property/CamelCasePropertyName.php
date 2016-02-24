<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class CamelCasePropertyName
{
	protected $protectedProperty = 0;

	protected $anotherProtectedProperty = [];

	private $_privateProperty = null;

	private static $_privateStaticProperty = false;

	/**
	 * @var DsmPreview
	 */
	protected $DsmPreview = null;

	/**
	 * CakePHP 3
	 *
	 * @var \App\Model\CatalogItemTable
	 */
	protected $CatalogItem = null;

}