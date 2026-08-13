<?php

use App\Models\City;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a new city', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->actingAs($admin)->post('/admin/cities', [
        'name' => 'Alexandria',
    ]);

    $response->assertRedirect(route('admin.cities.index'));
    $this->assertDatabaseHas('cities', ['name' => 'Alexandria']);
});

test('admin can update an existing city', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Old Name']);

    $response = $this->actingAs($admin)->put("/admin/cities/{$city->id}", [
        'name' => 'New Name',
    ]);

    $response->assertRedirect(route('admin.cities.index'));
    $this->assertDatabaseHas('cities', ['id' => $city->id, 'name' => 'New Name']);
});

test('admin can delete a city', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Temporary City']);

    $response = $this->actingAs($admin)->delete("/admin/cities/{$city->id}");

    $response->assertRedirect(route('admin.cities.index'));
    $this->assertSoftDeleted('cities', ['id' => $city->id]);
});
