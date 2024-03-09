<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class TestCase extends Model
{
    use HasFactory;
    protected $table = 'test_case';
    protected $guarded = ['id'];

    public function skenario()
    {
        return $this->belongsTo(Skenario::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
