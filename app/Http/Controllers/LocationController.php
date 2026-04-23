<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\State;
use App\Models\City;
use App\Models\Category;

class LocationController extends Controller
{
    public function getStates($country_id)
    {
        $states = State::where('country_id', $country_id)->get();
        return response()->json($states);
    }

    public function getCities($state_id)
    {
        $cities = City::where('state_id', $state_id)->where('is_registered', 1)->get();
        return response()->json($cities);
    }

    public function getSubcategory($category_id)
    {
        $subcategories = Category::where('parent_id', $category_id)->get();
        return response()->json($subcategories);
    }
}
