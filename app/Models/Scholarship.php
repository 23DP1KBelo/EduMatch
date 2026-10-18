<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Scholarship extends Model {
    protected $table='scholarships';
    public $timestamps = false;
    public function studyPrograms(){return $this->belongsToMany(StudyProgram::class,'program_scholarships','scholarship_id','program_id');}
}
