<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class BugReport extends Model
{
    use HasFactory;
    protected $table = 'bug_report';
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

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

    public function status()
    {
        if ($this->status == 0) {
            return 'ON HOLD';
        } elseif ($this->status == 1) {
            return 'ON DOING';
        } else {
            return 'DONE';
        }
    }
}
