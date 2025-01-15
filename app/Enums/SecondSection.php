<?php

namespace App\Enums;

class SecondSection
{
    const BANNER = 'banner';
    const HOW_IT_WORK = 'how_it_work';
    const ABOUT_US = 'about_us';
    const ABOUT_US_CONTENT = 'about_us_content';
    const NEED_TO_APPLY = 'need_to_apply';
    const STARTER_FINANCE = 'starter_finance';
    const WHY_CHOOSE_US = 'why_choose_us';
    const WHY_CHOOSE_US_CONTENT = 'why_choose_us_content';
    const FINANCE_PRODUCT = 'finance_product';
    const REVIEW = 'review';
    const FAQ = 'faq';
    const FAQ_CONTENT = 'faq_content';
    const HERO_BANNER = 'hero_banner';

    public static function getMap()
    {
        return [
            self::BANNER => ['item' => 1, 'type' => 'first'],
            self::HOW_IT_WORK => ['item' => 3, 'type' => 'get'],
            self::ABOUT_US => ['item' => 1, 'type' => 'first'],
            self::ABOUT_US_CONTENT => ['item' => 3, 'type' => 'get'],
            self::NEED_TO_APPLY => ['item' => 4, 'type' => 'get'],
            self::STARTER_FINANCE => ['item' => 5, 'type' => 'get'],
            self::WHY_CHOOSE_US => ['item' => 1, 'type' => 'first'],
            self::WHY_CHOOSE_US_CONTENT => ['item' => 3, 'type' => 'get'],
            self::FINANCE_PRODUCT => ['item' => 3, 'type' => 'get'],
            self::REVIEW => ['item' => 10, 'type' => 'get'],
            self::FAQ => ['item' => 1, 'type' => 'first'],
            self::FAQ_CONTENT => ['item' => 8, 'type' => 'get'],
            self::HERO_BANNER => ['item' => 1, 'type' => 'first'],
        ];
    }

}