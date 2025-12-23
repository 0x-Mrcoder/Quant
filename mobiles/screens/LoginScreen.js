import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, Image, KeyboardAvoidingView, Platform, ScrollView } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Mail, Lock, ArrowRight } from 'lucide-react-native';

export default function LoginScreen({ navigation }) {
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const handleLogin = () => {
        // Mock login
        navigation.replace('Main');
    };

    return (
        <SafeAreaView className="flex-1 bg-dark-bg">
            {/* Background Gradients */}
            <View className="absolute top-0 right-0 w-80 h-80 bg-brand-500/10 rounded-full blur-[100px]" />
            <View className="absolute bottom-0 left-0 w-80 h-80 bg-accent-500/10 rounded-full blur-[100px]" />

            <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} className="flex-1">
                <ScrollView contentContainerStyle={{ flexGrow: 1, justifyContent: 'center' }} className="px-8">

                    <View className="items-center mb-10">
                        <View className="w-20 h-20 bg-white/5 border border-white/10 rounded-2xl items-center justify-center mb-6">
                            <Image source={require('../assets/logo.png')} className="w-10 h-10" resizeMode="contain" />
                        </View>
                        <Text className="text-3xl font-bold text-white mb-2">Welcome Back</Text>
                        <Text className="text-gray-400">Sign in to your trading desk</Text>
                    </View>

                    {/* Form */}
                    <View className="space-y-4">
                        <View className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex-row items-center gap-3">
                            <Mail color="#9ca3af" size={20} />
                            <TextInput
                                placeholder="Email Address"
                                placeholderTextColor="#6b7280"
                                className="flex-1 text-white font-medium"
                                value={email}
                                onChangeText={setEmail}
                                autoCapitalize="none"
                            />
                        </View>
                        <View className="bg-white/5 border border-white/10 rounded-xl px-4 py-3 flex-row items-center gap-3">
                            <Lock color="#9ca3af" size={20} />
                            <TextInput
                                placeholder="Password"
                                placeholderTextColor="#6b7280"
                                className="flex-1 text-white font-medium"
                                value={password}
                                onChangeText={setPassword}
                                secureTextEntry
                            />
                        </View>

                        <TouchableOpacity onPress={() => { }} className="items-end">
                            <Text className="text-brand-400 text-sm font-medium">Forgot Password?</Text>
                        </TouchableOpacity>
                    </View>

                    {/* Buttons */}
                    <View className="mt-8 space-y-4">
                        <TouchableOpacity
                            className="bg-brand-600 rounded-xl py-4 flex-row items-center justify-center shadow-lg shadow-brand-500/20 active:bg-brand-700"
                            onPress={handleLogin}
                        >
                            <Text className="text-white font-bold text-lg mr-2">Sign In</Text>
                            <ArrowRight color="white" size={20} />
                        </TouchableOpacity>

                        <View className="flex-row items-center my-2">
                            <View className="flex-1 h-[1px] bg-white/10" />
                            <Text className="text-gray-500 px-4 text-xs font-bold">OR CONTINUE WITH</Text>
                            <View className="flex-1 h-[1px] bg-white/10" />
                        </View>

                        <TouchableOpacity
                            className="bg-white rounded-xl py-4 flex-row items-center justify-center space-x-3 active:bg-gray-100"
                            onPress={handleLogin} // Mock Google Action
                        >
                            {/* Google Icon SVG Placeholder */}
                            <View className="w-5 h-5 bg-transparent border-2 border-red-500 rounded-full items-center justify-center mr-2">
                                <Text className="text-red-500 font-bold text-xs">G</Text>
                            </View>
                            <Text className="text-gray-900 font-bold text-base">Google Account</Text>
                        </TouchableOpacity>
                    </View>

                    <View className="mt-8 flex-row justify-center">
                        <Text className="text-gray-400">Don't have an account? </Text>
                        <TouchableOpacity>
                            <Text className="text-brand-400 font-bold">Sign Up</Text>
                        </TouchableOpacity>
                    </View>
                </ScrollView>
            </KeyboardAvoidingView>
        </SafeAreaView>
    );
}
