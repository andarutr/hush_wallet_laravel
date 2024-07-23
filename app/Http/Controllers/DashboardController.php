<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Income;
use App\Models\MasterPlatform;
use App\Models\Saving;
use App\Models\Outcome;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $data['title'] = 'Dashboard';

        $userId = auth()->user()->id;
        $currentYear = Carbon::now()->year;

        $data['monthly_income'] = Income::where('user_id', $userId)
            ->whereYear('tgl_income', $currentYear)
            ->selectRaw('SUM(nominal) as total, MONTH(tgl_income) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $data['monthly_outcome'] = Outcome::where('user_id', $userId)
            ->whereYear('tgl', $currentYear)
            ->selectRaw('SUM(nominal) as total, MONTH(tgl) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $data['monthly_saving'] = Saving::where('user_id', $userId)
            ->whereYear('created_at', $currentYear)
            ->selectRaw('SUM(nominal) as total, MONTH(created_at) as month')
            ->groupBy('month')
            ->orderBy('month')
            ->get()
            ->pluck('total', 'month')
            ->toArray();

        $data['platforms'] = Saving::groupBy('platform')
                                        ->pluck('platform')
                                        ->toArray();

        $data['platformCount'] = Saving::select('platform')
                            ->groupBy('platform')
                            ->selectRaw('platform, count(*) as total')
                            ->pluck('total', 'platform')
                            ->toArray();
    
        return view('pages.dashboard', $data);
    }
}
