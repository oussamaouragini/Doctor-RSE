<?php

namespace App\Http\Controllers;

use App\Models\SustainabilityLog;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SustainabilityController extends Controller
{
    public function dashboard()
    {
        $user = auth()->user();
        $logs = SustainabilityLog::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Generate chart data for last 7 days
        $chartLabels = [];
        $chartData = [];
        
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $chartLabels[] = $date->format('M d');
            
            $dailyTotal = SustainabilityLog::where('user_id', $user->id)
                ->whereDate('created_at', $date->format('Y-m-d'))
                ->sum('co2_saved');
            
            $chartData[] = round($dailyTotal, 2);
        }

        // Badges data (simplified - you can create a Badge model later)
        $badges = [];
        $userBadgeIds = [];

        return view('sustainability.dashboard', compact(
            'logs',
            'chartLabels',
            'chartData',
            'badges',
            'userBadgeIds'
        ));
    }
}

