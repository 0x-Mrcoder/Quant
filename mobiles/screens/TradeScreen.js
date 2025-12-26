import React, { useState } from 'react';
import { View, Text, TouchableOpacity, Dimensions, ScrollView, TextInput, KeyboardAvoidingView, Platform } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ChevronDown, Brain, Zap, Send, Activity, Check } from 'lucide-react-native';
import { LinearGradient } from 'expo-linear-gradient';

const { width } = Dimensions.get('window');

// Available Pairs for Selection
const AVAILABLE_PAIRS = [
    { id: 'XAUUSD', name: 'Gold', rate: '2034.50', change: '+1.24%' },
    { id: 'EURUSD', name: 'Euro', rate: '1.0924', change: '-0.15%' },
    { id: 'GBPUSD', name: 'Pound', rate: '1.2750', change: '+0.05%' },
    { id: 'BTCUSD', name: 'Bitcoin', rate: '42150.00', change: '+2.10%' },
    { id: 'US30', name: 'Dow Jones', rate: '37400.00', change: '+0.50%' },
];

import LiveChart from '../components/LiveChart';

const MOCK_CHAT = [
    { id: 1, sender: 'AI', text: 'Analyzing XAUUSD order flow...', time: '10:23' },
    { id: 2, sender: 'AI', text: 'Bullish divergence detected on M15. Key support at 2032.50.', time: '10:23' },
];

