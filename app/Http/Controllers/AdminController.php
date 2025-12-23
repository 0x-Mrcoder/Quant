<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TradingAccount;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'users' => User::count(),
            'active_subs' => User::where('subscription_plan', '!=', 'free')->count(),
            'connections' => TradingAccount::count(),
            'revenue' => User::where('subscription_plan', '!=', 'free')->count() * 49 // Approx
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function users()
    {
        $users = User::paginate(20);
        return view('admin.users.index', compact('users'));
    }

    public function trading()
    {
        $accounts = TradingAccount::with('user')->latest()->paginate(20);
        return view('admin.trading.index', compact('accounts'));
    }
}
