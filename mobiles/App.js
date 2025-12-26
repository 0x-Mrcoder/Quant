import React, { useState } from 'react';
import { NavigationContainer } from '@react-navigation/native';
import { createNativeStackNavigator } from '@react-navigation/native-stack';
import { StatusBar } from 'expo-status-bar';
import { View, Image, ActivityIndicator } from 'react-native';
import { SafeAreaProvider } from 'react-native-safe-area-context';
import {
  useFonts,
  Nunito_400Regular,
  Nunito_600SemiBold,
  Nunito_700Bold
} from '@expo-google-fonts/nunito';
import {
  Quicksand_400Regular,
  Quicksand_700Bold
} from '@expo-google-fonts/quicksand';
import { styled } from 'nativewind';

import OnboardingScreen from './screens/OnboardingScreen';
import LoginScreen from './screens/LoginScreen';
import RegisterScreen from './screens/RegisterScreen';
import ForgotPasswordScreen from './screens/ForgotPasswordScreen';
import AiConfigurationScreen from './screens/AiConfigurationScreen';
import ConnectBrokerScreen from './screens/ConnectBrokerScreen';
import BottomTabNavigator from './navigation/BottomTabNavigator';

import ReferenceScreen from './screens/SettingsScreen'; // Ensuring import availability but usually dynamic
import ProfileScreen from './screens/ProfileScreen';
import SubscriptionScreen from './screens/SubscriptionScreen';

const Stack = createNativeStackNavigator();

// Splash Screen Component
const SplashScreen = () => {
  return (
    <View className="flex-1 bg-dark-bg items-center justify-center">
      <View className="w-32 h-32 bg-brand-500/10 rounded-full items-center justify-center mb-6 animate-pulse">
        <Image source={require('./assets/logo.png')} className="w-20 h-20" resizeMode="contain" />
      </View>
      <ActivityIndicator size="large" color="#f59e0b" />
      <StatusBar style="light" />
    </View>
  );
};

export default function App() {
  const [fontsLoaded] = useFonts({
    Nunito_400Regular,
    Nunito_600SemiBold,
    Nunito_700Bold,
    Quicksand_400Regular,
    Quicksand_700Bold,
  });

  const [isFirstLaunch, setIsFirstLaunch] = useState(true); // Ideally check Storage

  if (!fontsLoaded) {
    return <SplashScreen />;
  }

  return (
    <SafeAreaProvider>
      <NavigationContainer>
        <Stack.Navigator screenOptions={{ headerShown: false, animation: 'fade' }}>
          {isFirstLaunch ? (
            <Stack.Group>
              <Stack.Screen name="Onboarding" component={OnboardingScreen} />
              <Stack.Screen name="Login" component={LoginScreen} />
              <Stack.Screen name="Register" component={RegisterScreen} />
              <Stack.Screen name="ConnectBroker" component={ConnectBrokerScreen} />
              <Stack.Screen name="AiConfiguration" component={AiConfigurationScreen} />
            </Stack.Group>
          ) : (
            <Stack.Group>
              <Stack.Screen name="Login" component={LoginScreen} />
              <Stack.Screen name="Register" component={RegisterScreen} />
              <Stack.Screen name="ForgotPassword" component={ForgotPasswordScreen} />
              <Stack.Screen name="ConnectBroker" component={ConnectBrokerScreen} />
              <Stack.Screen name="AiConfiguration" component={AiConfigurationScreen} />
            </Stack.Group>
          )}
          <Stack.Screen name="Main" component={BottomTabNavigator} />
          {/* Settings Sub-screens */}
          <Stack.Group screenOptions={{ presentation: 'card', animation: 'slide_from_right' }}>
            <Stack.Screen name="Profile" component={ProfileScreen} />
            <Stack.Screen name="Subscription" component={SubscriptionScreen} />
          </Stack.Group>
        </Stack.Navigator>
        <StatusBar style="light" backgroundColor="#050505" />
      </NavigationContainer>
    </SafeAreaProvider>
  );
}

