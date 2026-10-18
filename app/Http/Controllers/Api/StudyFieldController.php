<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\StudyField;
class StudyFieldController extends Controller {
    public function index() { return response()->json(StudyField::orderBy('name')->get()); }
}
