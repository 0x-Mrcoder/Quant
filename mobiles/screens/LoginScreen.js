import React, { useState, useRef } from 'react';
import { View, Text, TextInput, TouchableOpacity, Image, KeyboardAvoidingView, Platform, ScrollView, Animated } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Mail, Lock, ArrowRight, ArrowLeft } from 'lucide-react-native';

export default function LoginScreen({ navigation }) {
    const [step, setStep] = useState(1);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    // Animation
    const fadeAnim = useRef(new Animated.Value(1)).current;

    const handleNext = () => {
        if (!email) return; // Basic validation

        // Fade out, switch step, fade in
        Animated.sequence([
            Animated.timing(fadeAnim, { toValue: 0, duration: 200, useNativeDriver: true }),
            Animated.timing(fadeAnim, { toValue: 1, duration: 200, useNativeDriver: true })
        ]).start();

        setTimeout(() => setStep(2), 200);
    };

    const handleBack = () => {
        Animated.sequence([
            Animated.timing(fadeAnim, { toValue: 0, duration: 200, useNativeDriver: true }),
            Animated.timing(fadeAnim, { toValue: 1, duration: 200, useNativeDriver: true })
        ]).start();

        setTimeout(() => setStep(1), 200);
    };

    const handleLogin = () => {
        // Mock login
        navigation.replace('Main');
    };

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">
            {/* Background Gradients */}
            <View className="absolute top-0 left-0 w-[500] h-[500] bg-brand-500/10 rounded-full blur-[100px]" />
            <View className="absolute bottom-0 right-0 w-[500] h-[500] bg-accent-500/10 rounded-full blur-[100px]" />

            <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} className="flex-1">
                <ScrollView contentContainerStyle={{ flexGrow: 1 }} className="px-8">

                    {/* Back Button (only for Step 2) */}
                    <View className="h-16 justify-center">
                        {step === 2 && (
                            <TouchableOpacity
                                className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10"
                                onPress={handleBack}
                            >
                                <ArrowLeft color="white" size={20} />
                            </TouchableOpacity>
                        )}
                    </View>

                    <View className="flex-1 justify-center pb-20">
                        {/* Logo */}
                        <View className="items-center mb-10">
                            <View className="w-24 h-24 bg-white/5 border border-white/10 rounded-3xl items-center justify-center mb-6 shadow-2xl">
                                <Image source={require('../assets/logo.png')} className="w-12 h-12" resizeMode="contain" />
                            </View>
                            <Text className="text-3xl font-bold text-white mb-2 font-sans">Welcome Back</Text>
                            <Text className="text-gray-400 font-sans">Sign in to continue</Text>
                        </View>

                        <Animated.View style={{ opacity: fadeAnim }} className="w-full">
                            {step === 1 ? (
                                /* STEP 1: Email */
                                <View className="space-y-6">
                                    <View className="space-y-2">
                                        <Text className="text-gray-400 font-sans ml-1 text-sm">Email Address</Text>
                                        <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4 focus:border-brand-500 transition-all">
                                            <Mail color="#f59e0b" size={22} />
                                            <TextInput
                                                placeholder="hello@example.com"
                                                placeholderTextColor="#6b7280"
                                                className="flex-1 text-white font-sans text-lg"
                                                value={email}
                                                onChangeText={setEmail}
                                                autoCapitalize="none"
                                                keyboardType="email-address"
                                                autoFocus
                                            />
                                        </View>
                                    </View>

                                    <TouchableOpacity
                                        className="bg-brand-500 rounded-2xl py-5 flex-row items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95"
                                        onPress={handleNext}
                                    >
                                        <Text className="text-white font-bold text-lg font-sans mr-2">Continue</Text>
                                        <ArrowRight color="white" size={20} strokeWidth={2.5} />
                                    </TouchableOpacity>
                                </View>
                            ) : (
                                /* STEP 2: Password */
                                <View className="space-y-6">
                                    <View className="bg-brand-500/10 border border-brand-500/20 rounded-xl p-3 flex-row items-center justify-center mb-2">
                                        <Text className="text-brand-200 font-sans text-sm">{email}</Text>
                                    </View>

                                    <View className="space-y-2">
                                        <Text className="text-gray-400 font-sans ml-1 text-sm">Password</Text>
                                        <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4 focus:border-brand-500">
                                            <Lock color="#f59e0b" size={22} />
                                            <TextInput
                                                placeholder="••••••••"
                                                placeholderTextColor="#6b7280"
                                                className="flex-1 text-white font-sans text-lg"
                                                value={password}
                                                onChangeText={setPassword}
                                                secureTextEntry
                                                autoFocus
                                            />
                                        </View>
                                    </View>

                                    <TouchableOpacity onPress={() => navigation.navigate('ForgotPassword')} className="items-end">
                                        <Text className="text-brand-400 text-sm font-bold font-sans">Forgot Password?</Text>
                                    </TouchableOpacity>

                                    <TouchableOpacity
                                        className="bg-brand-500 rounded-2xl py-5 flex-row items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95"
                                        onPress={handleLogin}
                                    >
                                        <Text className="text-white font-bold text-lg font-sans mr-2">Sign In</Text>
                                        <ArrowRight color="white" size={20} strokeWidth={2.5} />
                                    </TouchableOpacity>
                                </View>
                            )}
                        </Animated.View>

                        {/* Social & Signup Trigger */}
                        <View className="mt-10">
                            <View className="flex-row items-center mb-6">
                                <View className="flex-1 h-[1px] bg-white/10" />
                                <Text className="text-gray-500 px-4 text-xs font-bold font-sans">OR</Text>
                                <View className="flex-1 h-[1px] bg-white/10" />
                            </View>

                            <TouchableOpacity
                                className="bg-white rounded-2xl py-4 flex-row items-center justify-center space-x-3 active:bg-gray-100"
                                onPress={handleLogin} // Mock Google Action
                            >
                                <View className="w-5 h-5 bg-transparent border-2 border-red-500 rounded-full items-center justify-center mr-2">
                                    <Text className="text-red-500 font-bold text-xs font-sans">G</Text>
                                </View>
                                <Text className="text-gray-900 font-bold text-base font-sans">Google Account</Text>
                            </TouchableOpacity>

                            <View className="mt-8 flex-row justify-center">
                                <Text className="text-gray-400 font-sans">New here? </Text>
                                <TouchableOpacity onPress={() => navigation.navigate('Register')}>
                                    <Text className="text-brand-500 font-bold font-sans">Create Account</Text>
                                </TouchableOpacity>
                            </View>
                        </View>

                    </View>
                </ScrollView>
            </KeyboardAvoidingView>
        </SafeAreaView>
    );
}
