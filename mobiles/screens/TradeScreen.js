import React from 'react';
import { View, Text, TouchableOpacity, Dimensions } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ChevronDown, Plus, Minus } from 'lucide-react-native';

const { width } = Dimensions.get('window');

// Mock Chart Bars
const ChartBar = ({ height, color }) => (
    <View style={{ height, width: (width - 48) / 20, backgroundColor: color, borderRadius: 2, marginRight: 4 }} />
);

export default function TradeScreen() {
    return (
        <SafeAreaView className="flex-1 bg-dark-bg">
            {/* Header / Asset Selector */}
            <View className="px-6 py-4 border-b border-white/5 flex-row justify-between items-center">
                <TouchableOpacity className="flex-row items-center gap-2">
                    <View>
                        <Text className="text-white font-bold text-xl text-left">XAUUSD</Text>
                        <Text className="text-gray-400 text-xs text-left">Gold vs US Dollar</Text>
                    </View>
                    <ChevronDown color="#9ca3af" size={20} />
                </TouchableOpacity>
                <View className="items-end">
                    <Text className="text-white font-bold font-mono text-lg">2034.50</Text>
                    <Text className="text-emerald-400 text-xs font-bold">+0.45%</Text>
                </View>
            </View>

            {/* Chart Area (Visual Placeholder) */}
            <View className="flex-1 justify-center items-center relative">
                <View className="flex-row items-end h-64 px-6 border-b border-white/5 w-full justify-between">
                    {/* Visual Bars simulating a chart */}
                    {[40, 60, 55, 70, 65, 80, 75, 90, 85, 100, 95, 110, 105, 120, 115, 130, 125, 140, 135].map((h, i) => (
                        <ChartBar key={i} height={h + Math.random() * 20} color={i % 2 === 0 ? '#10b981' : '#ef4444'} />
                    ))}
                </View>
                <View className="absolute top-4 left-6 bg-black/40 px-3 py-1 rounded-lg border border-white/10">
                    <Text className="text-gray-400 text-xs">M15 • XAUUSD</Text>
                </View>
            </View>

            {/* Execution Panel */}
            <View className="bg-dark-card border-t border-white/10 p-6 pb-24">

                {/* Lot Size Control */}
                <View className="flex-row justify-between items-center mb-6">
                    <Text className="text-gray-400 font-medium">Volume (Lots)</Text>
                    <View className="flex-row items-center bg-white/5 rounded-xl border border-white/5">
                        <TouchableOpacity className="p-3 border-r border-white/10">
                            <Minus color="#9ca3af" size={18} />
                        </TouchableOpacity>
                        <View className="w-20 items-center">
                            <Text className="text-white font-bold font-mono text-lg">1.00</Text>
                        </View>
                        <TouchableOpacity className="p-3 border-l border-white/10">
                            <Plus color="#9ca3af" size={18} />
                        </TouchableOpacity>
                    </View>
                </View>

                {/* Buy/Sell Buttons */}
                <View className="flex-row gap-4">
                    <TouchableOpacity className="flex-1 bg-rose-500/10 border border-rose-500/50 rounded-2xl py-4 items-center active:bg-rose-500/20">
                        <Text className="text-rose-500 font-bold text-sm mb-1">SELL</Text>
                        <Text className="text-white font-bold text-xl font-mono">2034.45</Text>
                    </TouchableOpacity>

                    <TouchableOpacity className="flex-1 bg-emerald-500/10 border border-emerald-500/50 rounded-2xl py-4 items-center active:bg-emerald-500/20">
                        <Text className="text-emerald-500 font-bold text-sm mb-1">BUY</Text>
                        <Text className="text-white font-bold text-xl font-mono">2034.55</Text>
                    </TouchableOpacity>
                </View>
            </View>
        </SafeAreaView>
    );
}
