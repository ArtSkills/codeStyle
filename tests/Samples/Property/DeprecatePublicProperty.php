<?php
/**
 * Класс проверки PHPMD, используется только в синтаксических целях, смысловой нагрузки не несет
 */
namespace Samples\Property;
class DeprecatePublicProperty
{
	public $uses = [
		'Catalog',
		'CatalogItem',
	];
	public $helpers = ['Form', 'Html'];
	public $components = [
		'Session',
		'VtigerCrm',
		'Cart',
		'DirectSmile',
		'GsbThumbnail',
		'ExcelExport',
		'Auth' => [
			'loginAction' => [
				'controller' => 'admin',
				'action' => 'login',
			],
			'authError' => 'Что-то пошло не так.....',
			'authenticate' => [
				'Crm',
			],
		],
	];

	protected $protectedProperty = [];

	private $_privateProperty = false;

	/**
	 * @var \DsmPreview
	 */
	public $DsmPreview = null;

	/**
	 * CakePHP 3
	 *
	 * @var \App\Model\CatalogItemTable
	 */
	public $CatalogItem = null;
}