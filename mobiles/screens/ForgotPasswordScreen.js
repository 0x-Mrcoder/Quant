import React, { useState } from 'react';
import { View, Text, TextInput, TouchableOpacity, Image, KeyboardAvoidingView, Platform, ScrollView } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Mail, ArrowLeft, Send } from 'lucide-react-native';

export default function ForgotPasswordScreen({ navigation }) {
    const [email, setEmail] = useState('');
    const [submitted, setSubmitted] = useState(false);

    const handleSubmit = () => {
        // Mock API call
        setSubmitted(true);
    };

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">
            {/* Background Gradients */}
            <View className="absolute top-0 right-0 w-[500] h-[500] bg-brand-500/10 rounded-full blur-[100px]" />
            <View className="absolute bottom-0 left-0 w-[500] h-[500] bg-accent-500/10 rounded-full blur-[100px]" />

            <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} className="flex-1">
                <ScrollView contentContainerStyle={{ flexGrow: 1 }} className="px-8">

                    {/* Header */}
                    <TouchableOpacity
                        className="w-10 h-10 bg-white/5 rounded-full items-center justify-center mt-4 border border-white/10"
                        onPress={() => navigation.goBack()}
                    >
                        <ArrowLeft color="white" size={20} />
                    </TouchableOpacity>

                    <View className="flex-1 justify-center pb-20">
                        <View className="w-16 h-16 bg-brand-500/10 rounded-2xl items-center justify-center mb-6 border border-brand-500/20">
                            <Mail color="#f59e0b" size={32} />
                        </View>

                        <Text className="text-3xl font-bold text-white mb-3 font-sans">Forgot Password?</Text>
                        <Text className="text-gray-400 text-lg leading-relaxed font-sans mb-8">
                            Don't worry! It happens. Please enter the email associated with your account.
                        </Text>

                        {/* Form */}
                        {!submitted ? (
                            <View className="space-y-6">
                                <View className="space-y-2">
                                    <Text className="text-gray-400 font-sans ml-1 text-sm">Email Address</Text>
                                    <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4 focus:border-brand-500 transition-all">
                                        <Mail color="#9ca3af" size={22} />
                                        <TextInput
                                            placeholder="hello@example.com"
                                            placeholderTextColor="#6b7280"
                                            className="flex-1 text-white font-sans text-lg"
                                            value={email}
                                            onChangeText={setEmail}
                                            autoCapitalize="none"
                                            keyboardType="email-address"
                                        />
                                    </View>
                                </View>

                                <TouchableOpacity
                                    className="bg-brand-500 rounded-2xl py-5 flex-row items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95"
                                    onPress={handleSubmit}
                                >
                                    <Text className="text-white font-bold text-lg font-sans mr-2">Send Reset Code</Text>
                                    <Send color="white" size={20} strokeWidth={2.5} />
                                </TouchableOpacity>
                            </View>
                        ) : (
                            <View className="bg-emerald-500/10 border border-emerald-500/20 p-6 rounded-2xl items-center">
                                <View className="w-12 h-12 bg-emerald-500/20 rounded-full items-center justify-center mb-4">
                                    <Send color="#10b981" size={24} />
                                </View>
                                <Text className="text-white font-bold text-lg font-sans mb-2 text-center">Check your email</Text>
                                <Text className="text-gray-400 text-center font-sans">
                                    We have sent a password recover instructions to your email.
                                </Text>
                            </View>
                        )}
                    </View>
                </ScrollView>
            </KeyboardAvoidingView>
        </SafeAreaView>
    );
}
