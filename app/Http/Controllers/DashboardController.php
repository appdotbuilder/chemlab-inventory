<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Equipment;
use App\Models\Laboratory;
use App\Models\LoanRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    /**
     * Display the dashboard.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        
        // Get role-specific statistics
        $stats = [
            'totalEquipment' => Equipment::count(),
            'availableEquipment' => Equipment::available()->count(),
            'activeLabs' => Laboratory::active()->count(),
            'pendingRequests' => LoanRequest::pending()->count(),
            'overdueReturns' => LoanRequest::overdue()->count(),
            'totalUsers' => User::active()->count(),
        ];

        // Add role-specific data
        if ($user->isAdmin()) {
            // Admin gets global stats (already included above)
        } elseif ($user->isHeadOfLab() || $user->isLabAssistant()) {
            // Lab staff get lab-specific stats
            $assignedLabIds = $user->assigned_labs ?? [];
            if (!empty($assignedLabIds)) {
                $stats['labEquipment'] = Equipment::whereIn('laboratory_id', $assignedLabIds)->count();
                $stats['labRequests'] = LoanRequest::whereIn('laboratory_id', $assignedLabIds)->pending()->count();
            }
        } elseif ($user->isLecturer() || $user->isStudent()) {
            // Users get their own stats
            $stats['myRequests'] = LoanRequest::where('user_id', $user->id)->count();
            $stats['myPendingRequests'] = LoanRequest::where('user_id', $user->id)->pending()->count();
        }

        return Inertia::render('dashboard', [
            'stats' => $stats,
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'role' => $user->role,
                'status' => $user->status,
                'email' => $user->email,
            ]
        ]);
    }
}