<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminLoginTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_login_using_default_credentials(): void
    {
        $this->seed();

        $response = $this->post(route('admin.login.store'), [
            'username' => config('admin.username'),
            'password' => config('admin.password'),
        ]);

        $response->assertRedirect(route('admin.lomba'));
        $this->assertAuthenticated();
    }
}
