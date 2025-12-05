@extends('layouts.app')

@section('title','Doctors')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="flex items-center justify-between">
    <div>
      <h1 class="text-3xl font-bold text-gray-900">Find a Doctor</h1>
      <p class="text-gray-600 mt-1">Browse our network of healthcare professionals</p>
    </div>
    <a href="{{ route('appointments.create') }}" class="px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105 flex items-center space-x-2">
      <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
      </svg>
      <span class="text-gray-500">Book Appointment</span>
    </a>
  </div>

  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @foreach($doctors as $doctor)
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-lg transition-all">
      <div class="flex items-start justify-between">
        <div class="flex-1">
          <div class="flex items-start space-x-3 mb-3">
            <div class="flex-shrink-0">
              <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
            </div>
            <div class="flex-1 min-w-0">
              <h2 class="text-lg font-bold text-gray-900 mb-1">{{ $doctor->name }}</h2>
              <p class="text-sm font-medium text-gray-600">{{ $doctor->speciality ?? $doctor->specialty ?? 'General Medicine' }}</p>
            </div>
          </div>

          <div class="flex flex-wrap gap-2 mb-4">
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

          @if($doctor->rse_score ?? false)
            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg mb-4">
              <span class="text-sm font-medium text-gray-600">RSE Score</span>
              <span class="text-lg font-bold text-indigo-600">{{ $doctor->rse_score }}</span>
            </div>
          @endif
        </div>
      </div>

      <div class="pt-4 border-t border-gray-100">
        <a href="{{ route('doctors.show', $doctor) }}" class="w-full flex items-center justify-center px-4 py-2 bg-indigo-50 text-indigo-700 font-semibold rounded-lg hover:bg-indigo-100 transition-colors">
          View Details
          <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection
