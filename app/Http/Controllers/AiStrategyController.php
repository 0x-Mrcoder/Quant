<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AiConfiguration;
use Illuminate\Support\Facades\Auth;

class AiStrategyController extends Controller
{
    /**
     * Display the AI Strategy Center.
     */
    public function index()
    {
        // Get or create the configuration for the current user
        $config = AiConfiguration::firstOrCreate(
            ['user_id' => Auth::id()],
            [
                'trading_pair' => 'EURUSD',
                'strategy_mode' => 'Hybrid',
                'risk_mode' => 'Moderate',
                'auto_sl_tp' => true,
                'news_reaction' => true,
            ]
        );

        return view('ai-trading.index', compact('config'));
    }

    /**
     * Update the AI Strategy settings.
     */
    public function update(Request $request)
    {
        $request->validate([
            'trading_pair' => 'required|string',
            'strategy_mode' => 'required|in:SMC,ICT,Price Action,Hybrid',
            'risk_mode' => 'required|in:Safe,Moderate,Aggressive,Capital Protection',
            'auto_sl_tp' => 'boolean',
            'news_reaction' => 'boolean',
        ]);

        $config = AiConfiguration::where('user_id', Auth::id())->firstOrFail();

        $config->update($request->all());

        return redirect()->back()->with('success', 'AI Strategy settings updated successfully.');
    }
}
