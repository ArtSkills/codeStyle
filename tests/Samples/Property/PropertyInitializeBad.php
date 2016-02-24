<?php
/**
 * Created by PhpStorm.
 * User: tune
 * Date: 20.02.16
 * Time: 15:35
 */

namespace Samples\Property;


class PropertyInitializeBad
{
	public $publicProperty;

	/**
	 * Комментарий без типа
	 */
	private $privateProperty;

	/**
	 * @var \DsmPreview
	 */
	protected $DsmPreview;
}