<?php
namespace App\Services\Web\Frontend;

use App\Enums\Page;
use App\Enums\Section;
use App\Models\CMS;
use Exception;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class AboutUsService{
        /**
     * Fetch all resources.
     *
     * @return mixed
     */
    public function index()
    {
        try {
            $aboutPageContainer = CMS::where('page', Page::AboutPage)->where('section', Section::AboutContainer)->first();
            $aboutServiceContainer = CMS::where('page', Page::AboutPage)
            ->where('section', Section::AboutServiceContainer)
            ->where("status", 'active')
            ->get();
            $data = [
                // 'car_Services' => $car_Services,
                'aboutPageContainer' => $aboutPageContainer,
                'aboutServiceContainer' => $aboutServiceContainer

            ];
            // dd($data['carPageBanner']->background_image ?? 'No Image Found');
            return $data;
        } catch (Exception $e) {
            Log::error('AboutUsService::index' . $e->getMessage());
            throw $e;
        }
    }
}

