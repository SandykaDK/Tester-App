<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Developer extends Model
{
    use HasFactory;

    protected $fillable = [
        'dev_name',
        'dev_email',
        'dev_key'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->dev_key)) {
                $model->dev_key = (string) Str::uuid();
            }
        });
    }

    public function testCases()
    {
        return $this->hasMany(TestCase::class, 'dev_key', 'dev_key');
    }

    public function applications()
    {
        return $this->belongsToMany(Application::class, 'developer_application');
    }
}
