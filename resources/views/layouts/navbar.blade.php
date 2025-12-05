<nav class="bg-white shadow-lg border-b border-gray-200 sticky top-0 z-50" x-data="{ open: false }">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    <div class="flex items-center justify-between h-16">
      <!-- Logo and Desktop Navigation -->
      <div class="flex items-center space-x-8">
        <a href="{{ route('dashboard') }}" class="flex items-center space-x-2 group">
          <div class="bg-gradient-to-br from-indigo-600 to-purple-600 p-2 rounded-lg group-hover:scale-105 transition-transform">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
          </div>
          <span class="text-xl font-bold bg-gradient-to-r from-indigo-600 to-purple-600 bg-clip-text text-transparent">Doctor RSE</span>
        </a>
        
        <!-- Desktop Navigation Links -->
        <div class="hidden md:flex items-center space-x-1">
          <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-indigo-600 hover:bg-gray-50' }} transition-colors">
            Dashboard
          </a>
          <a href="{{ route('doctors.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('doctors.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-indigo-600 hover:bg-gray-50' }} transition-colors">
            Doctors
          </a>
          <a href="{{ route('appointments.index') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('appointments.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-indigo-600 hover:bg-gray-50' }} transition-colors">
            Appointments
          </a>
          <a href="{{ route('rse.dashboard') }}" class="px-4 py-2 rounded-lg text-sm font-medium {{ request()->routeIs('rse.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-600 hover:text-indigo-600 hover:bg-gray-50' }} transition-colors">
            Sustainability
          </a>
        </div>
      </div>

      <!-- Right Side: User Menu / Auth Links -->
      <div class="flex items-center space-x-4">
        @auth
          <!-- Desktop User Info -->
          <div class="hidden md:flex items-center space-x-3">
            <div class="text-right">
              <p class="text-sm font-medium text-gray-900">{{ auth()->user()->name }}</p>
              <p class="text-xs text-gray-500">RSE Score: {{ auth()->user()->rse_score ?? 0 }}</p>
            </div>
            <div class="h-8 w-px bg-gray-300"></div>
          </div>
          
          <!-- Desktop Profile & Logout -->
          <div class="hidden md:flex items-center space-x-2">
            <a href="{{ route('profile.edit') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors flex items-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
              </svg>
              <span>Profile</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors flex items-center space-x-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
              </button>
            </form>
          </div>
        @else
          <!-- Guest Links -->
          <div class="hidden md:flex items-center space-x-2">
            <a href="{{ route('login') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-gray-700 hover:bg-gray-100 transition-colors">Login</a>
            <a href="{{ route('register') }}" class="px-4 py-2 rounded-lg text-sm font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition-all shadow-md hover:shadow-lg">Sign up</a>
          </div>
        @endauth

        <!-- Mobile Menu Button -->
        <button 
          @click="open = !open" 
          class="md:hidden p-2 rounded-lg text-gray-600 hover:bg-gray-100 transition-colors"
          aria-label="Toggle menu"
        >
          <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
          </svg>
          <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="display: none;">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Mobile Menu -->
    <div 
      x-show="open"
      x-transition:enter="transition ease-out duration-200"
      x-transition:enter-start="opacity-0 transform -translate-y-2"
      x-transition:enter-end="opacity-100 transform translate-y-0"
      x-transition:leave="transition ease-in duration-150"
      x-transition:leave-start="opacity-100 transform translate-y-0"
      x-transition:leave-end="opacity-0 transform -translate-y-2"
      class="md:hidden border-t border-gray-200 py-4 bg-gray-50"
      style="display: none;"
    >
      <div class="space-y-1">
        @auth
          <!-- Mobile User Info Section -->
          <div class="px-4 py-4 bg-white rounded-lg mx-4 mb-4 shadow-sm border border-gray-200">
            <div class="flex items-center space-x-3">
              <div class="bg-gradient-to-br from-indigo-600 to-purple-600 rounded-full p-3">
                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
              </div>
              <div class="flex-1">
                <p class="text-base font-bold text-gray-900">{{ auth()->user()->name }}</p>
                <div class="flex items-center space-x-2 mt-1">
                  <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                  </svg>
                  <p class="text-sm font-medium text-gray-600">RSE Score: <span class="text-indigo-600 font-bold">{{ auth()->user()->rse_score ?? 0 }}</span></p>
                </div>
              </div>
            </div>
          </div>
        @endauth

        <!-- Mobile Navigation Links -->
        <div class="px-4 space-y-1">
          <a 
            href="{{ route('dashboard') }}" 
            @click="open = false"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-white hover:text-indigo-600' }} transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <span>Dashboard</span>
          </a>
          <a 
            href="{{ route('doctors.index') }}" 
            @click="open = false"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('doctors.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-white hover:text-indigo-600' }} transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
            </svg>
            <span>Doctors</span>
          </a>
          <a 
            href="{{ route('appointments.index') }}" 
            @click="open = false"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('appointments.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-white hover:text-indigo-600' }} transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <span>Appointments</span>
          </a>
          <a 
            href="{{ route('rse.dashboard') }}" 
            @click="open = false"
            class="flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium {{ request()->routeIs('rse.*') ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-white hover:text-indigo-600' }} transition-colors"
          >
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span>Sustainability</span>
          </a>
        </div>

        @auth
          <!-- Mobile User Actions -->
          <div class="px-4 pt-2 border-t border-gray-200 mt-2 space-y-1">
            <a 
              href="{{ route('profile.edit') }}" 
              @click="open = false"
              class="flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-white hover:text-indigo-600 transition-colors"
            >
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
              </svg>
              <span>Profile Settings</span>
            </a>
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button 
                type="submit" 
                @click="open = false"
                class="w-full flex items-center space-x-3 px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-white hover:text-red-600 transition-colors"
              >
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                </svg>
                <span>Logout</span>
              </button>
            </form>
          </div>
        @else
          <!-- Mobile Guest Links -->
          <div class="px-4 pt-2 border-t border-gray-200 mt-2 space-y-2">
            <a 
              href="{{ route('login') }}" 
              @click="open = false"
              class="block px-4 py-3 rounded-lg text-base font-medium text-gray-700 hover:bg-white transition-colors text-center"
            >
              Login
            </a>
            <a 
              href="{{ route('register') }}" 
              @click="open = false"
              class="block px-4 py-3 rounded-lg text-base font-medium text-white bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 transition-all text-center shadow-md"
            >
              Sign up
            </a>
          </div>
        @endauth
      </div>
    </div>
  </div>
</nav>
