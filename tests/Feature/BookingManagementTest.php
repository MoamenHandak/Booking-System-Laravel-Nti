<?php

use App\Models\Booking;
use App\Models\City;
use App\Models\Hotel;
use App\Models\Room;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

test('admin can approve, check in, check out, or reject a booking', function () {
    $admin = User::factory()->create(['role' => 'admin']);
    $user = User::factory()->create();
    $city = City::create(['name' => 'Cairo']);
    $hotel = Hotel::create(['city_id' => $city->id, 'name' => 'Nile Hotel']);
    $room = Room::create([
        'hotel_id' => $hotel->id,
        'type' => 'Deluxe',
        'price' => 150.00,
        'capacity' => 2,
        'is_available' => true,
    ]);

    $booking = Booking::create([
        'room_id' => $room->id,
        'user_id' => $user->id,
        'check_in_date' => '2026-09-01',
        'check_out_date' => '2026-09-05',
        'total_price' => 600.00,
        'status' => 'pending',
    ]);

    // 1. Approve
    $this->actingAs($admin)->post("/bookings/{$booking->id}/approve")->assertSessionHas('success');
    $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'approved']);

    // 2. Check in
    $this->actingAs($admin)->post("/bookings/{$booking->id}/check-in")->assertSessionHas('success');
    $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'checked_in']);

    // 3. Check out
    $this->actingAs($admin)->post("/bookings/{$booking->id}/check-out")->assertSessionHas('success');
    $this->assertDatabaseHas('bookings', ['id' => $booking->id, 'status' => 'checked_out']);

    // 4. Reject test on another booking
    $booking2 = Booking::create([
        'room_id' => $room->id,
        'user_id' => $user->id,
        'check_in_date' => '2026-10-01',
        'check_out_date' => '2026-10-05',
        'total_price' => 600.00,
        'status' => 'pending',
    ]);

    $this->actingAs($admin)->post("/bookings/{$booking2->id}/reject")->assertSessionHas('success');
    $this->assertDatabaseHas('bookings', ['id' => $booking2->id, 'status' => 'rejected']);
});
