@extends('layouts.app')

@section('title','Sustainability Dashboard')

@section('content')
<div class="space-y-6">
  <!-- Header Section -->
  <div class="bg-gradient-to-r from-indigo-50 to-purple-50 rounded-xl shadow-lg p-6 border border-indigo-100">
    <div class="flex items-center justify-between">
      <div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Sustainability Dashboard</h1>
        <p class="text-gray-700">Track your environmental impact and RSE contributions</p>
      </div>
      <div class="hidden md:block">
        <svg class="w-24 h-24 opacity-10 text-indigo-600" fill="currentColor" viewBox="0 0 20 20">
          <path d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
        </svg>
      </div>
    </div>
  </div>

  <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <div class="lg:col-span-2 space-y-6">
      <!-- Summary Card -->
      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-emerald-500">
        <h2 class="text-xl font-bold text-gray-900 mb-6">Your Sustainability Summary</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
          <div class="bg-gradient-to-br from-emerald-50 to-green-50 rounded-xl p-6 border border-emerald-100">
            <div class="flex items-center justify-between mb-2">
              <div class="bg-emerald-100 rounded-full p-3">
                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="text-sm font-medium text-gray-600 mb-1">CO₂ Saved</div>
            <div class="text-3xl font-bold text-gray-900">{{ number_format(auth()->user()->carbon_saving ?? 0, 1) }}<span class="text-lg text-gray-500"> kg</span></div>
          </div>

          <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-xl p-6 border border-indigo-100">
            <div class="flex items-center justify-between mb-2">
              <div class="bg-indigo-100 rounded-full p-3">
                <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
              </div>
            </div>
            <div class="text-sm font-medium text-gray-600 mb-1">Eco Bookings</div>
            <div class="text-3xl font-bold text-gray-900">{{ auth()->user()->eco_friendly_bookings ?? 0 }}</div>
          </div>

          <div class="bg-gradient-to-br from-yellow-50 to-amber-50 rounded-xl p-6 border border-yellow-100">
            <div class="flex items-center justify-between mb-2">
              <div class="bg-yellow-100 rounded-full p-3">
                <svg class="w-6 h-6 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                </svg>
              </div>
            </div>
            <div class="text-sm font-medium text-gray-600 mb-1">RSE Score</div>
            <div class="text-3xl font-bold text-gray-900">{{ auth()->user()->rse_score ?? 0 }}</div>
          </div>
        </div>

        @if(isset($chartLabels) && isset($chartData))
          <div class="mt-8">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">CO₂ Savings Trend</h3>
            <div class="bg-gray-50 rounded-lg p-4">
              <canvas id="co2Chart" height="120"></canvas>
            </div>
          </div>
        @endif
      </div>

      <!-- Recent Actions Card -->
      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-indigo-500">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Recent Actions</h3>
        @if(isset($logs) && $logs->count() > 0)
          <div class="space-y-3">
            @foreach($logs as $log)
              <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                <div class="flex items-center space-x-4">
                  <div class="bg-emerald-100 rounded-full p-2">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                  </div>
                  <div>
                    <div class="font-semibold text-gray-900">{{ $log->action }}</div>
                    <div class="text-sm text-gray-500">{{ $log->created_at->diffForHumans() }}</div>
                  </div>
                </div>
                <div class="text-right">
                  <div class="text-sm font-semibold text-emerald-600">{{ $log->co2_saved }} kg CO₂</div>
                  <div class="text-sm font-medium text-yellow-600">+{{ $log->points }} pts</div>
                </div>
              </div>
            @endforeach
          </div>
        @else
          <div class="text-center py-12">
            <div class="bg-gray-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
              <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
              </svg>
            </div>
            <p class="text-gray-600 font-medium">No sustainability actions recorded yet.</p>
            <p class="text-sm text-gray-500 mt-1">Book remote appointments to start earning points!</p>
          </div>
        @endif
      </div>
    </div>

    <!-- Achievements Sidebar -->
    <div>
      <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
        <h3 class="text-xl font-bold text-gray-900 mb-4">Achievements</h3>
        <div class="space-y-3">
          @if(isset($badges) && count($badges) > 0)
            @foreach($badges as $badge)
              <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                <div class="flex items-center justify-between mb-2">
                  <div class="font-semibold text-gray-900">{{ $badge->name ?? 'Badge' }}</div>
                  <div>
                    @if(isset($userBadgeIds) && in_array($badge->id, $userBadgeIds))
                      <span class="px-3 py-1 rounded-full bg-indigo-600 text-white text-xs font-semibold">Earned</span>
                    @else
                      <span class="px-3 py-1 rounded-full bg-gray-200 text-gray-600 text-xs font-semibold">{{ $badge->category ?? 'Locked' }}</span>
                    @endif
                  </div>
                </div>
                <p class="text-sm text-gray-600">{{ $badge->description ?? '' }}</p>
              </div>
            @endforeach
          @else
            <div class="text-center py-8">
              <div class="bg-gray-100 rounded-full p-4 w-16 h-16 mx-auto mb-4 flex items-center justify-center">
                <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
              </div>
              <p class="text-sm text-gray-600 font-medium">No badges available yet.</p>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>

@if(isset($chartLabels) && isset($chartData))
<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const ctx = document.getElementById('co2Chart');
  if (ctx) {
    const labels = {!! json_encode($chartLabels ?? []) !!};
    const data = {!! json_encode($chartData ?? []) !!};

    new Chart(ctx.getContext('2d'), {
      type: 'line',
      data: {
        labels,
        datasets: [{
          label: 'CO₂ saved (kg)',
          data,
          fill: true,
          tension: 0.4,
          borderWidth: 3,
          borderColor: 'rgb(34, 197, 94)',
          backgroundColor: 'rgba(34, 197, 94, 0.1)',
          pointBackgroundColor: 'rgb(34, 197, 94)',
          pointBorderColor: '#fff',
          pointBorderWidth: 2,
          pointRadius: 5,
          pointHoverRadius: 7,
        }]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          }
        },
        scales: {
          y: { 
            beginAtZero: true,
            grid: {
              color: 'rgba(0, 0, 0, 0.05)'
            }
          },
          x: {
            grid: {
              display: false
            }
          }
        }
      }
    });
  }
</script>
@endif
@endsection
