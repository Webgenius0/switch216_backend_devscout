<?php

namespace App\Livewire;

use App\Models\CarBrand;
use App\Models\CarService;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use App\Models\Category;
use App\Models\Service;
use Livewire\WithPagination;

class CarPage extends Component
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
    public $car_type;
    public $car_brand;
    public $car_model;
    public $car_models = [];
    public $car_year;
    public $car_years = [];
    public $fuel_type;
    public $transmission_type;
    public $kilometers_driven;
    public $price_range;
    public $transaction_type;


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
    /**
     * Resets the car model selection when the car brand changes.
     * Fetches and updates the list of car models based on the selected car brand.
     */

    public function resetCarModel()
    {
        // Reset car_model when category changes
        $this->car_model = '';
        // Get car_models of the selected category
        $this->car_models = CarService::where('brand', $this->car_brand)->pluck('model') ?? [];
        $this->resetCarYear();
    }
    /**
     * Reset car_year when category changes
     *
     * Resets the car_year to empty string and
     * gets the car_years of the selected category
     *
     * @return void
     */
    public function resetCarYear()
    {
        // Reset car_year when category changes
        $this->car_year = '';
        // Get car_years of the selected category
        $this->car_years = CarService::where('model', $this->car_model)->pluck('year') ?? [];
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\Contracts\View\View
     */
    /**
     * @var \App\Models\Service[] $services
     * @var \App\Models\Category[] $categories
     * @var \App\Models\CarBrand[] $carBrands
     */
    public function render()
    {
        $carBrands = CarBrand::get();
        $categories = Category::with('subCategories')->where("status", 'active')->get();

        $services = Service::where('category_id', 3)->where('status', 'active')
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
            ->when($this->car_type, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('car_type', $value);
                });
            })
            ->when($this->car_brand, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('brand', $value);
                });
            })
            ->when($this->car_model, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('model', $value);
                });
            })
            ->when($this->car_year, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('year', $value);
                });
            })
            ->when($this->fuel_type, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('fuel_type', $value);
                });
            })
            ->when($this->transmission_type, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('transmission', $value);
                });
            })
            ->when($this->kilometers_driven, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->where('kilometers_driven', $value);
                });
            })
            ->when($this->price_range, function ($query, $value) {
                if ($value === '100,000+') {
                    // Handle the "100,000+" case separately
                    $query->whereHas('CarService', function ($query) {
                        $query->where('price', '>=', 100000);
                    });
                } else {
                    // Convert "10,000 - 50,000" into an array [10000, 50000]
                    $range = explode(' - ', str_replace(',', '', $value));
            
                    // Ensure the range is valid before using whereBetween()
                    if (count($range) === 2) {
                        $query->whereHas('CarService', function ($query) use ($range) {
                            $query->whereBetween('price', [$range[0], $range[1]]);
                        });
                    }
                }
            })
            
            ->when($this->transaction_type, function ($query, $value) {
                $query->whereHas('CarService', function ($query) use ($value) {
                    $query->whereBetween('transaction_type', $value);
                });
            })
            ->paginate(20);


        return view('livewire.car-page', [
            'services' => $services,
            'categories' => $categories,
            'carBrands' => $carBrands
        ]);
    }
}
