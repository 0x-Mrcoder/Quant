import React, { useState, useEffect } from 'react';
import { View, Text, Dimensions } from 'react-native';
import { CandlestickChart } from 'react-native-wagmi-charts';
import { useSharedValue } from 'react-native-reanimated';
import * as Haptics from 'expo-haptics';

const { width } = Dimensions.get('window');

// 1. Initial Mock Data (XAUUSD Context)
// Generating a few hours of 1-minute candles
const INITIAL_PRICE = 2030.50;
const generateInitialData = (count = 40) => {
    let data = [];
    let currentPrice = INITIAL_PRICE;
    let now = Date.now();

    for (let i = count; i > 0; i--) {
        const time = now - (i * 60000);
        const open = currentPrice;
        const volatility = (Math.random() - 0.5) * 2; // +/- $1.00
        const close = open + volatility;
        const high = Math.max(open, close) + Math.random() * 0.5;
        const low = Math.min(open, close) - Math.random() * 0.5;

        data.push({
            timestamp: time,
            open,
            high,
            low,
            close,
        });
        currentPrice = close;
    }
    return data;
};

export default function NativeChart() {
    const [data, setData] = useState(generateInitialData(50));

    // Simulate Live Ticks
    useEffect(() => {
        const interval = setInterval(() => {
            setData(currentData => {
                const lastCandle = currentData[currentData.length - 1];
                const now = Date.now();

                // 30% chance to start a new candle (simulate 1m candles moving fast for demo)
                // 70% chance to update current candle
                const isNewCandle = Math.random() > 0.7;

                if (isNewCandle) {
                    const nextOpen = lastCandle.close;
                    const nextClose = nextOpen + ((Math.random() - 0.5) * 0.5);
                    return [...currentData.slice(1), {
                        timestamp: now,
                        open: nextOpen,
                        high: Math.max(nextOpen, nextClose),
                        low: Math.min(nextOpen, nextClose),
                        close: nextClose
                    }];
                } else {
                    // Update existing candle
                    const updatedClose = lastCandle.close + ((Math.random() - 0.5) * 0.2);
                    const updatedHigh = Math.max(lastCandle.high, updatedClose);
                    const updatedLow = Math.min(lastCandle.low, updatedClose);

                    const newData = [...currentData];
                    newData[newData.length - 1] = {
                        ...lastCandle,
                        close: updatedClose,
                        high: updatedHigh,
                        low: updatedLow
                    };
                    return newData;
                }
            });
        }, 1000); // 1-second ticks

        return () => clearInterval(interval);
    }, []);

    const invokeHaptic = () => {
        // Run on JS thread
        Haptics.impactAsync(Haptics.ImpactFeedbackStyle.Light);
    };

    function onCurrentXChange() {
        'worklet';
        runOnJS(invokeHaptic)();
    }

    return (
        <CandlestickChart.Provider data={data}>
            <View className="flex-1 bg-[#050505] pt-10">
                <CandlestickChart height={Dimensions.get('window').height * 0.6} width={width}>

                    {/* Testing for Crash: Components Commented Out */}
                    <View style={{ height: 200, width: 200, backgroundColor: 'red' }}>
                        <Text style={{ color: 'white' }}>Debug: Chart Container</Text>
                    </View>

                    {/* 
                    <CandlestickChart.Candles 
                        positiveColor="#10b981" 
                        negativeColor="#ef4444" 
                    />
                    
                    <CandlestickChart.Crosshair>
                        <CandlestickChart.Tooltip textStyle={{ color: 'white', fontWeight: 'bold' }} />
                    </CandlestickChart.Crosshair> 
                    */}

                </CandlestickChart>

                <View className="px-4 mt-4 flex-row justify-between items-center bg-white/5 mx-4 p-3 rounded-xl border border-white/5">
                    <View>
                        <CandlestickChart.PriceText
                            type="close"
                            format={({ value }) => `$${parseFloat(value).toFixed(2)}`}
                            style={{ color: 'white', fontWeight: '900', fontSize: 24 }}
                        />
                        <Text className="text-gray-500 text-xs font-bold mt-1">LIVE MARKET DATA</Text>
                    </View>
                    <View className="bg-emerald-500/20 px-3 py-1 rounded-lg border border-emerald-500/30">
                        <CandlestickChart.DatetimeText
                            style={{ color: '#34d399', fontWeight: 'bold', fontSize: 12 }}
                            format={({ value }) => {
                                const d = new Date(value);
                                return `${d.getHours()}:${d.getMinutes()}:${d.getSeconds()}`;
                            }}
                        />
                    </View>
                </View>
            </View>
        </CandlestickChart.Provider>
    );
}
