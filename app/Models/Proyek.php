<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyek extends Model
{
    use HasFactory;

    public $table = 'projects';

    protected $fillable = [
        'project_name',
        'project_description',
        'logo',
        'status',
        'user',
        'start_date',
        'end_date',
        'site',
        'company_name',
    ];
    
    public function getUser(){
        return $this->belongsTo(User::class,'user','id');
    }

    public function getTask(){
        return $this->hasMany(Task::class,'project_id','id');
    }

    public function getType(){
        return $this->belongsToMany(ProyekType::class,'relations_projects_types','project_id','project_type_id')->withTimestamps();
    }

    public function getStaf(){
        return $this->belongsToMany(User::class,'relations_projects_users','project_id','user_id')->withTimestamps();
    }

    public function getLogoUrlAttribute()
    {
        if($this->logo != "")
        {
            return asset('assets/images/'.$this->logo);
        }
        return '';
    }

}
