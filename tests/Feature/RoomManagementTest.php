<?php

use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can create a room', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create(['city_id' => $city->id, 'name' => 'Nile Hotel']);

    $response = $this->actingAs($admin)->post('/admin/rooms', [
        'hotel_id' => $hotel->id,
        'type' => 'Deluxe Suite',
        'price' => 200.00,
        'capacity' => 2,
        'is_available' => 1,
    ]);

    $response->assertRedirect(route('admin.rooms.index'));
    $this->assertDatabaseHas('rooms', ['type' => 'Deluxe Suite', 'price' => 200.00]);
});

test('admin can update a room', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create(['city_id' => $city->id, 'name' => 'Nile Hotel']);
    $room = Room::create([
        'hotel_id' => $hotel->id,
        'type' => 'Standard Room',
        'price' => 100.00,
        'capacity' => 2,
        'is_available' => true,
    ]);

    $response = $this->actingAs($admin)->put("/admin/rooms/{$room->id}", [
        'hotel_id' => $hotel->id,
        'type' => 'Executive Suite',
        'price' => 300.00,
        'capacity' => 3,
        'is_available' => 1,
    ]);

    $response->assertRedirect(route('admin.rooms.index'));
    $this->assertDatabaseHas('rooms', ['id' => $room->id, 'type' => 'Executive Suite', 'price' => 300.00]);
});

test('admin can delete a room', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create(['city_id' => $city->id, 'name' => 'Nile Hotel']);
    $room = Room::create([
        'hotel_id' => $hotel->id,
        'type' => 'Single Room',
        'price' => 80.00,
        'capacity' => 1,
        'is_available' => true,
    ]);

    $response = $this->actingAs($admin)->delete("/admin/rooms/{$room->id}");

    $response->assertRedirect(route('admin.rooms.index'));
    $this->assertSoftDeleted('rooms', ['id' => $room->id]);
});
