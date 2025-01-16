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
    case Review = 'review';
    case Faq = 'faq';
    case FaqContent = 'faq_content';
    case HeroBanner = 'hero_banner';

//    OurProducts page section

//    Offers page section

//    AboutUs page section

//    ForBusiness page section

//    Contact page section
}


