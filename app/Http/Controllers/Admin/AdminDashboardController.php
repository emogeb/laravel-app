<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\ServiceRequest;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index(): Response
    {
        $totalUsers = User::count();
        $totalServiceRequests = ServiceRequest::count();
        $serviceRequestsByDay = ServiceRequest::selectRaw('DATE(created_at) as day, COUNT(*) as total')
            ->groupBy('day')
            ->orderBy('day', 'desc')
            ->get();

        return Inertia::render('Admin/Dashboard', [
            'totalUsers' => $totalUsers,
            'totalServiceRequests' => $totalServiceRequests,
            'serviceRequestsByDay' => $serviceRequestsByDay,
        ]);
    }
}
