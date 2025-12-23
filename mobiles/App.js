import React, { useEffect, useState } from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { StatusBar } from 'expo-status-bar';
import { View, Image, ActivityIndicator } from 'react-native';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import { styled } from 'nativewind';

import OnboardingScreen from './screens/OnboardingScreen';
import LoginScreen from './screens/LoginScreen';
import BottomTabNavigator from './navigation/BottomTabNavigator'; // We'll create this next

const Stack = createNativeStackNavigator();

// Splash Screen Component
const SplashScreen = ({ onFinish }) => {
  useEffect(() => {
    setTimeout(onFinish, 2500); // Simulate loading
  }, []);

  return (
    <View className="flex-1 bg-dark-bg items-center justify-center">
      <View className="w-32 h-32 bg-brand-500/10 rounded-full items-center justify-center mb-6 animate-pulse">
        <Image source={require('./assets/logo.png')} className="w-20 h-20" resizeMode="contain" />
      </View>
      <ActivityIndicator size="large" color="#8b5cf6" />
      <StatusBar style="light" />
    </View>
  );
};

export default function App() {
  const [isLoading, setIsLoading] = useState(true);
  const [isFirstLaunch, setIsFirstLaunch] = useState(true); // Ideally check Storage

  if (isLoading) {
    return <SplashScreen onFinish={() => setIsLoading(false)} />;
  }

  return (
    <SafeAreaProvider>
      <NavigationContainer>
        <Stack.Navigator screenOptions={{ headerShown: false, animation: 'fade' }}>
          {isFirstLaunch ? (
            <Stack.Group>
              <Stack.Screen name="Onboarding" component={OnboardingScreen} />
              <Stack.Screen name="Login" component={LoginScreen} />
            </Stack.Group>
          ) : (
            <Stack.Screen name="Login" component={LoginScreen} />
          )}
          <Stack.Screen name="Main" component={BottomTabNavigator} />
        </Stack.Navigator>
        <StatusBar style="light" backgroundColor="#050505" />
      </NavigationContainer>
    </SafeAreaProvider>
  );
}
