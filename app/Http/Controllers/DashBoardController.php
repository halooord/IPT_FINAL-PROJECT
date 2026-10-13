<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\CounselingRecord;
use App\Models\Counselor;
use App\Models\Referral;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index()
    {
        $totalStudents = Student::count();

        $activeCounselors = Counselor::where('is_active', true)->count();

        $pendingAppointments = Appointment::where('status', 'pending')->count();

        $totalRecords = CounselingRecord::count();

        $pendingReferrals = Referral::where('status', 'pending')->count();

        $upcomingAppointments = Appointment::with(['student', 'counselor'])
            ->where('appointment_date', '>=', now())
            ->whereIn('status', ['pending', 'approved'])
            ->orderBy('appointment_date')
            ->take(10)
            ->get();

        return view('dashboard.index', compact(
            'totalStudents',
            'activeCounselors',
            'pendingAppointments',
            'totalRecords',
            'pendingReferrals',
            'upcomingAppointments'
        ));
    }
}
