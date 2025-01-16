<?php

namespace App\Enums;

class SecondSection
{
    const Banner = 'banner';
    const ServiceContainer = 'service_container';
    const ProcessContainer = 'process_container';
    const PlatFormWorkContainer = 'plat_form_work_container';
    const ProviderWorkContainer = 'provider_work_container';
    const ServiceContainerContent = 'service_container_content';
    const ProcessContainerContent = 'process_container_content';
    const PlatFormWorkContainerContent = 'plat_form_work_container_content';
    const ReviewUserContainer = 'review_user_container';
    const ReviewProviderContainer = 'review_provider_container';
    const FaqContainer = 'faq_container';
    const FaqContainerContent = 'faq_container_content';



    public static function getMap()
    {
        return [
            self::Banner => ['item' => 10, 'type' => 'get'],
            self::ServiceContainer => ['item' => 1, 'type' => 'first'],
            self::ProcessContainer => ['item' => 1, 'type' => 'first'],
            self::PlatFormWorkContainer => ['item' => 1, 'type' => 'first'],
            self::ProviderWorkContainer => ['item' => 1, 'type' => 'first'],
            self::ServiceContainerContent => ['item' => 5, 'type' => 'get'],
            self::ProcessContainerContent => ['item' => 3, 'type' => 'get'],
            self::PlatFormWorkContainerContent => ['item' => 3, 'type' => 'get'],
            self::ReviewUserContainer => ['item' => 1, 'type' => 'first'],
            self::ReviewProviderContainer => ['item' => 1, 'type' => 'first'],
            self::FaqContainer => ['item' => 1, 'type' => 'first'],
            self::FaqContainerContent => ['item' => 3, 'type' => 'get'],
        ];
    }

}