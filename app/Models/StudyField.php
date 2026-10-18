<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StudyField extends Model {
    protected $table='study_fields';
    public $timestamps = false;
    public function studyPrograms(){return $this->belongsToMany(StudyProgram::class,'program_fields','study_field_id','program_id');}
}
