import React from 'react';
import { View } from 'react-native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { Home, TrendingUp, History, Settings } from 'lucide-react-native';

// Import Screens (We will create these next)
import HomeScreen from '../screens/HomeScreen';
import TradeScreen from '../screens/TradeScreen';
import HistoryScreen from '../screens/HistoryScreen';
import SettingsScreen from '../screens/SettingsScreen';

const Tab = createBottomTabNavigator();

export default function BottomTabNavigator() {
    return (
        <Tab.Navigator
            screenOptions={{
                headerShown: false,
                tabBarStyle: {
                    backgroundColor: '#0a0a0a',
                    borderTopColor: '#ffffff10',
                    height: 90, // Taller tab bar
                    paddingTop: 10,
                    paddingBottom: 30,
                },
                tabBarActiveTintColor: '#8b5cf6', // Violet
                tabBarInactiveTintColor: '#6b7280', // Gray
                tabBarLabelStyle: {
                    fontSize: 10,
                    fontWeight: '600',
                    marginTop: 5,
                }
            }}
        >
            <Tab.Screen
                name="Dashboard"
                component={HomeScreen}
                options={{
                    tabBarIcon: ({ color, size }) => <Home color={color} size={24} />,
                    tabBarLabel: 'Home'
                }}
            />
            <Tab.Screen
                name="Trade"
                component={TradeScreen} // Will be TradeScreen
                options={{
                    tabBarIcon: ({ color, focused }) => (
                        <View className={`p-3 rounded-full ${focused ? 'bg-brand-500/20' : 'bg-transparent'}`}>
                            <TrendingUp color={focused ? '#8b5cf6' : '#6b7280'} size={24} />
                        </View>
                    ),
                    tabBarLabel: 'Trade'
                }}
            />
            <Tab.Screen
                name="History"
                component={HistoryScreen} // Will be HistoryScreen
                options={{
                    tabBarIcon: ({ color }) => <History color={color} size={24} />,
                    tabBarLabel: 'History'
                }}
            />
            <Tab.Screen
                name="Settings"
                component={SettingsScreen} // Will be SettingsScreen
                options={{
                    tabBarIcon: ({ color }) => <Settings color={color} size={24} />,
                    tabBarLabel: 'Settings'
                }}
            />
        </Tab.Navigator>
    );
}
