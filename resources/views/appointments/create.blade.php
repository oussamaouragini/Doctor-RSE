@extends('layouts.app')

@section('title','Book Appointment')

@section('content')
<div class="max-w-3xl mx-auto">
  <div class="bg-white rounded-xl shadow-lg p-8 border border-gray-100">
    <div class="mb-6">
      <h2 class="text-2xl font-bold text-gray-900 mb-2">Book an Appointment</h2>
      <p class="text-sm text-gray-600">Schedule your appointment with a healthcare provider</p>
    </div>

    <form action="{{ route('appointments.store') }}" method="POST" id="appointment-form">
      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Select Doctor <span class="text-red-500">*</span>
          </label>
          <select name="doctor_id" id="doctor_id" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('doctor_id') border-red-500 @enderror">
            <option value="">-- Choose a doctor --</option>
            @foreach($doctors as $doc)
              <option value="{{ $doc->id }}" @if(old('doctor_id', request('doctor_id')) == $doc->id) selected @endif>
                {{ $doc->name }} — {{ $doc->speciality ?? $doc->specialty ?? 'General Medicine' }}
              </option>
            @endforeach
          </select>
          @error('doctor_id')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="date" class="block text-sm font-semibold text-gray-700 mb-2">
            Appointment Date <span class="text-red-500">*</span>
          </label>
          <input 
            type="date" 
            id="date"
            name="date" 
            value="{{ old('date') }}"
            min="{{ date('Y-m-d') }}"
            required 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('date') border-red-500 @enderror"
          >
          @error('date')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div>
          <label for="time" class="block text-sm font-semibold text-gray-700 mb-2">
            Appointment Time <span class="text-red-500">*</span>
          </label>
          <input 
            type="time" 
            id="time"
            name="time" 
            value="{{ old('time') }}"
            required 
            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors @error('time') border-red-500 @enderror"
          >
          @error('time')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>

        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-2">
            Appointment Type
          </label>
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-indigo-300 transition-colors {{ old('is_remote', '0') == '0' ? 'border-indigo-500 bg-indigo-50' : '' }}" id="remote-0">
              <input type="radio" name="is_remote" value="0" class="sr-only" {{ old('is_remote', '0') == '0' ? 'checked' : '' }} required>
              <div class="flex-1">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                  </svg>
                  <span class="font-medium text-gray-900">In-Person</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Visit the doctor's office</p>
              </div>
            </label>
            
            <label class="relative flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:border-green-300 transition-colors {{ old('is_remote') == '1' ? 'border-green-500 bg-green-50' : '' }}" id="remote-1">
              <input type="radio" name="is_remote" value="1" class="sr-only" {{ old('is_remote') == '1' ? 'checked' : '' }}>
              <div class="flex-1">
                <div class="flex items-center">
                  <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                  </svg>
                  <span class="font-medium text-gray-900">Remote</span>
                  <span class="ml-2 px-2 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">Eco-Friendly</span>
                </div>
                <p class="text-xs text-gray-500 mt-1">Video consultation — saves CO₂</p>
              </div>
            </label>
          </div>
          @error('is_remote')
            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
          @enderror
        </div>
      </div>

      <div class="mt-8 pt-6 border-t border-gray-200 flex items-center justify-between">
        <a href="{{ route('doctors.index') }}" class="px-6 py-3 text-gray-700 font-medium hover:text-gray-900 transition-colors">
          Cancel
        </a>
        <button type="submit" class="px-8 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 text-gray-500 font-semibold rounded-lg shadow-md hover:shadow-lg hover:from-indigo-700 hover:to-purple-700 transition-all transform hover:scale-105">
          Confirm Appointment
        </button>
      </div>
    </form>
  </div>
</div>

<script>
  // Add visual feedback for radio button selection
  document.querySelectorAll('input[name="is_remote"]').forEach(radio => {
    radio.addEventListener('change', function() {
      document.querySelectorAll('label[id^="remote-"]').forEach(label => {
        label.classList.remove('border-indigo-500', 'bg-indigo-50', 'border-green-500', 'bg-green-50');
        label.classList.add('border-gray-200');
      });
      
      if (this.value == '0') {
        document.getElementById('remote-0').classList.add('border-indigo-500', 'bg-indigo-50');
        document.getElementById('remote-0').classList.remove('border-gray-200');
      } else {
        document.getElementById('remote-1').classList.add('border-green-500', 'bg-green-50');
        document.getElementById('remote-1').classList.remove('border-gray-200');
      }
    });
  });
</script>
@endsection
