@extends('layouts.app')

@section('title','My Appointments')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">My Appointments</h1>
      <p class="text-gray-600 mt-1">Manage and view all your scheduled appointments</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105 flex items-center space-x-2">
      <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      <span class="text-gray-500">Book New Appointment</span>
    </a>
  </div>

  @if($appointments->isEmpty())
    <div class="bg-white rounded-xl shadow-md p-12 text-center border border-gray-100">
      <div class="max-w-md mx-auto">
        <div class="bg-indigo-100 rounded-full p-4 w-20 h-20 mx-auto mb-4 flex items-center justify-center">
          <svg class="w-10 h-10 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
        <h3 class="text-xl font-semibold text-gray-900 mb-2">No Appointments Yet</h3>
        <p class="text-gray-600 mb-6">You don't have any appointments scheduled. Book your first appointment to get started.</p>
        <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all">
          <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
          </svg>
          Book Your First Appointment
        </a>
      </div>
    </div>
  @else
    <div class="grid grid-cols-1 gap-4">
      @foreach($appointments as $appointment)
        <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-lg transition-all">
          <div class="flex items-start justify-between">
            <div class="flex items-start space-x-4 flex-1">
              <div class="flex-shrink-0">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                  <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                  </svg>
                </div>
              </div>
              <div class="flex-1 min-w-0">
                <div class="flex items-center space-x-3 mb-2">
                  <h2 class="text-xl font-bold text-gray-900">{{ $appointment->doctor->name ?? 'Unknown Doctor' }}</h2>
                  <span class="px-3 py-1 rounded-full text-xs font-semibold
                    @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                    @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                    @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                    @else bg-yellow-100 text-yellow-800
                    @endif">
                    {{ ucfirst($appointment->status) }}
                  </span>
                  @if($appointment->is_remote)
                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 flex items-center space-x-1">
                      <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                      </svg>
                      <span>Remote</span>
                    </span>
                  @endif
                </div>
                
                <p class="text-sm font-medium text-gray-600 mb-3">
                  {{ $appointment->doctor->speciality ?? $appointment->doctor->specialty ?? 'General Medicine' }}
                </p>
                
                <div class="flex items-center space-x-6 text-sm text-gray-600">
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    <span class="font-medium">{{ $appointment->date->format('M d, Y') }}</span>
                  </div>
                  <div class="flex items-center space-x-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span class="font-medium">{{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @endif
</div>
@endsection
