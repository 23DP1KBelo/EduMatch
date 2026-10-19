<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UniversityController;
use App\Http\Controllers\Api\StudyProgramController;
use App\Http\Controllers\Api\StudyFieldController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\FilterController;


Route::get('/universities',[UniversityController::class,'index']);
Route::get('/universities/{university}',[UniversityController::class,'show']);
Route::get('/universities/{university}/programs',[UniversityController::class,'programs']);
Route::get('/study-programs',[StudyProgramController::class,'index']);
Route::get('/study-programs/{studyProgram}',[StudyProgramController::class,'show']);
Route::get('/study-fields',[StudyFieldController::class,'index']);
Route::get('/countries',[LocationController::class,'countries']);
Route::get('/cities',[LocationController::class,'cities']);
Route::get('/study-filters',[FilterController::class,'index']);
