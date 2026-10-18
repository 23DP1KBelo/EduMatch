<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\StudyField;
use App\Models\StudyProgram;
class FilterController extends Controller {
    public function index() {
        return response()->json([
            'countries'=>Country::orderBy('name')->get(['id','name']),
            'fields'=>StudyField::orderBy('name')->get(['id','name']),
            'degrees'=>StudyProgram::whereNotNull('degree_level')->distinct()->orderBy('degree_level')->pluck('degree_level'),
            'languages'=>StudyProgram::whereNotNull('language')->distinct()->orderBy('language')->pluck('language'),
            'max_tuition'=>StudyProgram::max('tuition_fees'),
        ]);
    }
}
