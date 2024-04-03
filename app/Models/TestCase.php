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

    public function test_step()
    {
        return $this->hasMany(TestStep::class, 'test_case_id', 'id');
    }

    public function tipe()
    {
        if ($this->tipe === 'Happy Case') {
            return '<span class="badge badge-success">Happy Case</span>';
        } else {
            return '<span class="badge badge-danger">UnHappy Case</span>';
        }
    }

    public function status_test_step()
    {
        $status_failed = $this->hasMany(TestStep::class, 'test_case_id', 'id')->whereIn('status', [0, 2]);
        if ($status_failed->count() > 0) {
            return '<span class="badge badge-danger">UnHappy Case</span>';
        } else {
            return '<span class="badge badge-success">Happy Case</span>';
        }
    }
}
