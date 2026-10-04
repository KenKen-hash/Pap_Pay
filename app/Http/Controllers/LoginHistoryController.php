<?php

namespace App\Http\Controllers;

use App\Models\LoginHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LoginHistoryController extends Controller
{
    public function index(): View
    {
        $loginHistories = LoginHistory::where('user_id', Auth::id())
            ->latest('login_at')
            ->get();

        return view('auth.login-history', compact('loginHistories'));
    }
}