export default function TradeScreen({ navigation }) {
    const [messages, setMessages] = useState(MOCK_CHAT);
    const [input, setInput] = useState('');
    const [activeTab, setActiveTab] = useState('Chart'); // Chart, Chat

    // Pair Selection State
    const [selectedPairs, setSelectedPairs] = useState(['XAUUSD']);
    const [showPairSelector, setShowPairSelector] = useState(false);

    const togglePair = (id) => {
        if (selectedPairs.includes(id)) {
            // Prevent deselecting the last one
            if (selectedPairs.length > 1) {
                setSelectedPairs(selectedPairs.filter(p => p !== id));
            }
        } else {
            setSelectedPairs([...selectedPairs, id]);
        }
    };

    const sendMessage = () => {
        if (!input.trim()) return;
        const newMsg = { id: Date.now(), sender: 'User', text: input, time: 'Now' };
        setMessages(prev => [...prev, newMsg]);
        setInput('');

        // Sim AI Response
        setTimeout(() => {
            setMessages(prev => [...prev, { id: Date.now() + 1, sender: 'AI', text: 'Copy that. Recalculating risk parameters based on your input.', time: 'Now' }]);
        }, 1000);
    };

    return (
        <SafeAreaView className="flex-1 bg-[#050505] font-sans">

            {/* 1. Header: Alpha Terminal Style */}
            <View className="px-5 py-3 border-b border-white/5 flex-row justify-between items-center bg-[#050505] z-30 shadow-lg relative">
                <TouchableOpacity
                    className="flex-row items-center gap-3 active:opacity-70"
                    onPress={() => setShowPairSelector(!showPairSelector)}
                >
                    <LinearGradient
                        colors={['#8b5cf6', '#d946ef']}
                        className="w-10 h-10 rounded-xl items-center justify-center"
                        style={{ shadowColor: '#8b5cf6', shadowOpacity: 0.3, shadowRadius: 10 }}
                    >
                        <Text className="text-white font-bold text-xs">{selectedPairs.length > 1 ? 'ALL' : selectedPairs[0].substring(0, 2)}</Text>
                    </LinearGradient>
                    <View>
                        <Text className="text-white font-bold text-lg leading-tight flex-row items-center gap-1">
                            {selectedPairs.length > 1 ? 'Multi-Asset' : selectedPairs[0]} <ChevronDown color="#6b7280" size={14} />
                        </Text>
                        <Text className="text-emerald-400 text-xs font-bold">
                            {selectedPairs.length > 1 ? `${selectedPairs.length} Active Pairs` : '+1.24% • 2034.50'}
                        </Text>
                    </View>
                </TouchableOpacity>

                {/* Tab Switcher */}
                <View className="flex-row bg-[#1a1a1a] p-1 rounded-xl border border-white/10">
                    <TouchableOpacity
                        className={`px-3 py-1.5 rounded-lg flex-row items-center gap-2 transition-all ${activeTab === 'Chart' ? 'bg-white/10' : ''}`}
                        onPress={() => setActiveTab('Chart')}
                    >
                        <Activity color={activeTab === 'Chart' ? 'white' : '#6b7280'} size={16} />
                        {activeTab === 'Chart' && <Text className="text-white text-xs font-bold">Chart</Text>}
                    </TouchableOpacity>
                    <TouchableOpacity
                        className={`px-3 py-1.5 rounded-lg flex-row items-center gap-2 transition-all ${activeTab === 'Chat' ? 'bg-white/10' : ''}`}
                        onPress={() => setActiveTab('Chat')}
                    >
                        <Brain color={activeTab === 'Chat' ? '#f59e0b' : '#6b7280'} size={16} />
                        {activeTab === 'Chat' && <Text className="text-white text-xs font-bold">AI</Text>}
                    </TouchableOpacity>
                </View>

                {/* PAIR SELECTOR DROPDOWN (Inside Header z-index context) */}
                {showPairSelector && (
                    <View className="absolute top-[60px] left-5 w-64 bg-[#111] border border-white/10 rounded-2xl shadow-2xl p-2 z-50">
                        {AVAILABLE_PAIRS.map((pair) => {
                            const isSelected = selectedPairs.includes(pair.id);
                            return (
                                <TouchableOpacity
                                    key={pair.id}
                                    className={`flex-row justify-between items-center p-3 rounded-xl mb-1 ${isSelected ? 'bg-violet-500/10 border border-violet-500/20' : 'active:bg-white/5'}`}
                                    onPress={() => togglePair(pair.id)}
                                >
                                    <View>
                                        <Text className={`font-bold text-sm ${isSelected ? 'text-violet-400' : 'text-gray-300'}`}>{pair.id}</Text>
                                        <Text className="text-[10px] text-gray-500">{pair.name}</Text>
                                    </View>
                                    {isSelected && (
                                        <View className="bg-violet-500 rounded-full p-0.5">
                                            <Check size={12} color="white" />
                                        </View>
                                    )}
                                </TouchableOpacity>
                            );
                        })}
                    </View>
                )}
            </View>

            {/* 2. Main Content Area */}
            <View className="flex-1 z-10" onStartShouldSetResponder={() => setShowPairSelector(false)}>

                {/* CHART TAB */}
                <View className={`flex-1 ${activeTab === 'Chart' ? 'flex' : 'hidden'}`}>
                    {/* Timeframes */}
                    <View className="flex-row px-4 py-3 gap-2 border-b border-white/5 bg-[#080808]">
                        {['1M', '5M', '15M', '1H', '4H'].map(tf => (
                            <TouchableOpacity key={tf} className={`px-3 py-1 rounded-md ${tf === '1H' ? 'bg-violet-500/20 border border-violet-500/50' : 'bg-white/5 border border-white/5'}`}>
                                <Text className={`text-[10px] font-bold ${tf === '1H' ? 'text-violet-400' : 'text-gray-500'}`}>{tf}</Text>
                            </TouchableOpacity>
                        ))}
                    </View>

                    {/* Chart Visualization */}
                    <View className="flex-1 bg-[#050505]">
                        <LiveChart />
                    </View>
                </View>

                {/* CHAT TAB (PipFlow AI) */}
                <View className={`flex-1 bg-[#0a0a0a] ${activeTab === 'Chat' ? 'flex' : 'hidden'}`}>
                    <ScrollView
                        className="flex-1 px-4 py-4"
                        contentContainerStyle={{ paddingBottom: 100 }}
                    >
                        {/* AI Greeting / Status */}
                        <View className="mb-6 flex-row items-center gap-3 bg-white/5 p-4 rounded-xl border border-white/5">
                            <View className="w-10 h-10 rounded-full bg-cyan-500/20 items-center justify-center border border-cyan-500/30">
                                <Activity color="#22d3ee" size={20} />
                            </View>
                            <View>
                                <Text className="text-white font-bold text-sm">System Online</Text>
                                <Text className="text-cyan-400 text-xs">Latency: 12ms</Text>
                            </View>
                        </View>

                        {messages.map((msg) => (
                            <View key={msg.id} className={`flex-row mb-4 ${msg.sender === 'User' ? 'justify-end' : 'justify-start'}`}>
                                {msg.sender === 'AI' && (
                                    <View className="w-8 h-8 rounded-full bg-gradient-to-br from-cyan-500 to-blue-600 items-center justify-center mr-2 shadow-lg shadow-cyan-500/20">
                                        <Zap size={14} color="white" fill="white" />
                                    </View>
                                )}
                                <View className={`max-w-[80%] p-3 rounded-2xl ${msg.sender === 'User' ? 'bg-violet-600 rounded-tr-none' : 'bg-[#1a1a1a] border border-white/5 rounded-tl-none'}`}>
                                    <Text className="text-white text-sm leading-5">{msg.text}</Text>
                                    <Text className="text-gray-500 text-[10px] text-right mt-1">{msg.time}</Text>
                                </View>
                            </View>
                        ))}
                    </ScrollView>

                    {/* Input - FIXED LAYOUT with pb-24*/}
                    <KeyboardAvoidingView
                        behavior={Platform.OS === 'ios' ? 'padding' : 'height'}
                        keyboardVerticalOffset={Platform.OS === 'ios' ? 90 : 0}
                    >
                        <View className="p-4 border-t border-white/5 bg-[#0a0a0a] flex-row gap-2 pb-24">
                            <TextInput
                                value={input}
                                onChangeText={setInput}
                                placeholder="Ask PipFlow..."
                                placeholderTextColor="#666"
                                className="flex-1 bg-[#151515] border border-white/10 rounded-xl px-4 text-white h-12"
                            />
                            <TouchableOpacity
                                onPress={sendMessage}
                                className="w-12 h-12 bg-violet-600 rounded-xl items-center justify-center active:bg-violet-700"
                            >
                                <Send color="white" size={20} />
                            </TouchableOpacity>
                        </View>
                    </KeyboardAvoidingView>
                </View>
            </View>
        </SafeAreaView>
    );
}
