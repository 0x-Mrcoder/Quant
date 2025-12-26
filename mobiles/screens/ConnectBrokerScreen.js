import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, ScrollView, Animated, KeyboardAvoidingView, Platform } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ArrowLeft, Server, Key, User, HelpCircle, Shield, CheckCircle2 } from 'lucide-react-native';

export default function ConnectBrokerScreen({ navigation }) {
    const [step, setStep] = useState(1); // 1: Platform, 2: Details
    const [platform, setPlatform] = useState('mt5');
    const [server, setServer] = useState('');
    const [login, setLogin] = useState('');
    const [password, setPassword] = useState('');
    const [loading, setLoading] = useState(false);

    const handleConnect = () => {
        setLoading(true);
        // Simulate connection
        setTimeout(() => {
            setLoading(false);
            const newAccount = {
                id: Math.random().toString(),
                login: login || 'New Account',
                server: server || 'New Server',
                balance: 10000.00, // Mock Balance
                profit: 0,
                strategy: 'Standard'
            };

            // Navigate back to Home and pass new account
            navigation.navigate('Main', {
                screen: 'Home',
                params: { newAccount }
            });
        }, 2000);
    };

    const ProgressBar = () => (
        <View className="flex-row gap-2 mb-8 px-6">
            <View className={`h-1 flex-1 rounded-full ${step >= 1 ? 'bg-brand-500' : 'bg-white/10'}`} />
            <View className={`h-1 flex-1 rounded-full ${step >= 2 ? 'bg-brand-500' : 'bg-white/10'}`} />
        </View>
    );

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">
            {/* Background Decoration */}
            <View className="absolute top-0 right-0 w-[300] h-[300] bg-brand-500/5 rounded-full blur-[80px]" />

            {/* Header */}
            <View className="px-6 py-4 flex-row items-center justify-between">
                <TouchableOpacity
                    className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10 active:bg-white/10"
                    onPress={() => step === 2 ? setStep(1) : navigation.goBack()}
                >
                    <ArrowLeft color="white" size={20} />
                </TouchableOpacity>
                <Text className="text-white font-bold text-lg font-sans">
                    {step === 1 ? 'Select Platform' : 'Account Details'}
                </Text>
                <View className="w-10" />
            </View>

            <ProgressBar />

            <KeyboardAvoidingView
                behavior={Platform.OS === "ios" ? "padding" : "height"}
                className="flex-1"
            >
                <ScrollView className="flex-1" contentContainerStyle={{ paddingHorizontal: 24, paddingBottom: 40 }}>

                    {/* STEP 1: SELECT PLATFORM */}
                    {step === 1 && (
                        <View className="animate-fade-in-up">
                            <Text className="text-3xl font-bold text-white font-sans mb-3 text-center">
                                Where is your account?
                            </Text>
                            <Text className="text-gray-400 text-center font-sans mb-10 px-4">
                                Choose the trading platform your broker uses. Most brokers use MetaTrader 5.
                            </Text>

                            <View className="gap-4">
                                {/* MT5 Option */}
                                <TouchableOpacity
                                    onPress={() => setPlatform('mt5')}
                                    className={`p-6 rounded-3xl border-2 transition-all flex-row items-center justify-between ${platform === 'mt5' ? 'bg-brand-500/10 border-brand-500 shadow-lg shadow-brand-500/20' : 'bg-dark-card border-white/5'}`}
                                >
                                    <View className="flex-row items-center gap-4">
                                        <View className="w-14 h-14 bg-[#292D32] rounded-2xl items-center justify-center">
                                            <Text className="text-white font-bold text-xl">5</Text>
                                        </View>
                                        <View>
                                            <Text className={`font-bold text-lg ${platform === 'mt5' ? 'text-white' : 'text-gray-300'}`}>MetaTrader 5</Text>
                                            <Text className="text-gray-500 text-xs">Recommended (Faster)</Text>
                                        </View>
                                    </View>
                                    {platform === 'mt5' && <CheckCircle2 color="#f59e0b" size={24} fill="#f59e0b20" />}
                                </TouchableOpacity>

                                {/* MT4 Option */}
                                <TouchableOpacity
                                    onPress={() => setPlatform('mt4')}
                                    className={`p-6 rounded-3xl border-2 transition-all flex-row items-center justify-between ${platform === 'mt4' ? 'bg-brand-500/10 border-brand-500' : 'bg-dark-card border-white/5 opacity-80'}`}
                                >
                                    <View className="flex-row items-center gap-4">
                                        <View className="w-14 h-14 bg-[#292D32] rounded-2xl items-center justify-center">
                                            <Text className="text-white font-bold text-xl">4</Text>
                                        </View>
                                        <View>
                                            <Text className={`font-bold text-lg ${platform === 'mt4' ? 'text-white' : 'text-gray-300'}`}>MetaTrader 4</Text>
                                            <Text className="text-gray-500 text-xs">Standard Legacy</Text>
                                        </View>
                                    </View>
                                    {platform === 'mt4' && <CheckCircle2 color="#f59e0b" size={24} fill="#f59e0b20" />}
                                </TouchableOpacity>
                            </View>

                            <TouchableOpacity
                                onPress={() => setStep(2)}
                                className="mt-12 w-full bg-white py-4 rounded-full items-center shadow-xl active:scale-95"
                            >
                                <Text className="text-black font-bold text-lg font-sans">Continue</Text>
                            </TouchableOpacity>
                        </View>
                    )}

                    {/* STEP 2: CREDENTIALS */}
                    {step === 2 && (
                        <View className="animate-fade-in-up">
                            <View className="bg-brand-500/10 self-center px-4 py-1 rounded-full mb-6 border border-brand-500/20">
                                <Text className="text-brand-400 text-xs font-bold uppercase tracking-wider">Connecting to {platform === 'mt5' ? 'MetaTrader 5' : 'MetaTrader 4'}</Text>
                            </View>

                            {/* Inputs Group */}
                            <View className="gap-5">

                                {/* Login */}
                                <View>
                                    <Text className="text-white font-bold ml-1 mb-2">Account Number (Login)</Text>
                                    <View className="flex-row items-center bg-[#1a1a1a] rounded-xl border border-white/10 px-4 h-14 focus:border-brand-500">
                                        <User color="#6b7280" size={20} />
                                        <TextInput
                                            className="flex-1 text-white font-sans ml-3 text-base"
                                            placeholder="e.g. 501239912"
                                            placeholderTextColor="#4b5563"
                                            keyboardType="numeric"
                                            value={login}
                                            onChangeText={setLogin}
                                            autoFocus
                                        />
                                    </View>
                                </View>

                                {/* Password */}
                                <View>
                                    <Text className="text-white font-bold ml-1 mb-2">Master Password</Text>
                                    <View className="flex-row items-center bg-[#1a1a1a] rounded-xl border border-white/10 px-4 h-14 focus:border-brand-500">
                                        <Key color="#6b7280" size={20} />
                                        <TextInput
                                            className="flex-1 text-white font-sans ml-3 text-base"
                                            placeholder="Your trading password"
                                            placeholderTextColor="#4b5563"
                                            secureTextEntry
                                            value={password}
                                            onChangeText={setPassword}
                                        />
                                    </View>
                                    <View className="flex-row items-center gap-1 mt-2 px-1">
                                        <Shield color="#10b981" size={12} />
                                        <Text className="text-emerald-500 text-[10px]">Encrypted & Secure</Text>
                                    </View>
                                </View>

                                {/* Server */}
                                <View>
                                    <View className="flex-row justify-between mb-2 px-1">
                                        <Text className="text-white font-bold">Broker Server</Text>
                                        <TouchableOpacity>
                                            <Text className="text-brand-400 text-xs font-bold">Where do I find this?</Text>
                                        </TouchableOpacity>
                                    </View>
                                    <View className="flex-row items-center bg-[#1a1a1a] rounded-xl border border-white/10 px-4 h-14 focus:border-brand-500">
                                        <Server color="#6b7280" size={20} />
                                        <TextInput
                                            className="flex-1 text-white font-sans ml-3 text-base"
                                            placeholder="Search broker server..."
                                            placeholderTextColor="#4b5563"
                                            value={server}
                                            onChangeText={setServer}
                                        />
                                    </View>
                                </View>
                            </View>

                            {/* Action Button */}
                            <TouchableOpacity
                                className={`mt-10 w-full py-4 rounded-full items-center shadow-xl active:scale-95 ${loading ? 'bg-white/10' : 'bg-brand-500'}`}
                                onPress={handleConnect}
                                disabled={loading}
                            >
                                <Text className={`font-bold text-lg font-sans ${loading ? 'text-gray-400' : 'text-white'}`}>
                                    {loading ? 'Connecting...' : 'Secure Connect'}
                                </Text>
                            </TouchableOpacity>

                            <View className="mt-6 flex-row justify-center gap-1">
                                <Text className="text-gray-500 text-xs">By connecting, you agree to our</Text>
                                <Text className="text-brand-400 text-xs font-bold">Terms of Service</Text>
                            </View>
                        </View>
                    )}

                </ScrollView>
            </KeyboardAvoidingView>
        </SafeAreaView>
    );
}
