@extends('layouts.app')

@section('title','Doctor Details')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow-lg p-6 border border-indigo-100">
    <div class="flex items-center justify-between">
      <div class="flex-1">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ $doctor->name }}</h1>
        <p class="text-lg font-medium text-gray-700">{{ $doctor->speciality ?? $doctor->specialty ?? 'General Medicine' }}</p>
      </div>
      <a href="{{ route('appointments.create', ['doctor_id' => $doctor->id]) }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105 flex items-center space-x-2">
        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span class="text-gray-500">Book Appointment</span>
      </a>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Main Information -->
    <div class="lg:col-span-2 space-y-6">
      <!-- Information Card -->
      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Information</h2>
        <div class="space-y-4">
          @if($doctor->email)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
              </svg>
              <div>
                <span class="text-sm font-medium text-gray-500">Email</span>
                <p class="text-gray-900 font-medium">{{ $doctor->email }}</p>
              </div>
            </div>
          @endif
          @if($doctor->phone)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
              </svg>
              <div>
                <span class="text-sm font-medium text-gray-500">Phone</span>
                <p class="text-gray-900 font-medium">{{ $doctor->phone }}</p>
              </div>
            </div>
          @endif
          @if($doctor->address)
            <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg">
              <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <div>
                <span class="text-sm font-medium text-gray-500">Address</span>
                <p class="text-gray-900 font-medium">{{ $doctor->address }}</p>
              </div>
            </div>
          @endif
          @if($doctor->bio)
            <div class="p-4 bg-gray-50 rounded-lg">
              <span class="text-sm font-medium text-gray-500 block mb-2">Bio</span>
              <p class="text-gray-700 leading-relaxed">{{ $doctor->bio }}</p>
            </div>
          @endif
        </div>
      </div>
    </div>

    <!-- RSE Features Sidebar -->
    <div class="space-y-6">
      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
        <h2 class="text-xl font-bold text-gray-900 mb-4">RSE Features</h2>
        <div class="space-y-4">
          <div class="p-4 bg-gray-50 rounded-lg">
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-gray-600">RSE Score</span>
              <span class="text-2xl font-bold text-indigo-600">{{ $doctor->rse_score ?? 'N/A' }}</span>
            </div>
            <div class="w-full bg-gray-200 rounded-full h-2">
              <div class="bg-indigo-600 h-2 rounded-full" style="width: {{ min(100, ($doctor->rse_score ?? 0)) }}%"></div>
            </div>
          </div>
          
          <div class="space-y-2">
            <p class="text-sm font-semibold text-gray-700 mb-3">Features</p>
            <div class="flex flex-wrap gap-2">
              @if($doctor->is_eco_friendly ?? false)
                @include('components.badge', ['label' => 'Eco-Friendly', 'color' => 'green'])
              @endif
              @if($doctor->is_local_business ?? false)
                @include('components.badge', ['label' => 'Local Business', 'color' => 'indigo'])
              @endif
              @if($doctor->is_accessible ?? false)
                @include('components.badge', ['label' => 'Accessible', 'color' => 'yellow'])
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
