import React from 'react';
import { View, Text, Image, TouchableOpacity, Dimensions } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { LinearGradient } from 'nativewind'; // Note: NativeWind doesn't export LinearGradient directly usually, better using View with bg-gradient or just simple View for now. 
// We will use standard View styling.

const { width } = Dimensions.get('window');

export default function OnboardingScreen({ navigation }) {
    return (
        <SafeAreaView className="flex-1 bg-dark-bg relative">
            <View className="absolute inset-0 bg-brand-900/10" />

            {/* Abstract Background Glows */}
            <View className="absolute top-[-100] left-[-50] w-96 h-96 bg-brand-500/20 rounded-full blur-3xl opacity-50" />
            <View className="absolute bottom-[-100] right-[-50] w-96 h-96 bg-accent-500/20 rounded-full blur-3xl opacity-50" />

            <View className="flex-1 items-center justify-center px-8">
                <View className="w-64 h-64 bg-white/5 border border-white/10 rounded-3xl items-center justify-center mb-12 shadow-2xl">
                    <Image source={require('../assets/logo.png')} className="w-32 h-32" resizeMode="contain" />
                </View>

                <Text className="text-4xl font-bold text-white text-center mb-4">
                    Master the Markets with <Text className="text-brand-500">AI</Text>
                </Text>

                <Text className="text-gray-400 text-center text-lg mb-12 leading-relaxed">
                    Real-time signals, automated strategies, and simplified execution. All in your pocket.
                </Text>

                <TouchableOpacity
                    className="w-full bg-brand-600 py-4 rounded-xl items-center shadow-lg shadow-brand-500/30 active:scale-95 transition-transform"
                    onPress={() => navigation.replace('Login')}
                >
                    <Text className="text-white font-bold text-lg">Get Started</Text>
                </TouchableOpacity>
            </View>
        </SafeAreaView>
    );
}
