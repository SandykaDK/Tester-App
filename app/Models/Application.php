<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'app_name',
        'app_description',
        'app_status',
        'app_key',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->app_key)) {
                $model->app_key = (string) Str::uuid();
            }
        });
    }

    public function developers()
    {
        return $this->hasMany(Developer::class, 'app_key', 'app_key');
    }

    public function testCases()
    {
        return $this->hasMany(TestCase::class, 'app_key', 'app_key');
    }

    public function appModuls()
    {
        return $this->hasMany(AppModul::class, 'app_key', 'app_key');
    }

    public function appMenus()
    {
        return $this->hasMany(AppMenu::class, 'app_key', 'app_key');
    }
}
