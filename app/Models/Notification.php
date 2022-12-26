<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function user() {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    
    public function proyek() {
        return $this->belongsTo(Proyek::class, 'project_id', 'id');
    }

    public function getStatusAttribute($value) {
        switch ($value) {
            case 1:
                return "Proyek ".$this->proyek->project_name." Berhasil ditambahkan";
                break;

            case 2:
                return "Task Baru Pada Proyek ".$this->proyek->project_name." Berhasil ditambahkan";
                break;
            
            default:
                # code...
                break;
        }
    }
}
