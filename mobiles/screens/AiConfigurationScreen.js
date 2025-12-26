import React, { useState } from 'react';
import { View, Text, TouchableOpacity, ScrollView, Switch, Dimensions, Modal, FlatList } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ArrowLeft, ChevronDown, Check, Zap, Shield, Save } from 'lucide-react-native';

const { width } = Dimensions.get('window');

const STRATEGY_OPTIONS = [
    { id: 'SMC', label: 'SMC Engine', desc: 'Smart Money Concepts' },
    { id: 'ICT', label: 'ICT Concepts', desc: 'Inner Circle Trader Flow' },
    { id: 'Hybrid', label: 'PipFlow Hybrid', desc: 'Adaptive Price Action' },
    { id: 'Price Action', label: 'Pure Price Action', desc: 'Support & Resistance' },
];

const RISK_OPTIONS = [
    { id: 'Safe', label: 'Conservative (Safe)', desc: 'Low Drawdown, Steady Growth' },
    { id: 'Moderate', label: 'Balanced (Moderate)', desc: 'Standard Risk/Reward' },
    { id: 'Aggressive', label: 'Aggressive (High Risk)', desc: 'Maximum Growth Potential' },
    { id: 'Capital Protection', label: 'Capital Protection', desc: 'Focus on Preserving Funds' },
];

