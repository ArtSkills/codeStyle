<?php
/**
 * Created by PhpStorm.
 * User: tune
 * Date: 20.02.16
 * Time: 15:35
 */

namespace Samples\Property;


class PropertyInitialize
{
	public $publicProperty = 1;

	private $privateProperty = [];

	/**
	 * @var \DsmPreview
	 */
	protected $DsmPreview = null;
}