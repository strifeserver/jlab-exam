<?php

namespace Modules\System\Entities;

use Illuminate\Foundation\Auth\User as Authenticatable; // Import Authenticatable
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable // Extend Authenticatable
{
    use HasFactory;
    use HasApiTokens;

    protected $fillable = [];

    protected $table = 'accounts';

    protected static function newFactory()
    {
        return \Modules\System\Database\Factories\UserFactory::new();
    }
}
