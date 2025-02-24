<?php

namespace App\Enums;

enum Section: string
{
    // Home page section 
    case Banner = 'banner';
    case ServiceContainer = 'service_container';
    case ProcessContainer = 'process_container';
    case PlatFormWorkContainer = 'plat_form_work_container';
    case ProviderWorkContainer = 'provider_work_container';
    case ServiceContainerContent = 'service_container_content';
    case ProcessContainerContent = 'process_container_content';
    case PlatFormWorkContainerContent = 'plat_form_work_container_content';
    case ReviewUserContainer = 'review_user_container';
    case ReviewProviderContainer = 'review_provider_container';
    case FaqContainer = 'faq_container';
    case FaqContainerContent = 'faq_container_content';
    case HeroBanner = 'hero_banner';

    //// Car page section 
    case CarBanner = 'car_banner';
    // footer section
    case SocialLinkContainer = 'social_link_container';
}


