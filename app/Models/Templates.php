<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Templates extends Model
{
    use HasFactory;

    public $table = 'report_templates';

    protected $fillable = [
        'name',
        'deskripsi',
    ];

    public function proyek(){
        return $this->hasMany(Templates::class);
    }
}
