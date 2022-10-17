<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelationsProjectsUsers extends Model
{
    use HasFactory;

    public $table = 'relations_projects_users';

    protected $fillable = [
        'project_id',
        'user_id',
    ];
}
