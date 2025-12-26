import React, { useState, useRef, useEffect } from 'react';
import { View, Text, TextInput, TouchableOpacity, Image, KeyboardAvoidingView, Platform, ScrollView, Animated, Modal } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { Mail, Lock, User, ArrowLeft, ArrowRight, Check, ShieldCheck } from 'lucide-react-native';

export default function RegisterScreen({ navigation }) {
    const [step, setStep] = useState(1); // 1: Email, 2: OTP, 3: Details
    const [email, setEmail] = useState('');
    const [otp, setOtp] = useState(['', '', '', '', '', '']);
    const [name, setName] = useState('');
    const [password, setPassword] = useState('');
    const [showSuccess, setShowSuccess] = useState(false);

    // Animation
    const fadeAnim = useRef(new Animated.Value(1)).current;
    const otpRefs = useRef([]);

    const animateStep = (nextStep) => {
        Animated.sequence([
            Animated.timing(fadeAnim, { toValue: 0, duration: 200, useNativeDriver: true }),
            Animated.timing(fadeAnim, { toValue: 1, duration: 200, useNativeDriver: true })
        ]).start();
        setTimeout(() => setStep(nextStep), 200);
    };

    const handleSendCode = () => {
        if (!email) return;
        // Mock send code logic
        animateStep(2);
    };

    const handleVerifyOtp = () => {
        // Mock verify logic
        if (otp.join('').length === 6) {
            animateStep(3);
        }
    };

    const handleCompleteSignup = () => {
        if (!name || !password) return;
        // Mock API call
        setShowSuccess(true);
    };

    const handleOtpChange = (text, index) => {
        const newOtp = [...otp];
        newOtp[index] = text;
        setOtp(newOtp);

        // Auto-focus next input
        if (text && index < 5) {
            otpRefs.current[index + 1]?.focus();
        }
    };

    return (
        <SafeAreaView className="flex-1 bg-dark-bg font-sans">
            {/* Background Glows */}
            <View className="absolute top-[-20%] right-[-20%] w-[600] h-[600] bg-brand-500/10 rounded-full blur-[100px]" />

            <KeyboardAvoidingView behavior={Platform.OS === 'ios' ? 'padding' : 'height'} className="flex-1">
                <ScrollView contentContainerStyle={{ flexGrow: 1 }} className="px-8">
                    {/* Header */}
                    <View className="flex-row items-center mt-4 mb-2">
                        {step > 1 && (
                            <TouchableOpacity
                                className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10 mr-4"
                                onPress={() => animateStep(step - 1)}
                            >
                                <ArrowLeft color="white" size={20} />
                            </TouchableOpacity>
                        )}
                        <Text className="text-gray-400 font-bold font-sans">Step {step} of 3</Text>
                    </View>

                    <View className="flex-1 justify-center py-10">

                        <Animated.View style={{ opacity: fadeAnim }} className="w-full">
                            {step === 1 && (
                                /* STEP 1: EMAIL */
                                <View>
                                    <Text className="text-3xl font-bold text-white mb-2 font-sans">Let's start</Text>
                                    <Text className="text-gray-400 text-base leading-relaxed font-sans mb-10">
                                        Enter your email to receive a verification code.
                                    </Text>

                                    <View className="space-y-6">
                                        <View className="space-y-2">
                                            <Text className="text-gray-400 font-sans ml-1 text-sm">Email Address</Text>
                                            <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4">
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
                                            onPress={handleSendCode}
                                        >
                                            <Text className="text-white font-bold text-lg font-sans mr-2">Send Code</Text>
                                            <ArrowRight color="white" size={20} strokeWidth={2.5} />
                                        </TouchableOpacity>
                                    </View>
                                </View>
                            )}

                            {step === 2 && (
                                /* STEP 2: OTP */
                                <View>
                                    <Text className="text-3xl font-bold text-white mb-2 font-sans">Verification</Text>
                                    <Text className="text-gray-400 text-base leading-relaxed font-sans mb-10">
                                        Enter the 6-digit code sent to <Text className="text-brand-400 font-bold">{email}</Text>
                                    </Text>

                                    <View className="flex-row justify-between mb-10">
                                        {otp.map((digit, index) => (
                                            <TextInput
                                                key={index}
                                                ref={ref => otpRefs.current[index] = ref}
                                                className={`w-12 h-14 rounded-xl border-2 text-center text-white text-xl font-bold font-sans ${digit ? 'border-brand-500 bg-brand-500/10' : 'border-white/10 bg-white/5'}`}
                                                value={digit}
                                                onChangeText={(text) => handleOtpChange(text, index)}
                                                keyboardType="number-pad"
                                                maxLength={1}
                                                autoFocus={index === 0}
                                            />
                                        ))}
                                    </View>

                                    <TouchableOpacity
                                        className="bg-brand-500 rounded-2xl py-5 flex-row items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95"
                                        onPress={handleVerifyOtp}
                                    >
                                        <Text className="text-white font-bold text-lg font-sans mr-2">Verify & Continue</Text>
                                        <ShieldCheck color="white" size={20} strokeWidth={2.5} />
                                    </TouchableOpacity>
                                </View>
                            )}

                            {step === 3 && (
                                /* STEP 3: DETAILS */
                                <View>
                                    <Text className="text-3xl font-bold text-white mb-2 font-sans">Final Step</Text>
                                    <Text className="text-gray-400 text-base leading-relaxed font-sans mb-10">
                                        Set up your profile details.
                                    </Text>

                                    <View className="space-y-5">
                                        <View className="space-y-2">
                                            <Text className="text-gray-400 font-sans ml-1 text-sm">Full Name</Text>
                                            <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4">
                                                <User color="#f59e0b" size={22} />
                                                <TextInput
                                                    placeholder="John Doe"
                                                    placeholderTextColor="#6b7280"
                                                    className="flex-1 text-white font-sans text-lg"
                                                    value={name}
                                                    onChangeText={setName}
                                                    autoCapitalize="words"
                                                />
                                            </View>
                                        </View>

                                        <View className="space-y-2">
                                            <Text className="text-gray-400 font-sans ml-1 text-sm">Password</Text>
                                            <View className="bg-white/5 border border-white/10 rounded-2xl px-5 py-4 flex-row items-center gap-4">
                                                <Lock color="#f59e0b" size={22} />
                                                <TextInput
                                                    placeholder="••••••••"
                                                    placeholderTextColor="#6b7280"
                                                    className="flex-1 text-white font-sans text-lg"
                                                    value={password}
                                                    onChangeText={setPassword}
                                                    secureTextEntry
                                                />
                                            </View>
                                        </View>

                                        <TouchableOpacity
                                            className="bg-brand-500 rounded-2xl py-5 flex-row items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95 mt-6"
                                            onPress={handleCompleteSignup}
                                        >
                                            <Text className="text-white font-bold text-lg font-sans mr-2">Complete Signup</Text>
                                            <ArrowRight color="white" size={20} strokeWidth={2.5} />
                                        </TouchableOpacity>
                                    </View>
                                </View>
                            )}
                        </Animated.View>

                        {/* Footer Link */}
                        {step === 1 && (
                            <View className="flex-row justify-center mt-10">
                                <Text className="text-gray-400 font-sans">Already have an account? </Text>
                                <TouchableOpacity onPress={() => navigation.navigate('Login')}>
                                    <Text className="text-brand-500 font-bold font-sans">Sign In</Text>
                                </TouchableOpacity>
                            </View>
                        )}
                    </View>
                </ScrollView>
            </KeyboardAvoidingView>

            {/* Success Modal */}
            <Modal
                transparent={true}
                visible={showSuccess}
                animationType="fade"
            >
                <View className="flex-1 bg-black/80 items-center justify-center px-6">
                    <View className="w-full bg-[#111] border border-white/10 rounded-3xl p-8 items-center relative overflow-hidden">
                        <View className="absolute top-0 right-0 w-64 h-64 bg-emerald-500/10 rounded-full blur-[60px]" />

                        <View className="w-20 h-20 bg-emerald-500/10 rounded-full items-center justify-center mb-6 border border-emerald-500/20">
                            <Check color="#34d399" size={40} strokeWidth={3} />
                        </View>

                        <Text className="text-3xl font-bold text-white mb-2 font-sans text-center">Account Created!</Text>
                        <Text className="text-gray-400 text-center text-base mb-8 font-sans">
                            Welcome aboard, {name}. Your account is ready to use.
                        </Text>

                        <TouchableOpacity
                            className="w-full bg-white rounded-xl py-4 items-center shadow-lg active:scale-95"
                            onPress={() => {
                                setShowSuccess(false);
                                navigation.replace('Main');
                            }}
                        >
                            <Text className="text-black font-bold text-lg font-sans">Go to Dashboard</Text>
                        </TouchableOpacity>
                    </View>
                </View>
            </Modal>
        </SafeAreaView>
    );
}
