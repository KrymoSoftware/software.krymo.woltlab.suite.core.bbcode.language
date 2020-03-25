<?php
namespace wcf\system\bbcode;

use wcf\system\exception\SystemException;
use wcf\system\language\LanguageFactory;
use wcf\system\WCF;

/**
 * Parses the [lang] bbcode tag.
 *
 * @author      Niklas Friedrich Gerstner
 * @copyright   2020 Krymo Software
 * @license     Krymo Software - Free Products License <https://krymo.software/licensing-conditions/#free-products>
 * @package     WoltLabSuite\Core\System\Bbcode
 */
class LanguageBBCode extends AbstractBBCode {

    /**
     * @inheritDoc
     * @throws SystemException
     */
    public function getParsedTag(array $openingTag, $content, array $closingTag, BBCodeParser $parser) {
        $languageCode = !empty($openingTag['attributes'][0]) ? $openingTag['attributes'][0] : 0;

        if (!$languageCode) {
            return '';
        }

        $language = LanguageFactory::getInstance()->getLanguageByCode($languageCode);

        if (!$language || WCF::getLanguage()->languageID != $language->languageID) {
            return '';
        }

        return $content;
    }
}