<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class TestStep extends Model
{
    use HasFactory;
    protected $table = 'test_step';
    protected $guarded = ['id'];

    public function test_case()
    {
        return $this->belongsTo(TestCase::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
