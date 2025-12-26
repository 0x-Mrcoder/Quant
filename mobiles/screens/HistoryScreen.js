import React, { useState } from 'react';
import { View, Text, FlatList, TouchableOpacity, Dimensions, ScrollView } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Calendar, Filter, ArrowUpRight, ArrowDownRight, TrendingUp, TrendingDown, DollarSign, Clock, Hash } from 'lucide-react-native';

const TRADE_HISTORY = [
    { id: '1', symbol: 'XAUUSD', type: 'BUY', lots: '1.00', open: '2034.50', close: '2042.80', profit: 830.00, time: '14:30', date: 'Today', status: 'PROFIT' },
    { id: '2', symbol: 'BTCUSD', type: 'SELL', lots: '0.50', open: '64500.00', close: '64200.00', profit: 150.00, time: '11:15', date: 'Today', status: 'PROFIT' },
    { id: '3', symbol: 'EURUSD', type: 'BUY', lots: '2.00', open: '1.08500', close: '1.08420', profit: -160.00, time: '09:45', date: 'Today', status: 'LOSS' },
    { id: '4', symbol: 'USDJPY', type: 'SELL', lots: '1.00', open: '150.50', close: '150.20', profit: 300.00, time: '16:20', date: 'Yesterday', status: 'PROFIT' },
    { id: '5', symbol: 'US30', type: 'BUY', lots: '0.10', open: '38400.00', close: '38450.00', profit: 50.00, time: '10:00', date: 'Yesterday', status: 'PROFIT' },
    { id: '6', symbol: 'GBPUSD', type: 'SELL', lots: '1.50', open: '1.26500', close: '1.26700', profit: -300.00, time: '08:00', date: '2023-10-25', status: 'LOSS' },
];

