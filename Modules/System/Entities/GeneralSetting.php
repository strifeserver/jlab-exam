<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'setting_name',
        'setting_value',
        'setting_images',
        'setting_status',
    ];

    protected static function newFactory()
    {
        return \Modules\System\Database\factories\GeneralSettingFactory::new();
    }
}
