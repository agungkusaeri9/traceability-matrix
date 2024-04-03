<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Repository extends Model
{
    use HasFactory;
    protected $table = 'repository';
    protected $guarded = ['id'];

    public function getFile()
    {
        return asset('storage/' . $this->file);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
    public function getUkuran()
    {
        $ukuran_kb = $this->attributes['ukuran'] / 1024; // Konversi dari byte ke KB
        if ($ukuran_kb >= 1000) {
            return round($ukuran_kb / 1024, 2) . ' MB'; // Konversi dari KB ke MB
        } else {
            return round($ukuran_kb, 2) . ' KB'; // Tampilkan dalam KB
        }
    }
}
