<?php
namespace ArtSkills\CodeStyle;

use \PHPMD\AbstractRule;
use \PHPMD\Rule\MethodAware;
use \PHPMD\Rule\FunctionAware;

abstract class VariableRuleEntity extends AbstractRule implements MethodAware, FunctionAware
{

}