<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    public $table = 'tasks';

    protected $fillable = [
        'title',
        'description',
        'status',
        'risk',
        'attached_by',
        'start',
        'deadline',
        'project_id',
    ];

    public function getProyek(){
        return $this->belongsTo(Proyek::class,'project_id','id');
    }
}
