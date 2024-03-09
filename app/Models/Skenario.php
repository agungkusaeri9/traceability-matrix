<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Skenario extends Model
{
    use HasFactory;

    protected $table = 'skenario';
    protected $guarded = ['id'];

    public function fitur()
    {
        return $this->belongsTo(Fitur::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
