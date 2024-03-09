<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Project extends Model
{
    use HasFactory;
    protected $table = 'project';
    protected $guarded = ['id'];
    public $casts = [
        'assign_date' => 'datetime'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function status()
    {
        if ($this->status == 0) {
            return 'ON PROGRESS';
        } else {
            return 'DONE';
        }
    }

    public function presentase()
    {
        return '10%';
    }

    public function teams()
    {
        return $this->hasMany(ProjectTeam::class, 'project_id', 'id');
    }

    public function fitur()
    {
        return $this->hasMany(Fitur::class, 'project_id', 'id');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }
}
