<?php

namespace App\Http\Livewire;

use Asantibanez\LivewireSelect\LivewireSelect;
use Livewire\Component;

class CarModelSelect extends LivewireSelect
{

    public function options($searchTerm = null)
    {
        $convertToCollection = collect();
        $cities = \App\City::all();
        foreach ($cities as $city ){
            $convertToCollection->push([
                'value' => $city->id,
                'description' => $city->name]);
        }

        return $convertToCollection;
    }
}
