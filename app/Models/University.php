<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class University extends Model {
    protected $table='universities';
    public $timestamps = false;
    public function city(){return $this->belongsTo(City::class);} 
    public function studyPrograms(){return $this->hasMany(StudyProgram::class);}
}
