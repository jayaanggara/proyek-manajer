<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reports extends Model
{
    use HasFactory;

    public $table = 'reports';

    protected $fillable = [
        'project_id',
        'description',
    ];

    public function files() {
        return $this->hasMany(File::class, 'id_reports', 'id');
    }
    public function proyek() {
        return $this->belongsTo(Proyek::class, 'project_id', 'id');
    }
}
