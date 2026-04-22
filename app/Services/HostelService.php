<?php

namespace App\Services;

use App\Models\Room;
use App\Models\HostelBooking;
use App\Models\HostelWaitlist;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Support\Str;

class HostelService
{
    /**
     * Book a room for a student
     */
    public function bookRoom(Room $room, array $studentData): HostelBooking
    {
        return DB::transaction(function () use ($room, $studentData) {
            // Check availability
            $activeBookings = $room->bookings()->whereIn('status', ['reserved', 'confirmed', 'checked_in'])->count();
            
            if ($activeBookings >= $room->capacity) {
                // Add to waitlist
                HostelWaitlist::create([
                    'room_id' => $room->id,
                    'student_name' => $studentData['student_name'],
                    'student_phone' => $studentData['student_phone'],
                    'student_email' => $studentData['student_email'] ?? null,
                    'intake_period' => $studentData['intake_period'],
                    'position' => $room->waitlists()->count() + 1,
                ]);
                throw new Exception("Room is fully booked. Student added to waitlist.");
            }

            $bookingReference = 'HB-' . strtoupper(Str::random(6));

            return HostelBooking::create([
                'booking_reference' => $bookingReference,
                'room_id' => $room->id,
                'student_name' => $studentData['student_name'],
                'student_phone' => $studentData['student_phone'],
                'student_email' => $studentData['student_email'] ?? null,
                'student_id_number' => $studentData['student_id_number'] ?? null,
                'university_registration_number' => $studentData['university_registration_number'] ?? null,
                'intake_period' => $studentData['intake_period'],
                'academic_year' => $studentData['academic_year'],
                'status' => 'reserved',
                'payment_status' => 'unpaid',
                'amount_due' => $room->price_per_semester,
                'amount_paid' => 0,
            ]);
        });
    }
}
