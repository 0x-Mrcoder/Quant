<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\TradingAccount;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $accounts = TradingAccount::where('user_id', $user->id)->get();

        return view('dashboard', compact('accounts'));
    }

    public function toggleAi(Request $request, $id)
    {
        $account = TradingAccount::where('user_id', Auth::id())->findOrFail($id);
        $account->update(['is_ai_active' => !$account->is_ai_active]);

        return response()->json([
            'success' => true, 
            'is_ai_active' => $account->is_ai_active,
            'message' => $account->is_ai_active ? 'AI Activated for ' . $account->login : 'AI Paused for ' . $account->login
        ]);
    }
}
