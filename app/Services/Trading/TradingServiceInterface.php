<?php

namespace App\Services\Trading;

interface TradingServiceInterface
{
    /**
     * Connect to a trading account (verify credentials).
     * 
     * @param string $login
     * @param string $password
     * @param string $server
     * @param string $platform (mt4/mt5)
     * @return array {'id' => string, 'success' => bool, 'message' => string}
     */
    public function connect(string $login, string $password, string $server, string $platform): array;

    /**
     * Get real-time account information (balance, equity).
     */
    public function getAccountInfo(string $accountId): array;

    /**
     * Get historical trades.
     */
    public function getHistory(string $accountId, int $days = 30): array;

    /**
     * Deploy the AI Strategy (Ea/Signal) to the account.
     */
    public function deployStrategy(string $accountId, string $strategyId): bool;
}
