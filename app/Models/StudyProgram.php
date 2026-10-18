<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class StudyProgram extends Model {
    protected $table='study_programs';
    public $timestamps = false;
    public function university(){return $this->belongsTo(University::class);} public function studyFields(){return $this->belongsToMany(StudyField::class,'program_fields','program_id','study_field_id');} public function scholarships(){return $this->belongsToMany(Scholarship::class,'program_scholarships','program_id','scholarship_id');}
}