export default function HistoryScreen() {
    const [period, setPeriod] = useState('Week');
    const [filterType, setFilterType] = useState('All'); // All, Profit, Loss

    // Calculate Summary Stats
    const totalProfit = TRADE_HISTORY.reduce((acc, item) => acc + item.profit, 0);
    const wonTrades = TRADE_HISTORY.filter(t => t.profit > 0).length;
    const winRate = ((wonTrades / TRADE_HISTORY.length) * 100).toFixed(0);

    const filteredData = TRADE_HISTORY.filter(item => {
        if (filterType === 'Profit') return item.profit > 0;
        if (filterType === 'Loss') return item.profit < 0;
        return true;
    });

    const renderTradeItem = ({ item }) => (
        <View className="bg-dark-card border border-white/5 rounded-2xl mb-3 p-4 shadow-sm">
            {/* Top Row: Symbol & Profit */}
            <View className="flex-row justify-between items-start mb-3">
                <View className="flex-row items-center gap-3">
                    <View className={`w-10 h-10 rounded-full items-center justify-center ${item.type === 'BUY' ? 'bg-emerald-500/10' : 'bg-rose-500/10'}`}>
                        {item.type === 'BUY' ? <ArrowUpRight color="#10b981" size={20} /> : <ArrowDownRight color="#f43f5e" size={20} />}
                    </View>
                    <View>
                        <Text className="text-white font-bold text-base font-sans">{item.symbol}</Text>
                        <Text className={`text-[10px] font-bold ${item.type === 'BUY' ? 'text-emerald-500' : 'text-rose-500'}`}>
                            {item.type} {item.lots} Lot
                        </Text>
                    </View>
                </View>
                <View className="items-end">
                    <Text className={`font-bold font-mono text-lg ${item.profit >= 0 ? 'text-emerald-400' : 'text-rose-500'}`}>
                        {item.profit >= 0 ? '+' : ''}${Math.abs(item.profit).toFixed(2)}
                    </Text>
                    <View className={`px-2 py-0.5 rounded-full ${item.profit >= 0 ? 'bg-emerald-500/10' : 'bg-rose-500/10'}`}>
                        <Text className={`text-[10px] font-bold ${item.profit >= 0 ? 'text-emerald-500' : 'text-rose-500'}`}>
                            {item.profit >= 0 ? 'WIN' : 'LOSS'}
                        </Text>
                    </View>
                </View>
            </View>

            {/* Divider */}
            <View className="h-[1px] bg-white/5 w-full mb-3" />

            {/* Bottom Row: Details */}
            <View className="flex-row justify-between items-center">
                <View className="flex-row gap-4">
                    <View>
                        <Text className="text-gray-500 text-[10px]">Open Price</Text>
                        <Text className="text-gray-300 text-xs font-mono">{item.open}</Text>
                    </View>
                    <View>
                        <Text className="text-gray-500 text-[10px]">Close Price</Text>
                        <Text className="text-gray-300 text-xs font-mono">{item.close}</Text>
                    </View>
                </View>
                <View className="flex-row items-center gap-1">
                    <Clock color="#6b7280" size={12} />
                    <Text className="text-gray-500 text-xs">{item.time}</Text>
                </View>
            </View>
        </View>
    );

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">

            {/* Header */}
            <View className="px-6 py-4 bg-[#050505] border-b border-white/5 flex-row justify-between items-center">
                <Text className="text-white font-bold text-xl font-sans">Trade History</Text>
                <TouchableOpacity className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10">
                    <Calendar color="white" size={20} />
                </TouchableOpacity>
            </View>

            {/* Period Selector */}
            <View className="px-6 py-4">
                <View className="flex-row bg-[#1a1a1a] rounded-xl p-1 border border-white/5">
                    {['Day', 'Week', 'Month', 'All'].map((p) => (
                        <TouchableOpacity
                            key={p}
                            className={`flex-1 items-center py-2 rounded-lg ${period === p ? 'bg-brand-500' : 'bg-transparent'}`}
                            onPress={() => setPeriod(p)}
                        >
                            <Text className={`font-bold text-xs ${period === p ? 'text-white' : 'text-gray-500'}`}>{p}</Text>
                        </TouchableOpacity>
                    ))}
                </View>
            </View>

            {/* Summary Cards */}
            <View className="px-6 flex-row gap-3 mb-6">
                <View className="flex-1 bg-emerald-500/10 border border-emerald-500/20 rounded-2xl p-4 relative overflow-hidden">
                    <View className="absolute right-0 top-0 p-2 opacity-10">
                        <DollarSign color="#10b981" size={40} />
                    </View>
                    <Text className="text-emerald-500/80 text-xs font-bold uppercase mb-1">Net Profit</Text>
                    <Text className="text-emerald-400 font-bold text-2xl font-sans">
                        +${totalProfit.toFixed(2)}
                    </Text>
                </View>
                <View className="flex-1 bg-brand-500/10 border border-brand-500/20 rounded-2xl p-4 relative overflow-hidden">
                    <View className="absolute right-0 top-0 p-2 opacity-10">
                        <TrendingUp color="#f59e0b" size={40} />
                    </View>
                    <Text className="text-brand-500/80 text-xs font-bold uppercase mb-1">Win Rate</Text>
                    <Text className="text-brand-400 font-bold text-2xl font-sans">
                        {winRate}%
                    </Text>
                </View>
            </View>

            {/* Filter Tabs */}
            <View className="px-6 pb-4">
                <ScrollView horizontal showsHorizontalScrollIndicator={false} contentContainerStyle={{ gap: 10 }}>
                    {['All', 'Profit', 'Loss'].map((type) => (
                        <TouchableOpacity
                            key={type}
                            onPress={() => setFilterType(type)}
                            className={`px-5 py-2 rounded-full border ${filterType === type ? 'bg-white text-black border-white' : 'bg-transparent border-white/20'}`}
                        >
                            <Text className={`font-bold text-xs ${filterType === type ? 'text-black' : 'text-white'}`}>{type}</Text>
                        </TouchableOpacity>
                    ))}
                </ScrollView>
            </View>

            {/* List */}
            <FlatList
                data={filteredData}
                renderItem={renderTradeItem}
                keyExtractor={item => item.id}
                contentContainerStyle={{ paddingHorizontal: 24, paddingBottom: 100 }}
                showsVerticalScrollIndicator={false}
                ListEmptyComponent={
                    <View className="items-center justify-center mt-20">
                        <Hash color="#333" size={40} />
                        <Text className="text-gray-600 mt-4">No trades found for this period.</Text>
                    </View>
                }
            />

        </SafeAreaView>
    );
}
