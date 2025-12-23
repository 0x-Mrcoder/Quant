<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\Trading\TradingServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TradingDataController extends Controller
{
    protected $tradingService;

    public function __construct(TradingServiceInterface $tradingService)
    {
        $this->tradingService = $tradingService;
    }

    public function getHistory(Request $request, $symbol)
    {
        try {
           // We can default to 'H1' or accept it as a query param
           $timeframe = $request->query('timeframe', 'H1');
           $days = $request->query('days', 30);

           // Use the service to get (simulated) history
           $data = $this->tradingService->getHistory('simulated_account', $days);
           
           // If the service returns empty (as currently implemented), we generate simulation here or in service.
           // Per plan, we should implement logic in MetaApiService, but checking if it's there.
           // If the service doesn't support "symbol" specific calls in getHistory signature yet, we might need to adjust.
           // Actually, the interface `getHistory` only accepts accountId and days. 
           // We need to extend this or handle it. For simulation, accountId doesn't matter.
           
           // Let's rely on the service to give us data. If it returns basic array, we enrich it or generate it there.
           // But wait, the standard getHistory signature in interface is: getHistory(string $accountId, int $days = 30): array
           // It doesn't take symbol. We should probably abuse the accountId to pass the symbol for simulation, 
           // OR standardise on a generic history simulation method.
           
           // Let's pass the symbol as the "accountId" for the simulation context, or just handle it.
           // Actually, best practice: Implement a specific method for public market data if needed, 
           // but for now reusing getHistory with a "symbol" context or just simulating independently is fine.
           // Let's generate it directly here if the service is restricted, OR better yet, 
           // UPDATE MetaApiService to actually generate it.
           
           // Since we can't change the Interface easily without breaking others, let's assume we update MetaApiService
           // to return data. But since getHistory signature is fixed, we might just generate it here 
           // for the "TradingDataController" specifically if only used for charts.
           
           // ACTUALLY, the plan said "Implement getHistory($symbol, $timeframe, $limit) method" in MetaApiService.
           // This implies adding a NEW method or overloading.
           // Let's add `getMarketData` to MetaApiService specifically.
           
           if (method_exists($this->tradingService, 'getMarketData')) {
               $data = $this->tradingService->getMarketData($symbol, $timeframe);
           } else {
               // Fallback / Temporary Simulation in Controller if Service update lags
               $data = $this->generateSimulation($symbol, $timeframe);
           }

            return response()->json([
                'success' => true,
                'symbol' => $symbol,
                'data' => $data
            ]);

        } catch (\Exception $e) {
            Log::error("Market Data Error: " . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }

    private function generateSimulation($symbol, $timeframe)
    {
        $basePrice = match($symbol) {
             'XAUUSD' => 2035.00,
             'BTCUSD' => 64000.00,
             'EURUSD' => 1.0850,
             'GBPUSD' => 1.2700,
             'US30'   => 38000.00,
             default  => 100.00
        };

        $volatility = $basePrice * 0.002; // 0.2%
        $candles = [];
        $now = time();
        $interval = 3600; // H1

        if ($timeframe === 'M1') $interval = 60;
        if ($timeframe === 'M15') $interval = 900;
        if ($timeframe === 'D1') $interval = 86400;

        $time = $now - (100 * $interval);
        
        $currentPrice = $basePrice;

        for ($i = 0; $i < 100; $i++) {
            $open = $currentPrice;
            $change = (mt_rand(-100, 100) / 100) * $volatility;
            $close = $open + $change;
            $high = max($open, $close) + (mt_rand(0, 50) / 100) * $volatility;
            $low = min($open, $close) - (mt_rand(0, 50) / 100) * $volatility;

            $candles[] = [
                'time' => $time,
                'open' => round($open, 5),
                'high' => round($high, 5),
                'low' => round($low, 5),
                'close' => round($close, 5),
            ];

            $currentPrice = $close;
            $time += $interval;
        }

        return $candles;
    }
}
