import React from 'react';
import { View, ActivityIndicator } from 'react-native';
import { WebView } from 'react-native-webview';

// HTML Content for the Chart
const ChartHTML = `
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <script src="https://unpkg.com/lightweight-charts/dist/lightweight-charts.standalone.production.js"></script>
    <style>
        body { margin: 0; padding: 0; background-color: #050505; overflow: hidden; }
        #chart { width: 100vw; height: 100vh; }
    </style>
</head>
<body>
    <div id="chart"></div>
    <script>
        // 1. Initialize Chart
        const chart = LightweightCharts.createChart(document.getElementById('chart'), {
            layout: {
                background: { type: 'solid', color: '#050505' },
                textColor: '#d1d5db',
            },
            grid: {
                vertLines: { color: 'rgba(42, 46, 57, 0.2)' },
                horzLines: { color: 'rgba(42, 46, 57, 0.2)' },
            },
            rightPriceScale: {
                borderColor: 'rgba(197, 203, 206, 0.8)',
            },
            timeScale: {
                borderColor: 'rgba(197, 203, 206, 0.8)',
                timeVisible: true,
                secondsVisible: false,
            },
            crosshair: {
                mode: LightweightCharts.CrosshairMode.Normal,
            },
        });

        const candleSeries = chart.addCandlestickSeries({
            upColor: '#10b981',
            downColor: '#ef4444',
            borderDownColor: '#ef4444',
            borderUpColor: '#10b981',
            wickDownColor: '#ef4444',
            wickUpColor: '#10b981',
        });

        // 2. Initial Data (Mock History for smooth start)
        // In a real app, fetch historical bars via API here.
        const currentParams = {
            open: 2030.00,
            high: 2035.00,
            low: 2028.00,
            close: 2032.50,
            time: Math.floor(Date.now() / 1000) - 60,
        };
        
        candleSeries.setData([currentParams]);

        // 3. Connect to Binance WebSocket (Public Feed for Demo)
        // Using BTCUSDT as proxy for volatility if XAUUSD not available on public stream, 
        // but let's try a direct price simulation or a real crypto feed.
        // For accurate Gold (XAUUSD), we usually need a specific forex provider.
        // Let's use BTCUSDT real data for the "Live" feel, or simulate XAUUSD relative moves.
        
        // Let's use BTCUSDT from Binance for reliability in this demo
        const binanceSocket = new WebSocket('wss://stream.binance.com:9443/ws/btcusdt@kline_1m');

        let lastCandle = null;

        binanceSocket.onmessage = function(event) {
            const message = JSON.parse(event.data);
            const k = message.k;
            
            const candle = {
                time: k.t / 1000,
                open: parseFloat(k.o),
                high: parseFloat(k.h),
                low: parseFloat(k.l),
                close: parseFloat(k.c),
            };

            candleSeries.update(candle);
        };

        // Resize observer
        new ResizeObserver(entries => {
            if (entries.length === 0 || entries[0].target !== document.getElementById('chart')) { return; }
            const newRect = entries[0].contentRect;
            chart.applyOptions({ height: newRect.height, width: newRect.width });
        }).observe(document.getElementById('chart'));

    </script>
</body>
</html>
`;

export default function LiveChart() {
    return (
        <View className="flex-1 bg-[#050505]">
            <WebView
                originWhitelist={['*']}
                source={{ html: ChartHTML }}
                style={{ backgroundColor: '#050505', flex: 1 }}
                scrollEnabled={false}
                bounces={false}
                renderLoading={() => (
                    <View className="absolute inset-0 items-center justify-center bg-[#050505]">
                        <ActivityIndicator size="large" color="#8b5cf6" />
                    </View>
                )}
                startInLoadingState={true}
            />
        </View>
    );
}
