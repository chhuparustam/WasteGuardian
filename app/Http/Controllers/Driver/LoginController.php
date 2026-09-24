<?php

namespace App\Http\Controllers\Driver;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\DriverModel;
use Illuminate\Support\Facades\Hash;
use App\Models\PickupRequest;
use App\Models\User;
use App\Support\DashboardStats;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('driver.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $driver = User::where('email', $request->email)->first();

        if ($driver && Hash::check($request->password, $driver->password)) {
            Auth::login($driver);
            session([
                'driver_id' => $driver->id,
                'driver_name' => $driver->name,
                'driver_logged_in' => true
            ]);

            return redirect()->route('driver.dashboard');
        } else {
            return redirect()->back()->with('failed', 'Invalid credentials.');
        }
    }

    public function dashboard()
    {
        if (!Auth::id()) {
            return redirect()->back()->with('error', 'You are not authorized to view this page.');
        }

        $driverId = Auth::id();

        $data['assignedRoutes'] = PickupRequest::where('driver_id', $driverId)->count();
        $data['pendingPickups'] = PickupRequest::where('driver_id', $driverId)->where('status', 'pending')->count();
        $data['completedPickups'] = PickupRequest::where('driver_id', $driverId)
            ->get(['status'])
            ->filter(fn ($request) => in_array(
                DashboardStats::normalizeStatus($request->status),
                DashboardStats::STATUS_COMPLETED,
                true
            ))
            ->count();
        $data['chartData'] = $this->series(7);

        return view('driver.dashboard', $data);
    }

    public function chartData(Request $request)
    {
        if (!Auth::id()) {
            return response()->json([]);
        }

        $days = $request->input('period', 'week') === 'month' ? 30 : 7;

        return response()->json($this->series($days));
    }

    private function series($days)
    {
        $base = PickupRequest::where('driver_id', Auth::id());

        [$labels] = DashboardStats::days($days);

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Pickups Completed',
                    'data' => DashboardStats::dailyCounts(clone $base, DashboardStats::STATUS_COMPLETED, $days),
                ],
            ],
        ];
    }
}