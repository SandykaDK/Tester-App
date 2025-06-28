<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\AppMenu;

class ScreenFormat extends Model
{
    protected $table = 'screenformats';

    protected $fillable = [
        'id_scr_format',
        'scr_name',
        'menu_id',
        'scr_version',
        'scr_description',
    ];

    public function menu()
    {
        return $this->belongsTo(AppMenu::class, 'menu_id');
    }
}
