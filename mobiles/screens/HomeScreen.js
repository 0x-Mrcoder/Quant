import React, { useState, useEffect } from 'react';
import { View, Text, TouchableOpacity, Dimensions, Animated, Easing, Modal, ScrollView, Image } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Settings, Zap, Power, Disc, Activity, ChevronDown, Plus, Monitor, TerminalSquare, TrendingUp, BarChart3, ShieldCheck, ArrowRight } from 'lucide-react-native';

const { width } = Dimensions.get('window');

// Mock Data (Moved outside to be used only when connected)
const FULL_MOCK_ACCOUNT = {
    id: '1', login: '501239912', server: 'Deriv-Server',
    balance: 24592.50, profit: 1250.50, strategy: 'Hybrid',
    totalTrades: 142, winRate: 78,
};

const AI_LOGS = [
    { time: '10:42:01', msg: 'Scanning EURUSD (H1) for liquidity sweeps...' },
    { time: '10:42:05', msg: 'No high-probability setups found.' },
    { time: '10:42:12', msg: 'Analyzing XAUUSD market structure...' },
    { time: '10:42:15', msg: 'Bullish Order Block detected at 2038.50.' },
    { time: '10:42:18', msg: 'Awaiting entry confirmation trigger.' },
];

export default function HomeScreen({ navigation, route }) {
    // START EMPTY by default
    const [accounts, setAccounts] = useState([]);
    const [activeAccountId, setActiveAccountId] = useState(null);
    const [isSwitcherVisible, setSwitcherVisible] = useState(false);
    const [isActive, setIsActive] = useState(false);
    const [pulseAnim] = useState(new Animated.Value(1));
    const [logs, setLogs] = useState([]);

    const activeAccount = accounts.find(a => a.id === activeAccountId) || null;
    const isConnected = accounts.length > 0;

    // Effect: Handle New Connection or Fresh Signup
    useEffect(() => {
        if (route.params?.newAccount) {
            // User connected a broker
            const newAcc = route.params.newAccount;
            setAccounts(prev => [...prev, newAcc]);
            setActiveAccountId(newAcc.id);
            setLogs(AI_LOGS); // Start showing logs
        } else if (route.params?.isFreshSignup) {
            // Fresh signup - ensure empty
            setAccounts([]);
            setActiveAccountId(null);
        }
    }, [route.params]);

    // Live Log Simulation (Only if connected)
    useEffect(() => {
        if (isActive && isConnected) {
            const interval = setInterval(() => {
                const newLog = {
                    time: new Date().toLocaleTimeString('en-US', { hour12: false, hour: '2-digit', minute: '2-digit', second: '2-digit' }),
                    msg: 'Monitoring live price action...'
                };
                setLogs(prev => [newLog, ...prev.slice(0, 4)]);
            }, 3000);
            return () => clearInterval(interval);
        }
    }, [isActive, isConnected]);

    // Animation
    useEffect(() => {
        if (isActive && isConnected) {
            Animated.loop(
                Animated.sequence([
                    Animated.timing(pulseAnim, { toValue: 1.2, duration: 1500, easing: Easing.inOut(Easing.ease), useNativeDriver: true }),
                    Animated.timing(pulseAnim, { toValue: 1, duration: 1500, easing: Easing.inOut(Easing.ease), useNativeDriver: true }),
                ])
            ).start();
        } else {
            pulseAnim.setValue(1);
        }
    }, [isActive, isConnected]);

    // --- RENDER ---
    return (
        <SafeAreaView className="flex-1 bg-[#050505] font-sans">

            {/* 1. Header */}
            <View className="px-6 py-4 flex-row justify-between items-start mb-6">
                <TouchableOpacity
                    activeOpacity={0.7}
                    onPress={() => isConnected && setSwitcherVisible(true)}
                    className="flex-row items-center gap-2"
                >
                    <View>
                        {isConnected ? (
                            <>
                                <Text className="text-gray-500 text-xs font-bold tracking-widest uppercase mb-1">
                                    {activeAccount?.server}
                                </Text>
                                <View className="flex-row items-center gap-2">
                                    <Text className="text-white font-bold text-3xl font-sans">
                                        ${(activeAccount?.balance || 0).toLocaleString('en-US', { minimumFractionDigits: 2 })}
                                    </Text>
                                    <ChevronDown color="#6b7280" size={20} />
                                </View>
                                <Text className="text-gray-600 text-xs font-bold tracking-widest uppercase mt-0.5">
                                    ID: {activeAccount?.login}
                                </Text>
                            </>
                        ) : (
                            <View>
                                <Text className="text-gray-500 text-xs font-bold tracking-widest uppercase mb-1">
                                    Welcome
                                </Text>
                                <Text className="text-white font-bold text-2xl font-sans">
                                    Ready to Trade?
                                </Text>
                            </View>
                        )}
                    </View>
                </TouchableOpacity>

                <TouchableOpacity
                    className="p-3 bg-white/5 rounded-full border border-white/5"
                    onPress={() => navigation.navigate('AiConfiguration')}
                >
                    <Settings color="#6b7280" size={20} />
                </TouchableOpacity>
            </View>

            <ScrollView className="flex-1" contentContainerStyle={{ paddingBottom: 100 }}>

                {/* FRESH ACCOUNT STATE */}
                {!isConnected ? (
                    <View className="px-6 mt-10">
                        {/* Minimal Hero Card */}
                        <View className="bg-[#111] rounded-3xl p-8 border border-white/5 items-center relative overflow-hidden">
                            <View className="absolute inset-0 bg-brand-500/5 blur-xl" />

                            <View className="w-20 h-20 bg-[#1a1a1a] rounded-full items-center justify-center mb-6 border border-white/10 shadow-xl">
                                <Zap color="#f59e0b" size={32} fill="#f59e0b" />
                            </View>

                            <Text className="text-white font-bold text-2xl text-center mb-3">
                                Connect Your Broker
                            </Text>
                            <Text className="text-gray-400 text-center leading-relaxed mb-8">
                                Link your trading account (MT4/MT5) to activate the PipFlow AI engine. We only execute; you stay in control.
                            </Text>

                            <TouchableOpacity
                                className="w-full bg-brand-500 py-4 rounded-xl flex-row items-center justify-center shadow-lg shadow-brand-500/20 active:scale-95 transition-all"
                                onPress={() => navigation.navigate('ConnectBroker')}
                            >
                                <Text className="text-white font-bold text-lg mr-2">Connect Account</Text>
                                <ArrowRight color="white" size={20} />
                            </TouchableOpacity>

                            <View className="flex-row items-center gap-2 mt-6">
                                <ShieldCheck color="#10b981" size={14} />
                                <Text className="text-gray-600 text-xs font-bold uppercase">Bank-Grade Encryption</Text>
                            </View>
                        </View>

                        {/* Teaser Data (Blurred or Placeholder) */}
                        <View className="mt-10 opacity-30">
                            <Text className="text-gray-500 text-xs font-bold uppercase tracking-widest mb-3">AI Engine Preview</Text>
                            <View className="flex-row gap-4 mb-4">
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5 h-24" />
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5 h-24" />
                            </View>
                        </View>
                    </View>
                ) : (
                    <>
                        {/* 2. The Activator (Compact) */}
                        <View className="items-center justify-center mb-8">
                            <TouchableOpacity
                                onPress={() => setIsActive(!isActive)}
                                activeOpacity={0.8}
                                className="items-center justify-center relative mb-4"
                            >
                                {isActive && (
                                    <Animated.View
                                        className="absolute w-40 h-40 bg-emerald-500/20 rounded-full"
                                        style={{ transform: [{ scale: pulseAnim }] }}
                                    />
                                )}
                                <View className={`w-32 h-32 rounded-full items-center justify-center border-4 shadow-2xl transition-all ${isActive ? 'bg-black border-emerald-500 shadow-emerald-500/20' : 'bg-white border-white shadow-white/10'}`}>
                                    <Power color={isActive ? '#10b981' : '#000'} size={40} fill={isActive ? '#10b981' : 'none'} />
                                </View>
                            </TouchableOpacity>
                            <View className={`px-4 py-1.5 rounded-full ${isActive ? 'bg-emerald-500/10' : 'bg-white/5'}`}>
                                <Text className={`font-bold text-xs tracking-widest ${isActive ? 'text-emerald-400' : 'text-gray-500'}`}>
                                    {isActive ? 'AI ENGINE: ONLINE' : 'STANDBY MODE'}
                                </Text>
                            </View>
                        </View>

                        {/* 3. Performance Matrix */}
                        <View className="px-6 mb-6">
                            <Text className="text-gray-500 text-xs font-bold uppercase tracking-widest mb-3">Performance Matrix</Text>
                            <View className="flex-row gap-4 mb-4">
                                {/* Profit Card */}
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5">
                                    <View className="flex-row items-center gap-2 mb-2">
                                        <Activity color="#10b981" size={16} />
                                        <Text className="text-gray-400 text-xs font-bold uppercase">Total Profit</Text>
                                    </View>
                                    <Text className="text-white font-bold text-lg">
                                        {activeAccount.profit >= 0 ? '+' : ''}${activeAccount.profit.toLocaleString()}
                                    </Text>
                                </View>
                                {/* Win Rate Card */}
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5">
                                    <View className="flex-row items-center gap-2 mb-2">
                                        <TrendingUp color="#f59e0b" size={16} />
                                        <Text className="text-gray-400 text-xs font-bold uppercase">Win Rate</Text>
                                    </View>
                                    <Text className="text-white font-bold text-lg">
                                        {activeAccount.winRate}%
                                    </Text>
                                </View>
                            </View>
                            <View className="flex-row gap-4">
                                {/* Total Trades Card */}
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5">
                                    <View className="flex-row items-center gap-2 mb-2">
                                        <BarChart3 color="#3b82f6" size={16} />
                                        <Text className="text-gray-400 text-xs font-bold uppercase">Total Trades</Text>
                                    </View>
                                    <Text className="text-white font-bold text-lg">
                                        {activeAccount.totalTrades}
                                    </Text>
                                </View>
                                {/* Strategy Card */}
                                <View className="flex-1 bg-[#1a1a1a] rounded-2xl p-4 border border-white/5">
                                    <View className="flex-row items-center gap-2 mb-2">
                                        <Disc color="#8b5cf6" size={16} />
                                        <Text className="text-gray-400 text-xs font-bold uppercase">Mode</Text>
                                    </View>
                                    <Text className="text-white font-bold text-lg" numberOfLines={1}>
                                        {activeAccount.strategy}
                                    </Text>
                                </View>
                            </View>
                        </View>

                        {/* 4. AI Live Terminal */}
                        <View className="px-6 mb-8">
                            <View className="flex-row items-center gap-2 mb-3">
                                <TerminalSquare color="#6b7280" size={14} />
                                <Text className="text-gray-500 text-xs font-bold uppercase tracking-widest">Live Engine Logs</Text>
                            </View>

                            <View className="bg-[#0a0a0a] rounded-2xl p-4 border border-white/5 h-40">
                                <ScrollView className="flex-1">
                                    {logs.map((log, index) => (
                                        <View key={index} className="flex-row gap-3 mb-2">
                                            <Text className="text-gray-600 text-[10px] font-mono mt-0.5">{log.time}</Text>
                                            <Text className="text-gray-400 text-xs font-mono flex-1 leading-5">{log.msg}</Text>
                                        </View>
                                    ))}
                                </ScrollView>
                                {isActive && (
                                    <View className="flex-row items-center gap-2 mt-2">
                                        <View className="w-2 h-2 bg-emerald-500 rounded-full animate-pulse" />
                                        <Text className="text-emerald-500 text-[10px] font-bold">LIVE PROCESSING</Text>
                                    </View>
                                )}
                            </View>
                        </View>
                    </>
                )}

            </ScrollView>

            {/* Account Switcher Modal */}
            <Modal
                animationType="slide"
                transparent={true}
                visible={isSwitcherVisible}
                onRequestClose={() => setSwitcherVisible(false)}
            >
                <View className="flex-1 justify-end bg-black/80">
                    <View className="bg-[#1a1a1a] rounded-t-3xl p-6 h-[50%]">
                        <View className="w-10 h-1 bg-gray-600 rounded-full self-center mb-6" />
                        <Text className="text-white font-bold text-xl mb-4">Select Account</Text>
                        <ScrollView className="flex-1">
                            {accounts.map(account => (
                                <TouchableOpacity
                                    key={account.id}
                                    onPress={() => { setActiveAccountId(account.id); setSwitcherVisible(false); }}
                                    className={`p-4 rounded-xl border mb-3 flex-row items-center justify-between ${activeAccountId === account.id ? 'bg-brand-500/10 border-brand-500' : 'bg-white/5 border-white/5'}`}
                                >
                                    <View className="flex-row items-center gap-4">
                                        <View className="w-10 h-10 bg-[#292D32] rounded-full items-center justify-center">
                                            <Monitor color={activeAccountId === account.id ? '#f59e0b' : '#6b7280'} size={20} />
                                        </View>
                                        <View>
                                            <Text className="text-white font-bold text-base">{account.login}</Text>
                                            <Text className="text-gray-500 text-xs">{account.server}</Text>
                                        </View>
                                    </View>
                                    <Text className="text-white font-bold">${account.balance.toLocaleString()}</Text>
                                </TouchableOpacity>
                            ))}
                        </ScrollView>
                        <TouchableOpacity
                            className="mt-4 p-4 flex-row items-center justify-center gap-2 bg-white/5 rounded-xl border border-dashed border-white/20 active:bg-white/10"
                            onPress={() => { setSwitcherVisible(false); navigation.navigate('ConnectBroker'); }}
                        >
                            <Plus color="white" size={20} />
                            <Text className="text-white font-bold">Connect New Account</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>

        </SafeAreaView>
    );
}
