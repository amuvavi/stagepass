<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use App\Services\UserRoleService;

class UserRoleServiceTest extends TestCase
{
    /** @test */
    public function it_recognizes_admin_users()
    {
        $admin = new User(['role' => 'admin']);
        $this->assertTrue(UserRoleService::isAdmin($admin));
    }

    /** @test */
    public function it_recognizes_non_admin_users()
    {
        $user = new User(['role' => 'user']);
        $this->assertFalse(UserRoleService::isAdmin($user));
    }
}