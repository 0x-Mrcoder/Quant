<?php

namespace App\Http\Controllers;

use App\Models\TradingAccount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BrokerController extends Controller
{
    protected $tradingFactory;

    public function __construct(\App\Services\Trading\TradingServiceFactory $tradingFactory)
    {
        $this->tradingFactory = $tradingFactory;
    }

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
            'login_id' => 'required', 
            'password' => 'required|string',
            'server' => 'nullable|string',
        ]);

        // Attempt connection via Factory
        try {
            $service = $this->tradingFactory->make($request->type);
            $result = $service->connect(
                $request->login_id,
                $request->password,
                $request->input('server', 'default'),
                $request->type
            );
        } catch (\Exception $e) {
             return back()->withErrors(['login_id' => $e->getMessage()]);
        }

        if (!$result['success']) {
            return back()->withErrors(['login_id' => 'Connection failed: ' . $result['message']]);
        }

        // Create Account (Store encrypted password automatically via model cast)
        TradingAccount::create([
            'user_id' => Auth::id(),
            'broker_type' => $request->type,
            'login_id' => $request->login_id,
            'server' => $request->input('server') ?? 'N/A',
            'password' => $request->password, 
            'status' => 'active',
            'meta_api_id' => $result['id'],
            'balance' => $result['data']['balance'] ?? 0.00,
        ]);

        return redirect()->route('accounts.index')->with('status', 'Account connected successfully (Secured).');
    }
}
