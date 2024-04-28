<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Webpatser\Uuid\Uuid;

class Fitur extends Model
{
    use HasFactory;
    protected $table = 'fitur';
    protected $guarded = ['id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = (string) Uuid::generate(4);
        });
    }

    public function skenario()
    {
        return $this->hasMany(Skenario::class, 'fitur_id', 'id');
    }

    public function total_test_case()
    {
        $happyCaseCount = $this->skenario->flatMap->test_case
            ->count();

        return $happyCaseCount;
    }
    public function success()
    {
        // Mengambil semua test_case yang terkait dengan skenario-skenario dari Fitur ini
        $test_case = $this->skenario->flatMap(function ($skenario) {
            return $skenario->test_case;
        });

        $jml = 0;
        foreach ($test_case as $tc) {
            if ($tc->status_test_step1() === 'success') {
                $jml = $jml + 1;
            }
        }
        return $jml * (100 / $this->total_test_case()) . '%';
    }

    public function failed()
    {
        // Mengambil semua test_case yang terkait dengan skenario-skenario dari Fitur ini
        $test_case = $this->skenario->flatMap(function ($skenario) {
            return $skenario->test_case;
        });

        $jml = 0;
        foreach ($test_case as $tc) {
            if ($tc->status_test_step1() === 'failed') {
                $jml = $jml + 1;
            }
        }
        return $jml * (100 / $this->total_test_case()) . '%';
    }

    public function notTested()
    {
        // Mengambil semua test_case yang terkait dengan skenario-skenario dari Fitur ini
        $test_case = $this->skenario->flatMap(function ($skenario) {
            return $skenario->test_case;
        });

        $jml = 0;
        foreach ($test_case as $tc) {
            if ($tc->status_test_step1() === 'not tested') {
                $jml = $jml + 1;
            }
        }
        return $jml * (100 / $this->total_test_case()) . '%';
    }
}
