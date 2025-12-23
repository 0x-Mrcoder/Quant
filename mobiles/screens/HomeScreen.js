import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, Image } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Bell, TrendingUp, ArrowUpRight, ArrowDownRight } from 'lucide-react-native';

export default function HomeScreen({ navigation }) {
    return (
        <SafeAreaView className="flex-1 bg-dark-bg">
            <ScrollView className="flex-1 px-6">
                {/* Header */}
                <View className="flex-row items-center justify-between py-6">
                    <View className="flex-row items-center gap-3">
                        <View className="w-10 h-10 rounded-full bg-brand-500 items-center justify-center border-2 border-white/20">
                            <Text className="text-white font-bold">M</Text>
                        </View>
                        <View>
                            <Text className="text-gray-400 text-xs text-left">Welcome back</Text>
                            <Text className="text-white font-bold text-lg text-left">Mr. Coder</Text>
                        </View>
                    </View>
                    <TouchableOpacity className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10">
                        <Bell color="white" size={20} />
                    </TouchableOpacity>
                </View>

                {/* Balance Card */}
                <View className="w-full bg-brand-600 rounded-3xl p-6 mb-8 shadow-2xl shadow-brand-500/30 overflow-hidden relative">
                    <View className="absolute top-[-50] right-[-50] w-48 h-48 bg-white/10 rounded-full blur-2xl" />
                    <View className="absolute bottom-[-20] left-[-20] w-32 h-32 bg-black/10 rounded-full blur-xl" />

                    <Text className="text-brand-100 font-medium mb-1">Total Equity</Text>
                    <Text className="text-4xl font-bold text-white mb-4">$24,592.50</Text>

                    <View className="flex-row gap-4">
                        <View className="bg-black/20 px-3 py-1.5 rounded-lg flex-row items-center gap-1">
                            <ArrowUpRight color="#4ade80" size={16} />
                            <Text className="text-green-400 font-bold text-xs">+$1,240 (5.2%)</Text>
                        </View>
                        <View className="bg-black/20 px-3 py-1.5 rounded-lg flex-row items-center gap-1">
                            <TrendingUp color="#4ade80" size={16} />
                            <Text className="text-green-400 font-bold text-xs">Win Rate: 78%</Text>
                        </View>
                    </View>
                </View>

                {/* Section Title */}
                <View className="flex-row items-center justify-between mb-4">
                    <Text className="text-white font-bold text-lg">Active AI Signals</Text>
                    <TouchableOpacity>
                        <Text className="text-brand-400 text-sm">View All</Text>
                    </TouchableOpacity>
                </View>

                {/* Signal Cards */}
                <View className="space-y-4 mb-20">
                    {/* Card 1 */}
                    <TouchableOpacity className="bg-dark-card border border-white/5 rounded-2xl p-4 flex-row justify-between items-center active:bg-white/5">
                        <View className="flex-row items-center gap-4">
                            <View className="w-12 h-12 bg-white/5 rounded-xl items-center justify-center">
                                <Text className="text-white font-bold">XAU</Text>
                            </View>
                            <View>
                                <Text className="text-white font-bold text-base text-left">Gold Spot</Text>
                                <Text className="text-gray-500 text-xs text-left">H1 Strategy • Scalp</Text>
                            </View>
                        </View>
                        <View className="items-end">
                            <Text className="text-emerald-400 font-bold text-base">BUY</Text>
                            <Text className="text-white font-mono text-sm">2032.50</Text>
                        </View>
                    </TouchableOpacity>

                    {/* Card 2 */}
                    <TouchableOpacity className="bg-dark-card border border-white/5 rounded-2xl p-4 flex-row justify-between items-center active:bg-white/5">
                        <View className="flex-row items-center gap-4">
                            <View className="w-12 h-12 bg-white/5 rounded-xl items-center justify-center">
                                <Text className="text-white font-bold">BTC</Text>
                            </View>
                            <View>
                                <Text className="text-white font-bold text-base text-left">Bitcoin</Text>
                                <Text className="text-gray-500 text-xs text-left">M15 Strategy • Trend</Text>
                            </View>
                        </View>
                        <View className="items-end">
                            <Text className="text-rose-500 font-bold text-base">SELL</Text>
                            <Text className="text-white font-mono text-sm">64,210.00</Text>
                        </View>
                    </TouchableOpacity>

                    {/* Card 3 */}
                    <TouchableOpacity className="bg-dark-card border border-white/5 rounded-2xl p-4 flex-row justify-between items-center active:bg-white/5">
                        <View className="flex-row items-center gap-4">
                            <View className="w-12 h-12 bg-white/5 rounded-xl items-center justify-center">
                                <Text className="text-white font-bold text-xs">EUR</Text>
                            </View>
                            <View>
                                <Text className="text-white font-bold text-base text-left">EURUSD</Text>
                                <Text className="text-gray-500 text-xs text-left">H4 Strategy • Swing</Text>
                            </View>
                        </View>
                        <View className="items-end">
                            <Text className="text-emerald-400 font-bold text-base">BUY</Text>
                            <Text className="text-white font-mono text-sm">1.08450</Text>
                        </View>
                    </TouchableOpacity>
                </View>
            </ScrollView>
        </SafeAreaView>
    );
}
