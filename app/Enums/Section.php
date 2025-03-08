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
    case AdvertisementContainer = 'advertisement_container';
    case FaqContainerContent = 'faq_container_content';
    case HeroBanner = 'hero_banner';

    //// Car page section 
    case CarBanner = 'car_banner';
    //// Car Restaurant section 
    case RestaurantBanner = 'restaurant_banner';
    //// Car RealEstatePage section 
    case RealEstateBanner = 'real_estate_banner';

    //// Car ServiceRegisterPage section 
    case ServiceRegisterContainer = 'service_provider_container';
    case ServiceRegisterImageContainer = 'service_provider_image_container';
    case ProviderProcessContainer = 'provider_process_container';
    case ProviderProcessImageContainer = 'provider_process_image_container';
    //about section
    case AboutContainer = 'about_container';
    case AboutServiceContainer = 'about_service_container';
    // footer section
    case SocialLinkContainer = 'social_link_container';
}


