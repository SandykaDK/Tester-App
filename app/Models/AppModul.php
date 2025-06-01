<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppModul extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->modul_key)) {
                $model->modul_key = (string) Str::uuid();
            }
        });
    }

    public function application()
    {
        return $this->belongsTo(Application::class, 'application_id', 'id'); // Ensure 'application_id' is used correctly
    }

    public function testCases()
    {
        return $this->hasMany(TestCase::class, 'modul_id', 'id'); // Ensure 'modul_id' is used correctly
    }

    public function appMenus()
    {
        return $this->hasMany(AppMenu::class, 'modul_key', 'modul_key');
    }
}
