<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Request as WasteRequest;
use App\Models\Complaint;
use App\Models\PickupRequest;
use App\Models\Activity;
use App\Support\DashboardStats;
use Illuminate\Support\Facades\Auth;

class UserDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $data['totalRequests'] = PickupRequest::where('user_id', $userId)->count();
        $data['pendingRequests'] = PickupRequest::where('user_id', $userId)->where('status', 'pending')->count();
        $data['completedRequests'] = PickupRequest::where('user_id', $userId)->where('status', 'complete')->count();
        $data['recentActivities'] = Activity::where('user_id', $userId)
            ->latest()
            ->take(5)
            ->get();
        $data['chartData'] = $this->series(7);

        return view('user.dashboard', $data);
    }

    public function chartData(Request $request)
    {
        if (!Auth::check()) {
            return response()->json([]);
        }

        $days = $request->input('period', 'week') === 'month' ? 30 : 7;

        return response()->json($this->series($days));
    }

    private function series($days)
    {
        $base = PickupRequest::where('user_id', Auth::id());

        [$labels] = DashboardStats::days($days);

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Requests',
                    'data' => DashboardStats::dailyCounts(clone $base, null, $days),
                ],
                [
                    'label' => 'Completed',
                    'data' => DashboardStats::dailyCounts(clone $base, DashboardStats::STATUS_COMPLETED, $days),
                ],
            ],
        ];
    }
}