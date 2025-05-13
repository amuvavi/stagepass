<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\Users;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminUsersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_user_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        User::factory()->count(3)->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->assertStatus(200);
    }

    /** @test */
    public function it_deletes_a_user()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->call('deleteUser', ['id' => $user->id])
            ->assertDispatched('user-deleted');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /** @test */
    public function it_sets_edit_user_id()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();

        Livewire::actingAs($admin)
            ->test(Users::class)
            ->call('editUser', $user->id)
            ->assertSet('editUserId', $user->id);
    }
}
