<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\StudyProgram;
use Illuminate\Http\Request;

class StudyProgramController extends Controller {
    public function index(Request $request) {
        $f = $request->validate([
            'search'=>'nullable|string|max:150', 'country_id'=>'nullable|integer|exists:countries,id',
            'city_id'=>'nullable|integer|exists:cities,id', 'university_id'=>'nullable|integer|exists:universities,id',
            'field_id'=>'nullable|integer|exists:study_fields,id', 'degree_level'=>'nullable|string|max:100',
            'language'=>'nullable|string|max:100', 'max_tuition'=>'nullable|numeric|min:0',
            'scholarships'=>'nullable|boolean', 'page'=>'nullable|integer|min:1',
        ]);
        $query = StudyProgram::with(['university.city.country', 'studyFields']);
        if (filled($f['search'] ?? null)) {
            $term = $f['search'];
            $query->where(fn($q) => $q->where('name','like',"%{$term}%")
                ->orWhereHas('university', fn($u) => $u->where('name','like',"%{$term}%")));
        }
        if (!empty($f['country_id'])) $query->whereHas('university.city',fn($q)=>$q->where('country_id',$f['country_id']));
        if (!empty($f['city_id'])) $query->whereHas('university',fn($q)=>$q->where('city_id',$f['city_id']));
        if (!empty($f['university_id'])) $query->where('university_id',$f['university_id']);
        if (!empty($f['field_id'])) $query->whereHas('studyFields',fn($q)=>$q->where('study_fields.id',$f['field_id']));
        if (filled($f['degree_level'] ?? null)) $query->where('degree_level',$f['degree_level']);
        if (filled($f['language'] ?? null)) $query->where('language',$f['language']);
        if (isset($f['max_tuition'])) $query->where('tuition_fees','<=',$f['max_tuition']);
        if (!empty($f['scholarships'])) $query->whereHas('scholarships');
        return response()->json($query->orderBy('name')->paginate(12)->withQueryString());
    }
    public function show(StudyProgram $studyProgram) {
        return response()->json($studyProgram->load(['university.city.country','studyFields','scholarships']));
    }
}