<?php

namespace App\Http\Controllers\Web\Frontend;

use App\Enums\Page;
use App\Enums\SecondSection;
use App\Http\Controllers\Controller;
use App\Models\CMS;
use Illuminate\Http\Request;

class HomePageController extends Controller
{

    /**
     * Homepage of the frontend.
     *
     * @return \Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $query = CMS::where('page', Page::HomePage)->where('status', 'active');
        foreach (SecondSection::getMap() as $key => $section) {
            $cms[$key] = (clone $query)->where('section', $key)->latest()->take($section['item'])->{$section['type']}();
        }
        // dd($cms);
        return view("frontend.layouts.home.index", compact('cms'));
    }
}
