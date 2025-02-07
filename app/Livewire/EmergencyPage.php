<?php

namespace App\Livewire;


use App\Models\Service;
use Livewire\Component;
use Livewire\WithPagination;

class EmergencyPage extends Component
{

    use WithPagination;

    public string $location = "";
    public function render()
    {
        $services = Service::where('is_emergency',true)->when($this->location,function($query,$value){
            $query->whereHas('user',function($query) use($value){
                $query->whereHas('userAddresses',function($query) use($value){
                    $query->where('location','LIKE','%'.$value.'%');
                });
            });
        })->paginate(1);
        return view('livewire.emergency-page',['services'=>$services]);
    }
}
