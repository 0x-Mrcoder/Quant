import React from 'react';
import { View, Text, TouchableOpacity, ScrollView } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ArrowLeft, Check, Crown, Zap, Shield, BarChart3 } from 'lucide-react-native';

export default function SubscriptionScreen({ navigation }) {

    const CURRENT_PLAN = 'PRO'; // Mock state

    const PLANS = [
        {
            id: 'FREE',
            name: 'Starter',
            price: '$0',
            period: '/mo',
            features: ['Basic Market Analysis', '1 Connected Account', 'Standard Support'],
            active: false
        },
        {
            id: 'PRO',
            name: 'Pro Trader',
            price: '$49',
            period: '/mo',
            features: ['Advanced AI Strategies', 'Unlimited Accounts', 'Priority Execution', 'Real-time News Filter'],
            active: true,
            highlight: true
        }
    ];

    return (
        <SafeAreaView className="flex-1 bg-[#050505] font-sans">
            <View className="absolute top-0 right-0 w-[400] h-[400] bg-purple-500/10 rounded-full blur-[100px]" />

            {/* Header */}
            <View className="px-6 py-4 flex-row items-center justify-between border-b border-white/5 mb-4">
                <TouchableOpacity
                    className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10"
                    onPress={() => navigation.goBack()}
                >
                    <ArrowLeft color="white" size={20} />
                </TouchableOpacity>
                <Text className="text-white font-bold text-lg">Subscription</Text>
                <View className="w-10" />
            </View>

            <ScrollView className="flex-1 px-6" contentContainerStyle={{ paddingBottom: 40 }}>

                {/* Hero Section */}
                <View className="items-center mb-8 mt-4">
                    <View className="w-16 h-16 bg-gradient-to-br from-brand-400 to-purple-600 rounded-2xl items-center justify-center mb-4 shadow-lg shadow-brand-500/20 rotate-3">
                        <Crown color="white" size={32} fill="white" />
                    </View>
                    <Text className="text-white font-bold text-2xl mb-2">Upgrade your Trading</Text>
                    <Text className="text-gray-400 text-center leading-5 w-64">
                        Unlock the full potential of PipFlow AI with our premium tiers.
                    </Text>
                </View>

                {/* Plans */}
                <View className="gap-6">
                    {PLANS.map((plan) => (
                        <View
                            key={plan.id}
                            className={`rounded-3xl p-6 border ${plan.highlight ? 'bg-[#1a1a1a] border-brand-500/50 shadow-lg shadow-brand-500/10' : 'bg-white/5 border-white/5'}`}
                        >
                            <View className="flex-row justify-between items-start mb-6">
                                <View>
                                    <Text className={`font-bold text-lg mb-1 ${plan.highlight ? 'text-brand-400' : 'text-gray-300'}`}>
                                        {plan.name}
                                    </Text>
                                    <View className="flex-row items-baseline gap-1">
                                        <Text className="text-white font-bold text-3xl">{plan.price}</Text>
                                        <Text className="text-gray-500">{plan.period}</Text>
                                    </View>
                                </View>
                                {plan.active && (
                                    <View className="bg-brand-500/20 px-3 py-1 rounded-full border border-brand-500/50">
                                        <Text className="text-brand-500 text-xs font-bold">CURRENT</Text>
                                    </View>
                                )}
                            </View>

                            {/* Features */}
                            <View className="gap-3 mb-8">
                                {plan.features.map((feature, i) => (
                                    <View key={i} className="flex-row items-center gap-3">
                                        <View className="w-5 h-5 rounded-full bg-emerald-500/20 items-center justify-center">
                                            <Check color="#10b981" size={12} strokeWidth={3} />
                                        </View>
                                        <Text className="text-gray-300 text-sm font-bold">{feature}</Text>
                                    </View>
                                ))}
                            </View>

                            {/* Action Button */}
                            <TouchableOpacity
                                disabled={plan.active}
                                className={`w-full py-4 rounded-xl items-center justify-center ${plan.active ? 'bg-white/5' : 'bg-brand-500 active:scale-95'}`}
                            >
                                <Text className={`font-bold text-base ${plan.active ? 'text-gray-500' : 'text-white'}`}>
                                    {plan.active ? 'Active Plan' : 'Upgrade Now'}
                                </Text>
                            </TouchableOpacity>
                        </View>
                    ))}
                </View>

                <TouchableOpacity className="mt-8 items-center">
                    <Text className="text-gray-500 text-xs underline">Restore Purchases</Text>
                </TouchableOpacity>

            </ScrollView>
        </SafeAreaView>
    );
}
