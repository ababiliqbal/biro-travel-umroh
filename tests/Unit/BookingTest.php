<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Booking;
use Tests\TestCase;

class BookingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_can_show_all_bookings()
    {
        Booking::factory()->count(3)->create();

        $response = $this->get('/bookings');
        $response->assertSee('Bookings List');
    }

    /** @test */
    public function it_can_create_a_booking()
    {
        $bookingData = [
            'user_id' => 1,
            'package_id' => 2,
            'registered_by' => 5,
            'status' => 'active',
            'total_price' => 1500000,
        ];

        $response = $this->post('/bookings', $bookingData);

        $response->assertRedirect('/bookings');
        $this->assertDatabaseHas('bookings', $bookingData);
    }

    /** @test */
    public function it_can_update_a_booking()
    {
        $booking = Booking::factory()->create();

        $data = [
            'user_id' => 99,
            'package_id' => 77,
            'registered_by' => 33,
            'status' => 'updated',
            'total_price' => 999999,
        ];

        $response = $this->put("/bookings/{$booking->id}", $data);

        $response->assertRedirect('/bookings');
        $this->assertDatabaseHas('bookings', $data);
    }

    /** @test */
    public function it_can_delete_a_booking()
    {
        $booking = Booking::factory()->create();

        $response = $this->delete("/bookings/{$booking->id}");

        $response->assertRedirect('/bookings');
        $this->assertDatabaseMissing('bookings', ['id' => $booking->id]);
    }
}
