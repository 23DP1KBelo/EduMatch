<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\City;
use Illuminate\Http\Request;
class LocationController extends Controller {
    public function countries() { 
        return response()->json(Country::orderBy('name')->get()); 
    }
    public function cities(Request $request) {
        $f=$request->validate(['country_id'=>'nullable|integer|exists:countries,id']);
        return response()->json(City::query()->when($f['country_id']??null,fn($q,$id)=>$q->where('country_id',$id))->orderBy('name')->get());
    }
}
