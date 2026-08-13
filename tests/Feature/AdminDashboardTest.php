<?php

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('unauthenticated users are redirected from admin dashboard', function () {
    $response = $this->get('/admin/dashboard');
    $response->assertRedirect('/login');
});

test('regular users cannot access admin dashboard', function () {
    $user = User::factory()->create(['role' => 'user']);

    $response = $this->actingAs($user)->get('/admin/dashboard');
    $response->assertStatus(403);
});

test('admin users can access dashboard and management pages', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)->get('/admin/dashboard')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/cities')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/hotels')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/rooms')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/bookings')->assertStatus(200);
    $this->actingAs($admin)->get('/admin/reports')->assertStatus(200);
});
