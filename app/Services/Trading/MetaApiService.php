<?php

namespace App\Services\Trading;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaApiService implements TradingServiceInterface
{
    protected $token;
    protected $baseUrl = 'https://mt-provisioning-api-v1.agiliumtrade.agiliumtrade.ai';

    public function __construct()
    {
        $this->token = config('services.meta_api.token'); // Will need to add to config
    }

    public function connect(string $login, string $password, string $server, string $platform): array
    {
        Log::info("MetaApi Connect Attempt: Login=$login, Server=$server, Platform=$platform");
        
        // Debug Config
        if (empty($this->token)) {
            Log::warning("MetaApi: Token is EMPTY. Falling back to simulation.");
            return [
                'success' => true,
                'id' => 'mock_' . uniqid(),
                'message' => 'Connected (Simulated - No Token Found)',
                'data' => [
                    'connectionStatus' => 'CONNECTED',
                    'balance' => rand(1000, 50000)
                ]
            ];
        }

        Log::info("MetaApi: Token found (" . substr($this->token, 0, 10) . "...). Attempting real connection...");

        // 2. Real API implementation
        try {
            $response = Http::withoutVerifying()->withHeaders([
                'auth-token' => $this->token,
                'Content-Type' => 'application/json'
            ])->post("{$this->baseUrl}/users/current/accounts", [
                'name' => "Quant User " . $login,
                'login' => $login,
                'password' => $password,
                'server' => $server,
                'platform' => $platform,
                'magic' => 1000,
                'quoteStreamingIntervalInSeconds' => 2.5,
                'reliability' => 'regular'
            ]);

            if ($response->successful()) {
                $data = $response->json();
                return [
                    'success' => true,
                    'id' => $data['id'],
                    'message' => 'Account provisioned successfully',
                    'data' => $data
                ];
            }

            Log::error("MetaApi API Error: " . $response->body());

            return [
                'success' => false,
                'message' => $response->json()['message'] ?? 'Failed to connect to MetaApi (See logs)'
            ];

        } catch (\Exception $e) {
            Log::error("MetaApi Connect Error: " . $e->getMessage());
            return [
                'success' => false,
                'message' => 'System error connecting to broker.'
            ];
        }
    }

    public function getAccountInfo(string $accountId): array
    {
        // Mock Implementation
        return [
            'balance' => 0.00,
            'equity' => 0.00,
            'margin' => 0.00
        ];
    }

    public function getHistory(string $accountId, int $days = 30): array
    {
        return [];
    }

    public function deployStrategy(string $accountId, string $strategyId): bool
    {
        return true;
    }
}
