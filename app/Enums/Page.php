<?php

namespace App\Enums;

enum Page: string
{
    case HomePage = 'home_page';
    case CarPage = 'car_page';

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