export default function AiConfigurationScreen({ navigation }) {
    const [strategy, setStrategy] = useState(STRATEGY_OPTIONS[2]); // Default Hybrid
    const [risk, setRisk] = useState(RISK_OPTIONS[1]); // Default Moderate
    const [autoTrade, setAutoTrade] = useState(true);
    const [newsFilter, setNewsFilter] = useState(true);
    const [autoSLTP, setAutoSLTP] = useState(true);

    // Modal State
    const [selectorVisible, setSelectorVisible] = useState(false);
    const [selectorType, setSelectorType] = useState(null); // 'strategy' or 'risk'

    const openSelector = (type) => {
        setSelectorType(type);
        setSelectorVisible(true);
    };

    const handleSelect = (item) => {
        if (selectorType === 'strategy') setStrategy(item);
        if (selectorType === 'risk') setRisk(item);
        setSelectorVisible(false);
    };

    const currentOptions = selectorType === 'strategy' ? STRATEGY_OPTIONS : RISK_OPTIONS;

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">
            <View className="absolute top-0 right-0 w-[400] h-[400] bg-brand-500/5 rounded-full blur-[100px]" />

            {/* Header */}
            <View className="px-6 py-4 flex-row items-center gap-4 bg-[#050505] border-b border-white/5">
                <TouchableOpacity
                    className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10"
                    onPress={() => navigation.goBack()}
                >
                    <ArrowLeft color="white" size={20} />
                </TouchableOpacity>
                <View>
                    <Text className="text-white font-bold text-lg font-sans">AI Configuration</Text>
                    <Text className="text-gray-400 text-xs font-sans">Customize your bot logic</Text>
                </View>
            </View>

            <ScrollView className="flex-1 px-6 pt-8">

                {/* 1. Strategy Selector (Dropdown Style) */}
                <View className="mb-6">
                    <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">Trading Strategy</Text>
                    <TouchableOpacity
                        onPress={() => openSelector('strategy')}
                        className="bg-dark-card border border-white/10 rounded-2xl p-4 flex-row items-center justify-between active:bg-white/5"
                    >
                        <View className="flex-row items-center gap-4">
                            <View className="w-10 h-10 bg-brand-500/10 rounded-full items-center justify-center">
                                <Zap color="#f59e0b" size={20} />
                            </View>
                            <View>
                                <Text className="text-white font-bold text-base">{strategy.label}</Text>
                                <Text className="text-gray-500 text-xs">{strategy.desc}</Text>
                            </View>
                        </View>
                        <ChevronDown color="#6b7280" size={20} />
                    </TouchableOpacity>
                </View>

                {/* 2. Risk Selector (Dropdown Style) */}
                <View className="mb-8">
                    <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">Risk Appetite</Text>
                    <TouchableOpacity
                        onPress={() => openSelector('risk')}
                        className="bg-dark-card border border-white/10 rounded-2xl p-4 flex-row items-center justify-between active:bg-white/5"
                    >
                        <View className="flex-row items-center gap-4">
                            <View className="w-10 h-10 bg-emerald-500/10 rounded-full items-center justify-center">
                                <Shield color="#10b981" size={20} />
                            </View>
                            <View>
                                <Text className="text-white font-bold text-base">{risk.label}</Text>
                                <Text className="text-gray-500 text-xs">{risk.desc}</Text>
                            </View>
                        </View>
                        <ChevronDown color="#6b7280" size={20} />
                    </TouchableOpacity>
                </View>

                {/* 3. Automation Toggles */}
                <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-3">Automation Logic</Text>
                <View className="bg-dark-card rounded-2xl border border-white/5 overflow-hidden">
                    {[
                        { label: 'Auto-Execution', desc: 'Allow AI to open/close trades', value: autoTrade, set: setAutoTrade },
                        { label: 'Smart SL/TP', desc: 'Auto-calculate exit points', value: autoSLTP, set: setAutoSLTP },
                        { label: 'News Filter', desc: 'Pause during high-impact news', value: newsFilter, set: setNewsFilter },
                    ].map((item, index) => (
                        <View key={index} className={`p-4 flex-row items-center justify-between ${index !== 2 ? 'border-b border-white/5' : ''}`}>
                            <View>
                                <Text className="text-white font-bold text-sm mb-0.5">{item.label}</Text>
                                <Text className="text-gray-500 text-[10px]">{item.desc}</Text>
                            </View>
                            <Switch
                                trackColor={{ false: '#374151', true: '#f59e0b' }}
                                thumbColor={'#fff'}
                                value={item.value}
                                onValueChange={item.set}
                            />
                        </View>
                    ))}
                </View>

            </ScrollView>

            {/* Save Button */}
            <View className="p-6 bg-[#050505] border-t border-white/5">
                <TouchableOpacity
                    className="w-full bg-brand-500 py-4 rounded-xl flex-row items-center justify-center gap-2 shadow-lg active:scale-95"
                    onPress={() => navigation.goBack()}
                >
                    <Save color="white" size={20} />
                    <Text className="text-white font-bold text-lg font-sans">Save Configuration</Text>
                </TouchableOpacity>
            </View>

            {/* --- SELECTION MODAL --- */}
            <Modal
                animationType="slide"
                transparent={true}
                visible={selectorVisible}
                onRequestClose={() => setSelectorVisible(false)}
            >
                <View className="flex-1 justify-end bg-black/80">
                    <View className="bg-[#1a1a1a] rounded-t-3xl p-6 h-[45%]">
                        <View className="w-10 h-1 bg-gray-600 rounded-full self-center mb-4" />
                        <Text className="text-white font-bold text-xl mb-6 text-center">
                            Select {selectorType === 'strategy' ? 'Strategy' : 'Risk Profile'}
                        </Text>

                        <FlatList
                            data={currentOptions}
                            keyExtractor={item => item.id}
                            renderItem={({ item }) => (
                                <TouchableOpacity
                                    className={`p-4 mb-3 rounded-xl border flex-row items-center justify-between ${(selectorType === 'strategy' ? strategy.id : risk.id) === item.id
                                            ? 'bg-brand-500/10 border-brand-500'
                                            : 'bg-white/5 border-white/5'
                                        }`}
                                    onPress={() => handleSelect(item)}
                                >
                                    <View>
                                        <Text className={`font-bold text-base ${(selectorType === 'strategy' ? strategy.id : risk.id) === item.id ? 'text-brand-400' : 'text-white'
                                            }`}>
                                            {item.label}
                                        </Text>
                                        <Text className="text-gray-500 text-xs">{item.desc}</Text>
                                    </View>
                                    {(selectorType === 'strategy' ? strategy.id : risk.id) === item.id && (
                                        <Check color="#f59e0b" size={20} />
                                    )}
                                </TouchableOpacity>
                            )}
                        />
                    </View>
                </View>
            </Modal>

        </SafeAreaView>
    );
}
