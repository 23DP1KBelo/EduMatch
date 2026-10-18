<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\University;
use Illuminate\Http\Request;
class UniversityController extends Controller {
    public function index(Request $request) {
        $f=$request->validate(['search'=>'nullable|string|max:150','country_id'=>'nullable|integer|exists:countries,id','city_id'=>'nullable|integer|exists:cities,id','page'=>'nullable|integer|min:1']);
        $q=University::with('city.country')->withCount('studyPrograms');
        if(filled($f['search']??null)) $q->where('name','like','%'.$f['search'].'%');
        if(!empty($f['city_id'])) $q->where('city_id',$f['city_id']);
        if(!empty($f['country_id'])) $q->whereHas('city',fn($city)=>$city->where('country_id',$f['country_id']));
        return response()->json($q->orderBy('name')->paginate(12)->withQueryString());
    }
    public function show(University $university) {
        return response()->json($university->load('city.country')->loadCount('studyPrograms'));
    }
    public function programs(University $university) {
        return response()->json($university->studyPrograms()->with('studyFields')->orderBy('name')->paginate(12));
    }
}
