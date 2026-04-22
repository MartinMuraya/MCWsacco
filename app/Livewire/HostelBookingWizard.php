<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Hostel;
use App\Models\Room;
use App\Models\UniversityIntake;
use App\Services\HostelService;

class HostelBookingWizard extends Component
{
    public $step = 1;
    
    public $hostel_id;
    public $room_id;

    public function mount()
    {
        $defaultHostel = Hostel::where('name', 'LIKE', '%Sunrise%')->first() ?? Hostel::first();
        if ($defaultHostel) {
            $this->hostel_id = $defaultHostel->id;
        }
    }
    
    public $student_name;
    public $student_phone;
    public $student_email;
    public $intake_period;
    public $academic_year;
    
    public $booking_error = null;
    
    public function nextStep()
    {
        $this->validateStep();
        $this->step++;
    }
    
    public function previousStep()
    {
        $this->step--;
    }
    
    public function validateStep()
    {
        if ($this->step === 1) {
            $this->validate([
                'hostel_id' => 'required|exists:hostels,id',
                'room_id' => 'required|exists:rooms,id',
            ]);
        } elseif ($this->step === 2) {
            $this->validate([
                'student_name' => 'required|string|max:255',
                'student_phone' => 'required|string|max:20',
                'student_email' => 'required|email',
                'intake_period' => 'required|string',
                'academic_year' => 'required|string',
            ]);
        }
    }
    
    public function submit()
    {
        $this->validateStep();
        
        $room = Room::find($this->room_id);
        $service = app(HostelService::class);
        
        try {
            $service->bookRoom($room, [
                'student_name' => $this->student_name,
                'student_phone' => $this->student_phone,
                'student_email' => $this->student_email,
                'intake_period' => $this->intake_period,
                'academic_year' => $this->academic_year,
            ]);
            
            $this->step = 4; // Success
            
        } catch (\Exception $e) {
            if (str_contains($e->getMessage(), 'waitlist')) {
                $this->step = 5; // Waitlist success
            } else {
                $this->booking_error = $e->getMessage();
                $this->step = 3; // Stay on submit step but show error
            }
        }
    }

    public function render()
    {
        $hostels = Hostel::all();
        $selectedHostel = $this->hostel_id ? Hostel::find($this->hostel_id) : null;
        $rooms = $this->hostel_id ? Room::where('hostel_id', $this->hostel_id)->where('is_active', true)->get() : collect([]);
        $intakes = UniversityIntake::where('is_active', true)->get();
        
        return view('livewire.hostel-booking-wizard', [
            'hostels' => $hostels,
            'hostel' => $selectedHostel,
            'rooms' => $rooms,
            'intakes' => $intakes,
        ]);
    }
}
