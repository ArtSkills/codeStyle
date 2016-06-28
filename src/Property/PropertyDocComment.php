<?php
namespace ArtSkills\CodeStyle\Property;

use ArtSkills\CodeStyle\ClassRuleEntity;
use PHPMD\AbstractNode;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;

class PropertyDocComment extends ClassRuleEntity
{
	/**
	 * Проверка на обязательное наличие комментариев к свойствам
	 *
	 * @param \PHPMD\AbstractNode $node
	 * @return void
	 */
	public function apply(AbstractNode $node) {
		$fieldDeclarations = $node->findChildrenOfType('FieldDeclaration');
		foreach ($fieldDeclarations as $fieldDeclaration) {
			$variableDeclarators = $fieldDeclaration->findChildrenOfType('VariableDeclarator');
			foreach ($variableDeclarators as $variableDeclarator) {
				$property = $this->createPropertyFromDeclarator($variableDeclarator, $fieldDeclaration, $node);
				$propertyComment = $property->getComment();

				if (!strlen($propertyComment)) {
					$this->addViolation($variableDeclarator, [$property->getName(), 'Он не задан']);
				} else {
					$docBlock = DocBlockFactory::createInstance()->create($propertyComment);
					if (count($docBlock->getTagsByName('inheritdoc'))) { // не проверяем наследование коммента
						continue;
					}

					if (!strlen($docBlock->getSummary())) {
						$this->addViolation($variableDeclarator, [$property->getName(), 'Нет описания свойства']);
					}

					$propertyType = $docBlock->getTagsByName('var');
					if (!count($propertyType)) { // комментарий есть, а тип не указан
						$this->addViolation($variableDeclarator, [$property->getName(), 'Не указан тип свойства']);
					}
				}
			}
		}
	}
}