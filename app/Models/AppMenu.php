<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AppMenu extends Model
{
    use HasFactory;

    protected $table = 'app_menus';

    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->menu_key)) {
                $model->menu_key = (string) Str::uuid();
            }
        });
    }

    public function appModul()
    {
        return $this->belongsTo(AppModul::class, 'modul_key', 'modul_key');
    }

    public function testCases()
    {
        return $this->hasMany(TestCase::class, 'menu_key', 'menu_key');
    }

    public function application()
    {
        return $this->belongsTo(Application::class);
    }

    public function module()
    {
        return $this->belongsTo(AppModul::class, 'modul_id', 'id');
    }
}
