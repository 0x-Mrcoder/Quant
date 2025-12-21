<?php

namespace App\Http\Controllers;

use App\Models\TradingAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BrokerController extends Controller
{
    /**
     * Display connected accounts.
     */
    public function index()
    {
        $accounts = TradingAccount::where('user_id', Auth::id())->latest()->get();
        return view('accounts.index', compact('accounts'));
    }

    /**
     * Handle broker connection.
     */
    public function connect(Request $request)
    {
        $request->validate([
            'type' => 'required|in:mt4,mt5,deriv,crypto',
            'login_id' => 'required', // Allow alpha for crypto users later?
            'password' => 'required|string',
            'server' => 'nullable|string',
        ]);

        // Simulate connection delay
        sleep(1);

        // Mock Validation Logic
        if (str_ends_with($request->login_id, '000')) {
             return back()->withErrors(['login_id' => 'Connection failed: Invalid credentials or server timeout.']);
        }

        // Create Account
        TradingAccount::create([
            'user_id' => Auth::id(),
            'broker_type' => $request->type,
            'login_id' => $request->login_id,
            'server' => $request->input('server') ?? 'N/A',
            'password' => $request->password, // Encrypt in prod
            'status' => 'active',
            'balance' => rand(1000, 50000) . '.00', // Mock balance
        ]);

        return redirect()->route('accounts.index')->with('status', 'Account connected successfully!');
    }
}
