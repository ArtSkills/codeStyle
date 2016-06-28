<?php
namespace ArtSkills\CodeStyle;

use PHPMD\AbstractRule;
use PHPMD\AbstractNode;
use phpDocumentor\Reflection\DocBlock;
use phpDocumentor\Reflection\DocBlockFactory;

abstract class CallableRuleEntity extends AbstractRule
{
	/**
	 * Проверка на обязательное наличие комментариев к функциям и методам
	 *
	 * @param AbstractNode $node
	 * @return void
	 */
	protected function checkDocComment(AbstractNode $node) {
		/** @noinspection PhpUndefinedMethodInspection */
		$functionComment = $node->getComment();
		if (!strlen($functionComment)) {
			$this->addViolation($node, [$node->getName(), 'Он не указан']);
		} else {
			$docBlock = DocBlockFactory::createInstance()->create($functionComment);

			if (count($docBlock->getTagsByName('inheritdoc'))) { // не проверяем наследование коммента
				return;
			}

			if (!strlen($docBlock->getSummary())) {
				$this->addViolation($node, [
					$node->getName(),
					'Нет описания',
				]);
				return;
			}

			$this->_checkCommentParameters($node, $docBlock);
		}
	}

	/**
	 * Проверка описания параметров
	 *
	 * @param AbstractNode $node
	 * @param DocBlock $docBlock
	 */
	private function _checkCommentParameters($node, $docBlock) {
		/** @noinspection PhpUndefinedMethodInspection */
		$parameters = $node->getNode()->getParameters();
		$countParameters = count($parameters);
		if ($countParameters) {
			$paramTags = $docBlock->getTagsByName('param');
			$countTags = count($paramTags);
			if (!$countTags) {
				$this->addViolation($node, [$node->getName(), 'Не перечислены параметры']);
				return;
			}
			if ($countParameters != $countTags) {
				$this->addViolation($node, [
					$node->getName(),
					'Кол-во параметров функции не совпадает с комментарием',
				]);
				return;
			}

			foreach ($paramTags as $tag) {
				/**
				 * @var \phpDocumentor\Reflection\DocBlock\Tags\Param $tag
				 */
				if (!$tag->getType()) {
					$this->addViolation($node, [
						$node->getName(),
						'Некорректно указан параметр "' . $tag->getVariableName() . '"',
					]);
					return;
				}
			}
		}
	}
}