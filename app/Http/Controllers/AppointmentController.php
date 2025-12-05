<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use App\Models\SustainabilityLog;
use Illuminate\Http\Request;
class AppointmentController extends Controller
{

    public function create(Request $request) {
        $doctors = Doctor::all();
        return view('appointments.create', compact('doctors'));
    }
    public function index() {
        $appointments = Appointment::with('doctor')->where('user_id', auth()->id())->orderBy('date','desc')->get();
        return view('appointments.index', compact('appointments'));
    }
    
    public function store(Request $request) {
        try {
            $data = $request->validate([
                'doctor_id' => 'required|exists:doctors,id',
                'date' => 'required|date|after_or_equal:today',
                'time' => 'required',
                'is_remote' => 'nullable|in:0,1'
            ], [
                'doctor_id.required' => 'Please select a doctor.',
                'doctor_id.exists' => 'The selected doctor does not exist.',
                'date.required' => 'Please select an appointment date.',
                'date.date' => 'Please enter a valid date.',
                'date.after_or_equal' => 'Appointment date must be today or in the future.',
                'time.required' => 'Please select an appointment time.',
                'is_remote.in' => 'Invalid appointment type selected.'
            ]);
        
            // Convert is_remote to boolean (default to false if not provided)
            $isRemote = $request->has('is_remote') && ($request->input('is_remote') == '1' || $request->input('is_remote') === 1 || $request->input('is_remote') === true);
        
            $appointment = Appointment::create([
                'user_id' => auth()->id(),
                'doctor_id' => $data['doctor_id'],
                'date' => $data['date'],
                'time' => $data['time'],
                'status' => 'confirmed', // Set status to confirmed when booking
                'is_remote' => $isRemote
            ]);
        
            if ($appointment->is_remote) {
                $user = auth()->user();
                $user->carbon_saving = ($user->carbon_saving ?? 0) + 2.5;
                $user->eco_friendly_bookings = ($user->eco_friendly_bookings ?? 0) + 1;
                $user->rse_score = ($user->rse_score ?? 0) + 10;
                $user->save();
        
                SustainabilityLog::create([
                    'user_id' => $user->id,
                    'action' => 'Remote appointment',
                    'co2_saved' => 2.5,
                    'points' => 10
                ]);
            }
        
            return redirect()->route('appointments.index')->with('success','Appointment booked and confirmed successfully!');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'An error occurred while booking the appointment. Please try again.')
                ->withInput();
        }
    }
    
}

