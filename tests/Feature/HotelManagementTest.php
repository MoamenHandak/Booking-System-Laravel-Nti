<?php

use App\Models\City;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a hotel', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);

    $response = $this->actingAs($admin)->post('/admin/hotels', [
        'city_id' => $city->id,
        'name' => 'Grand Palace',
        'address' => 'Downtown',
        'rating' => 4.8,
        'description' => 'Luxury stay',
    ]);

    $response->assertRedirect(route('admin.hotels.index'));
    $this->assertDatabaseHas('hotels', ['name' => 'Grand Palace']);
});

test('admin can update a hotel', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create([
        'city_id' => $city->id,
        'name' => 'Hotel 1',
        'address' => 'Old Address',
        'rating' => 4.0,
    ]);

    $response = $this->actingAs($admin)->put("/admin/hotels/{$hotel->id}", [
        'city_id' => $city->id,
        'name' => 'Hotel 1 Updated',
        'address' => 'New Address',
        'rating' => 4.5,
    ]);

    $response->assertRedirect(route('admin.hotels.index'));
    $this->assertDatabaseHas('hotels', ['id' => $hotel->id, 'name' => 'Hotel 1 Updated']);
});

test('admin can delete a hotel', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create([
        'city_id' => $city->id,
        'name' => 'Hotel To Delete',
    ]);

    $response = $this->actingAs($admin)->delete("/admin/hotels/{$hotel->id}");

    $response->assertRedirect(route('admin.hotels.index'));
    $this->assertSoftDeleted('hotels', ['id' => $hotel->id]);
});
