<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\PickupRequest;
use App\Models\Complaint;
use App\Models\ServiceBooking;
use App\Support\DashboardStats;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class AdminLoginController extends Controller
{
    public function adminLoginPage()
    {
        return view('auth.admin-login');
    }

    public function adminLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $adminEmail = 'admin@wasteguardian.com';
        $adminPassword = 'admin123';

        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            session(['admin_logged_in' => true]);
            return redirect()->route('admin.dashboard');
        } else {
            return back()->with('failed', 'Invalid admin credentials');
        }
    }

    public function dashboard()
    {
        $data['driverCount'] = User::where('type', 'driver')->count();
        $data['complaintCount'] = Complaint::count();
        $data['requestCount'] = PickupRequest::count();
        $data['userCount'] = User::count();

        $data['monthlyRevenue'] = (float) ServiceBooking::whereRaw('LOWER(payment_status) = ?', ['paid'])
            ->whereBetween('created_at', [Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()])
            ->sum('amount');
        $data['totalEarnings'] = (float) ServiceBooking::whereRaw('LOWER(payment_status) = ?', ['paid'])
            ->sum('amount');
        $data['serviceFees'] = (float) ServiceBooking::whereRaw('LOWER(payment_status) = ?', ['paid'])
            ->sum('amount');
        $data['earning'] = (float) ServiceBooking::whereRaw('LOWER(payment_status) = ?', ['paid'])
            ->sum('amount');
        $data['balance'] = (float) ServiceBooking::sum('amount');

        $data['todayRequests'] = PickupRequest::whereDate('created_at', Carbon::today())->count();
        $data['todayUsers'] = User::whereDate('created_at', Carbon::today())->count();
        $data['todayComplaints'] = Complaint::whereDate('created_at', Carbon::today())->count();
        $data['todayBookings'] = ServiceBooking::whereDate('created_at', Carbon::today())->count();

        $data['chartData'] = $this->series(7);

        return view('admin.dashboard', $data);
    }

    public function chartData(Request $request)
    {
        if (!session()->has('admin_logged_in') || !session('admin_logged_in')) {
            return response()->json([]);
        }

        $days = $request->input('period', 'week') === 'month' ? 30 : 7;

        return response()->json($this->series($days));
    }

    private function series($days)
    {
        $base = PickupRequest::query();

        [$labels] = DashboardStats::days($days);

        return [
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'New Requests',
                    'data' => DashboardStats::dailyCounts(clone $base, null, $days),
                ],
                [
                    'label' => 'Completed',
                    'data' => DashboardStats::dailyCounts(clone $base, DashboardStats::STATUS_COMPLETED, $days),
                ],
                [
                    'label' => 'Revenue',
                    'data' => DashboardStats::revenueByDay($days),
                ],
            ],
            'statusBreakdown' => DashboardStats::countByStatus(clone $base),
        ];
    }
}