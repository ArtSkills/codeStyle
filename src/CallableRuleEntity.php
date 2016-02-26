<?php
/**
 * Created by PhpStorm.
 * User: vladimirtunikov
 * Date: 26.02.16
 * Time: 20:36
 */

namespace ArtSkills\CodeStyle;

use PHPMD\AbstractRule;
use PHPMD\AbstractNode;
use phpDocumentor\Reflection\DocBlock;

abstract class CallableRuleEntity extends AbstractRule
{
	/**
	 * Проверка на обязательное наличие комментариев к функциям и методам
	 *
	 * @param AbstractNode $node
	 * @return void
	 */
	protected function checkDocComment(AbstractNode $node) {
			$functionComment = $node->getComment();
			if (!strlen($functionComment)) {
				$this->addViolation($node, [$node->getName(), 'Он не указан']);
			} else {
				$docBlock = new DocBlock($functionComment);
				if (count($docBlock->getTagsByName('inheritdoc'))) { // не проверяем наследование коммента
					return;
				}

				if (!strlen($docBlock->getShortDescription())) {
					$this->addViolation($node, [
						$node->getName(),
						'Нет описания',
					]);
					return;
				}

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
						$contList = explode(' ', $tag->getContent());
						if (count($contList) < 2 || (substr($contList[1], 0, 1) !== '$')) {
							$this->addViolation($node, [
								$node->getName(),
								'Некорректно указан параметр "' . $tag->getContent() . '"',
							]);
							return;
						}
					}
				}
			}
		}
}