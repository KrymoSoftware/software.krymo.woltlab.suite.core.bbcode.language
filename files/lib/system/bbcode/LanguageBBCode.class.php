<?php

namespace wcf\system\bbcode;

use wcf\system\language\LanguageFactory;
use wcf\system\WCF;

/**
 * Parses the [lang] bbcode tag.
 *
 * @author      Niklas Friedrich Gerstner
 * @copyright   2024 Krymo Software
 * @license     Krymo Software - Free Products License <https://krymo.software/license-terms/#free-products>
 * @package     WoltLabSuite\Core\System\Bbcode
 */
final class LanguageBBCode extends AbstractBBCode
{
    /**
     * @inheritDoc
     */
    public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser): string
    {
        $languageCode = !empty($openingTag['attributes'][0]) ? $openingTag['attributes'][0] : 0;

        if (!$languageCode) {
            return '';
        }

        $language = LanguageFactory::getInstance()->getLanguageByCode($languageCode);

        if (!$language || WCF::getLanguage()->languageID !== $language->languageID) {
            return '';
        }

        return $content;
    }
}
