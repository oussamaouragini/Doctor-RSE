@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow-lg p-6 border border-indigo-100">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Profile Settings</h1>
        <p class="text-gray-700">Manage your account information and preferences</p>
      </div>
      <div class="hidden md:block">
        <svg class="w-24 h-24 opacity-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
          <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
        </svg>
      </div>
    </div>
  </div>

  <!-- Profile Information Card -->
  <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
    <div class="max-w-2xl">
      @include('profile.partials.update-profile-information-form')
    </div>
  </div>

  <!-- Update Password Card -->
  <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
    <div class="max-w-2xl">
      @include('profile.partials.update-password-form')
    </div>
  </div>

  <!-- Delete Account Card -->
  <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-red-500">
    <div class="max-w-2xl">
      @include('profile.partials.delete-user-form')
    </div>
  </div>
</div>
@endsection
