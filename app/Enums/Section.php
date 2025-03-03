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
    case RealEstatePage = 'RealEstate_banner';

    //// Car ServiceRegisterPage section 
    case ServiceRegisterContainer = 'ServiceProvider_container';
    case ServiceRegisterImageContainer = 'ServiceProviderImage_container';
    case ProviderProcessContainer = 'ProviderProcess_container';
    case ProviderProcessImageContainer = 'provider_process_image_container';

    //about section

    case AboutContainer = 'about_container';
    // footer section
    case SocialLinkContainer = 'social_link_container';
}


