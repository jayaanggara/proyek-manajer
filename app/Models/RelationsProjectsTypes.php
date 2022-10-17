<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationsProjectsTypes extends Model
{
    use HasFactory;

    public $table = 'relations_projects_types';

    protected $fillable = [
        'user_id',
        'project_id',
        'project_type_id'
    ];
    
}
