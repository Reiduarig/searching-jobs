<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function index()
    {
        $user = Auth::user();

        if ($user->isEmployer()) {
            $dashboardData = $this->userService->getEmployerDashboardData($user);

            return view('dashboard.company', $dashboardData);
        } else {
            $dashboardData = $this->userService->getCandidateDashboardData($user);

            return view('dashboard.user', $dashboardData);
        }
    }
}
