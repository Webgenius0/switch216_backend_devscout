<?php

namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use App\Models\SubCategory;
use Illuminate\Support\Facades\Log;
use Laravel\Pail\ValueObjects\Origin\Console;
use Livewire\Component;
use Livewire\WithPagination;

class RestaurantPage extends Component
{
    use WithPagination;

    public string $location = "";
    public $category;
    public $subcategory = '';
    public $subcategories = [];
    public $serching_is_emergency = false;
    // public $contractor_ranking = "";
    // public $contractor = "5";
    public $serching_type;
    public $locations = [];

    protected $queryString = ['location', 'serching_is_emergency', 'category', 'subcategory', 'serching_type'];


    public function resetSubcategory()
    {
        // Reset subcategory when category changes
        $this->subcategory = '';

        // Get subcategories of the selected category
        $this->subcategories = Category::find($this->category)?->subCategories ?? [];
    }
    /**
     * Search for cities in Morocco given a search query.
     *
     * Fetches a JSON file containing Moroccan cities and filters them by
     * the given query. The results are limited to 10 cities.
     *
     * @return void
     */
    public function searchLocation()
    {
        $jsonPath = public_path('backend/admin/assets/morocco_city_list.json');
        $cityData = json_decode(file_get_contents($jsonPath), true);

        $cities = collect($cityData['results'])
            ->pluck('name')
            ->map(fn($city) => trim($city)) // Trim spaces from all city names
            ->filter(fn($city) => str_contains(strtolower($city), strtolower($this->location)))
            ->take(10)
            ->values()
            ->all();

        $this->locations = $cities;
    }

    public function selectLocation($city)
    {
        $this->location = $city; // Remove extra spaces
        Log::info($city);
        $this->locations = []; // Hide dropdown after selection
    }


    public function render()
    {

        $categories = Category::with('subCategories')->where("status", 'active')->get();
        $subCategories = SubCategory::where("status", 'active')->where('category_id', 2)->get();
        // dd($categories->subCategories);
        $services = Service::where('category_id', 2)->where('status', 'active')
            ->when($this->location, function ($query, $value) {
                $query->whereHas('user', function ($query) use ($value) {
                    $query->whereHas('userAddresses', function ($query) use ($value) {
                        $query->where('location', 'LIKE', '%' . $value . '%');
                    });
                });
            })
            ->when($this->category, function ($query, $categoryName) {
                $query->whereHas('category', function ($q) use ($categoryName) {
                    $q->where('name', 'LIKE', '%' . $categoryName . '%');
                });
            })
            ->when($this->subcategory, function ($query, $subcategoryName) {
                $query->whereHas('subcategory', function ($q) use ($subcategoryName) {
                    $q->where('name', 'LIKE', '%' . $subcategoryName . '%');
                });
            })
            ->when($this->serching_type, function ($query, $type) {
                $query->where('type', $type);
            })
            ->when($this->serching_is_emergency, function ($query) {
                $query->where('is_emergency', true);
            })
            ->paginate(20);


        return view('livewire.restaurant-page', [
            'services' => $services,
            'categories' => $categories,
            'subCategories' => $subCategories,
        ]);
    }
}
