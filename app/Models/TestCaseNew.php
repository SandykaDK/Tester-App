<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestCaseNew extends Model
{
    protected $guarded = [];
    protected $table = 'test_cases_new';

    public function application()
    {
        return $this->belongsTo(Application::class, 'app_key', 'id'); // Reverted from application_id
    }

    public function module()
    {
        return $this->belongsTo(AppModul::class, 'modul_key', 'id'); // Reverted from modul_id
    }

    public function menu()
    {
        return $this->belongsTo(AppMenu::class, 'menu_key', 'id'); // Reverted from menu_id
    }

    public function developer()
    {
        return $this->belongsTo(Developer::class, 'pic_dev', 'id');
    }
}
