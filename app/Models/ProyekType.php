<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProyekType extends Model
{
    use HasFactory;

    public $table = 'projects_types';

    protected $fillable = [
        'type_name',
        'type_description',
    ];
}
