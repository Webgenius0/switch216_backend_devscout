<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\CarBrand;
use App\Models\CarService;
use Illuminate\Support\Facades\Log;
use App\Models\Category;
use App\Models\Service;
use Livewire\WithPagination;

class RealStatePage extends Component
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
    public $property_type;
    public $transaction_type;
    public $price_range;
    public $bedrooms;
    public $bathrooms;
    public $is_furnished;



    protected $queryString = ['location', 'serching_is_emergency', 'category', 'subcategory', 'serching_type'];


    /**
     * Resets the subcategory when category changes and gets the subcategories of the selected category.
     *
     * @return void
     */
    public function resetSubcategory()
    {
        // Reset subcategory when category changes
        $this->subcategory = '';

        // Get subcategories of the selected category
        $this->subcategories = Category::find($this->category)?->subCategories ?? [];
    }

    public function render()
    {
        $categories = Category::with('subCategories')->where("status", 'active')->get();

        $services = Service::where('category_id', 1)->where('status', 'active')
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
            ->when($this->property_type, function ($query, $value) {
                $query->whereHas('RealStateService', function ($query) use ($value) {
                    $query->where('property_type', $value);
                });
            })
            ->when($this->transaction_type, function ($query, $value) {
                $query->whereHas('RealStateService', function ($query) use ($value) {
                    $query->where('transaction_type', $value);
                });
            })
            ->when($this->bedrooms, function ($query, $value) {
                $query->whereHas('RealStateService', function ($query) use ($value) {
                    $query->where('bedrooms', $value);
                });
            })
            ->when($this->bathrooms, function ($query, $value) {
                $query->whereHas('RealStateService', function ($query) use ($value) {
                    $query->where('bathrooms', $value);
                });
            })
            ->when($this->is_furnished, function ($query, $value) {
                $query->whereHas('RealStateService', function ($query) use ($value) {
                    $query->where('is_furnished', $value);
                });
            })
            ->when($this->price_range, function ($query, $value) {
                if ($value === '100,000+') {
                    // Handle the "100,000+" case separately
                    $query->whereHas('RealStateService', function ($query) {
                        $query->where('price', '>=', 100000);
                    });
                } else {
                    // Convert "10,000 - 50,000" into an array [10000, 50000]
                    $range = explode(' - ', str_replace(',', '', $value));

                    // Ensure the range is valid before using whereBetween()
                    if (count($range) === 2) {
                        $query->whereHas('RealStateService', function ($query) use ($range) {
                            $query->whereBetween('price', [$range[0], $range[1]]);
                        });
                    }
                }
            })


            ->paginate(20);


        return view('livewire.real-state-page', [
            'services' => $services,
            'categories' => $categories,
        ]);
    }
}
