<?php

namespace Modules\System\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AccountLevel extends Model
{
    use HasFactory;

    protected $fillable = [
        'account_level_code',
        'account_level_name',
        'module_store',
        'module_update',
        'module_delete',
        'module_export',
        'module_import',
        'created_by',
        'updated_by',
    ];

    
    protected static function newFactory()
    {
        return \Modules\System\Database\factories\AccountLevelFactory::new();
    }
}
