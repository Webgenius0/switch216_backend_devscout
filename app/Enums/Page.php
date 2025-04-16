<?php

namespace App\Enums;

enum Page: string
{
    case HomePage = 'home_page';
    case CarPage = 'car_page';
    case RestaurantPage = 'restaurant_page';
    case RealEstatePage = 'real_estate_page';
    case ServiceRegisterPage = 'service_register_page';
    case AboutPage ='about_page';
    case LoginPage ='login_page';

}


// class Page{
//     const HomePage = 'home_page';
//     const OurProducts = 'our_products';
//     const Offers = 'offers';
//     const AboutUs = 'about_us';
//     const ForBusiness = 'for_business';
//     const Contact = 'contact';

//     public static function map(){
//         return[
//           "Home Page" => self::HomePage,
//           "Our products" => self::OurProducts,
//           "Offers" =>self::Offers,
//           "About Us" =>self::AboutUs,
//           "For business" =>self::ForBusiness,
//           "contact" =>self::Contact
//         ];
//     }
// }


