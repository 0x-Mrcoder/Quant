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
        $aiStats = [
            'total_trades' => 142,
            'total_profit' => 1250.50,
            'total_loss' => 340.20,
            'win_rate' => 78,
            'profit_factor' => 3.6
        ];

        $aiTrades = collect([
            ['id' => 1, 'pair' => 'EURUSD', 'type' => 'BUY', 'price' => 1.08420, 'profit' => 124.50, 'status' => 'won', 'time' => now()->subHours(2)],
            ['id' => 2, 'pair' => 'XAUUSD', 'type' => 'SELL', 'price' => 2032.10, 'profit' => -42.10, 'status' => 'lost', 'time' => now()->subHours(5)],
            ['id' => 3, 'pair' => 'GBPUSD', 'type' => 'BUY', 'price' => 1.26500, 'profit' => 89.20, 'status' => 'won', 'time' => now()->subDay()],
            ['id' => 4, 'pair' => 'USDJPY', 'type' => 'SELL', 'price' => 148.10, 'profit' => 15.50, 'status' => 'won', 'time' => now()->subDay()->subHours(4)],
            ['id' => 5, 'pair' => 'BTCUSD', 'type' => 'BUY', 'price' => 42100.00, 'profit' => 320.00, 'status' => 'won', 'time' => now()->subDays(2)],
        ]);

        return view('dashboard', compact('accounts', 'aiStats', 'aiTrades'));
    }

    public function toggleAi(Request $request, $id)
    {
        $account = TradingAccount::where('user_id', Auth::id())->findOrFail($id);
        
        // Explicit toggle
        $newState = !$account->is_ai_active;
        $account->is_ai_active = $newState;
        $account->save();

        return response()->json([
            'success' => true, 
            'is_ai_active' => $account->is_ai_active,
            'message' => $account->is_ai_active ? 'AI Activated for ' . ($account->login ?? 'Account') : 'AI Paused for ' . ($account->login ?? 'Account')
        ]);
    }
}
