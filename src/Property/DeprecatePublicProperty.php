<?php
namespace ArtSkills\CodeStyle\Property;

use PHPMD\AbstractNode;
use ArtSkills\CodeStyle\ClassRuleEntity;

class DeprecatePublicProperty extends ClassRuleEntity
{
	/**
	 * Список исключений
	 *
	 * @var array
	 */
	private $_exceptions = [
		'$uses',
		'$helpers',
		'$components',
		'$useTable',
		'$useDbConfig',
		'$records',
		'$import',
		'$fixtures',
		'$paginate',
		'hasMany',
	];

	/**
	 * Проверка на публичные методы
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$fieldDeclarations = $node->findChildrenOfType('FieldDeclaration');
		foreach ($fieldDeclarations as $fieldDeclaration) {
			$variableDeclarators = $fieldDeclaration->findChildrenOfType('VariableDeclarator');
			/** @noinspection PhpUndefinedMethodInspection */
			$isPublic = $fieldDeclaration->isPublic();
			foreach ($variableDeclarators as $variableDeclarator) {
				$propertyName = $variableDeclarator->getName();
				if (!in_array($propertyName, $this->_exceptions) && $isPublic) {
					if (!$this->checkPropertyForCakeException($variableDeclarator, $fieldDeclaration, $node)) {
						$this->addViolation($variableDeclarator, [$propertyName,]);
					}
				}
			}
		}
	}
}