import React from 'react';
import { View, Text } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';

export default function SettingsScreen() {
    return (
        <SafeAreaView className="flex-1 bg-dark-bg items-center justify-center">
            <Text className="text-white font-bold text-lg">Settings</Text>
            <Text className="text-gray-500">Coming Soon</Text>
        </SafeAreaView>
    );
}
