@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="space-y-6">
  <!-- Welcome Section -->
  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow-lg p-6 border border-indigo-100">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold mb-2 text-gray-900">Welcome back, {{ auth()->user()->name }}!</h1>
        <p class="text-gray-700">Here's what's happening with your appointments today.</p>
      </div>
      <div class="hidden md:block">
        <svg class="w-24 h-24 opacity-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
          <path d="M10.394 2.08a1 1 0 00-.788 0l-7 3a1 1 0 000 1.84L5.25 8.051a.999.999 0 01.356-.384l3-1.5a1 1 0 00.788 0l3 1.5a.999.999 0 01.356.384l1.644.82a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-7-3zM3.297 6.01l-1.644.82a1 1 0 000 1.84l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-1.644-.82a1 1 0 00-.788 0l-3 1.5a.999.999 0 01-.356.384l-1.644.82a1 1 0 00-.788 0l-1.644-.82a.999.999 0 01-.356-.384l-3-1.5a1 1 0 00-.788 0l-3 1.5zM5.25 12.051l-1.644.82a1 1 0 000 1.84l7 3a1 1 0 00.788 0l7-3a1 1 0 000-1.84l-1.644-.82a1 1 0 00-.788 0l-3 1.5a.999.999 0 01-.356.384l-1.644.82a1 1 0 00-.788 0l-1.644-.82a.999.999 0 01-.356-.384l-3-1.5a1 1 0 00-.788 0l-3 1.5z"></path>
        </svg>
      </div>
    </div>
  </div>

  <!-- Statistics Cards -->
  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
    <!-- Total Appointments -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600 mb-1">Total Appointments</p>
          <p class="text-3xl font-bold text-gray-900">{{ $totalAppointments ?? 0 }}</p>
        </div>
        <div class="bg-indigo-100 rounded-full p-3">
          <svg class="w-8 h-8 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
        </div>
      </div>
    </div>

    <!-- Upcoming Appointments -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600 mb-1">Upcoming</p>
          <p class="text-3xl font-bold text-gray-900">{{ $upcomingAppointments ?? 0 }}</p>
        </div>
        <div class="bg-green-100 rounded-full p-3">
          <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      </div>
    </div>

    <!-- CO₂ Saved -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-emerald-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600 mb-1">CO₂ Saved</p>
          <p class="text-3xl font-bold text-gray-900">{{ number_format(auth()->user()->carbon_saving ?? 0, 1) }}<span class="text-lg text-gray-500"> kg</span></p>
        </div>
        <div class="bg-emerald-100 rounded-full p-3">
          <svg class="w-8 h-8 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
          </svg>
        </div>
      </div>
    </div>

    <!-- RSE Score -->
    <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500 hover:shadow-lg transition-shadow">
      <div class="flex items-center justify-between">
        <div>
          <p class="text-sm font-medium text-gray-600 mb-1">RSE Score</p>
          <p class="text-3xl font-bold text-gray-900">{{ auth()->user()->rse_score ?? 0 }}</p>
        </div>
        <div class="bg-yellow-100 rounded-full p-3">
          <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
          </svg>
        </div>
      </div>
    </div>
  </div>

  <!-- Main Content Grid -->
  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Appointments -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow-md p-6">
      <div class="flex items-center justify-between mb-6">
        <h2 class="text-xl font-bold text-gray-900">Recent Appointments</h2>
        <a href="{{ route('appointments.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">View all →</a>
      </div>

      @if(isset($appointments) && $appointments->count() > 0)
        <div class="space-y-4">
          @foreach($appointments as $appointment)
            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
              <div class="flex items-center space-x-4 flex-1">
                <div class="flex-shrink-0">
                  <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                  </div>
                </div>
                <div class="flex-1 min-w-0">
                  <p class="text-sm font-semibold text-gray-900 truncate">
                    {{ $appointment->doctor->name ?? 'Unknown Doctor' }}
                  </p>
                  <p class="text-xs text-gray-500 mt-1">
                    {{ $appointment->doctor->speciality ?? $appointment->doctor->specialty ?? 'General Medicine' }}
                  </p>
                  <div class="flex items-center space-x-3 mt-2">
                    <span class="text-xs text-gray-500">
                      📅 {{ $appointment->date->format('M d, Y') }}
                    </span>
                    <span class="text-xs text-gray-500">
                      🕐 {{ \Carbon\Carbon::parse($appointment->time)->format('g:i A') }}
                    </span>
                  </div>
                </div>
              </div>
              <div class="flex items-center space-x-3">
                @if($appointment->is_remote)
                  <span class="px-2 py-1 text-xs font-medium bg-green-100 text-green-800 rounded-full">Remote</span>
                @endif
                <span class="px-3 py-1 text-xs font-medium rounded-full
                  @if($appointment->status == 'confirmed') bg-green-100 text-green-800
                  @elseif($appointment->status == 'completed') bg-blue-100 text-blue-800
                  @elseif($appointment->status == 'cancelled') bg-red-100 text-red-800
                  @else bg-yellow-100 text-yellow-800
                  @endif">
                  {{ ucfirst($appointment->status) }}
                </span>
              </div>
            </div>
          @endforeach
        </div>
      @else
        <div class="text-center py-12">
          <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
          </svg>
          <h3 class="mt-2 text-sm font-medium text-gray-900">No appointments</h3>
          <p class="mt-1 text-sm text-gray-500">Get started by booking your first appointment.</p>
          <div class="mt-6">
            <a href="{{ route('appointments.create') }}" class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-gray-500 bg-indigo-600 hover:bg-indigo-700">
              Book Appointment
            </a>
          </div>
        </div>
      @endif
    </div>

    <!-- Quick Actions & Stats -->
    <div class="space-y-6">
      <!-- Quick Actions -->
      <div class="bg-white rounded-xl shadow-md p-6">
        <h2 class="text-xl font-bold text-gray-900 mb-4">Quick Actions</h2>
        <div class="space-y-3">
          <a href="{{ route('appointments.create') }}" class="flex items-center space-x-3 p-3 bg-indigo-50 rounded-lg hover:bg-indigo-100 transition-colors group">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-indigo-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-500">Book Appointment</span>
          </a>
          <a href="{{ route('doctors.index') }}" class="flex items-center space-x-3 p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors group">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-gray-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">Find Doctors</span>
          </a>
          <a href="{{ route('rse.dashboard') }}" class="flex items-center space-x-3 p-3 bg-green-50 rounded-lg hover:bg-green-100 transition-colors group">
            <div class="flex-shrink-0">
              <svg class="w-5 h-5 text-green-600 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
              </svg>
            </div>
            <span class="text-sm font-medium text-gray-900">Sustainability</span>
          </a>
        </div>
      </div>

      <!-- Sustainability Stats -->
      <div class="bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl shadow-md p-6 border border-green-100">
        <h2 class="text-lg font-bold text-gray-900 mb-4">Sustainability Impact</h2>
        <div class="space-y-4">
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-gray-700">Eco Bookings</span>
              <span class="text-lg font-bold text-green-700">{{ auth()->user()->eco_friendly_bookings ?? 0 }}</span>
            </div>
            <div class="w-full bg-green-200 rounded-full h-2">
              <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, ((auth()->user()->eco_friendly_bookings ?? 0) / max(1, ($totalAppointments ?? 1))) * 100) }}%"></div>
            </div>
          </div>
          <div>
            <div class="flex items-center justify-between mb-2">
              <span class="text-sm font-medium text-gray-700">Local Businesses</span>
              <span class="text-lg font-bold text-green-700">{{ auth()->user()->local_businesses_supported ?? 0 }}</span>
            </div>
            <div class="w-full bg-green-200 rounded-full h-2">
              <div class="bg-green-600 h-2 rounded-full" style="width: {{ min(100, ((auth()->user()->local_businesses_supported ?? 0) / max(1, ($totalAppointments ?? 1))) * 100) }}%"></div>
                </div>
            </div>
        </div>
        <a href="{{ route('rse.dashboard') }}" class="mt-4 inline-block text-sm text-green-700 hover:text-green-800 font-medium">
          View full report →
        </a>
        </div>
    </div>
  </div>
</div>
@endsection
