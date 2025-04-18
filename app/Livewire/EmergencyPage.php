<?php
namespace App\Livewire;

use App\Models\Category;
use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class EmergencyPage extends Component
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

    protected $queryString = ['location','serching_is_emergency', 'category', 'subcategory', 'serching_type'];


    public function resetSubcategory()
    {
        // Reset subcategory when category changes
        $this->subcategory = '';

        // Get subcategories of the selected category
        $this->subcategories = Category::find($this->category)?->subCategories ?? [];
    }

    public function render()
{
    $categories = Category::with('subCategories')->where('status', 'active')->get();

    $services = Service::with(['user.contactorStatistics'])
        ->leftJoin('users', 'services.user_id', '=', 'users.id')
        ->leftJoin('contactor_statistics', 'users.id', '=', 'contactor_statistics.user_id')
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
            $query->where('services.type', $type);
        })
        ->when($this->serching_is_emergency, function ($query) {
            $query->where('services.is_emergency', true);
        })
        ->where('services.status', 'active') // Fix ambiguity here
        ->orderByDesc('contactor_statistics.last_60_days_average_rating')
        ->select('services.*')
        ->paginate(20);

    return view('livewire.emergency-page', [
        'services' => $services,
        'categories' => $categories
    ]);
}

}

