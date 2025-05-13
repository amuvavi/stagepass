<?php

namespace App\Services;

use App\Models\User;

class UserRoleService
{
    public static function isAdmin(User $user): bool
    {
        return $user->role === 'admin';
    }

    public static function isCustomer(User $user): bool
    {
        return $user->role === 'user';
    }
}