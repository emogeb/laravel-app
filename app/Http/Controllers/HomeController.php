<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Inertia\Inertia;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\JsonResponse;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->orderBy('order')
            ->get();

        return Inertia::render('Home', [
            'services' => $services
        ]);
    }
} 