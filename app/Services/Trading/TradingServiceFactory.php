<?php

namespace App\Services\Trading;

use InvalidArgumentException;

class TradingServiceFactory
{
    public function make(string $brokerType): TradingServiceInterface
    {
        return match ($brokerType) {
            'mt4', 'mt5' => app(MetaApiService::class),
            'deriv' => app(DerivService::class),
            default => throw new InvalidArgumentException("Unsupported broker type: $brokerType"),
        };
    }
}
