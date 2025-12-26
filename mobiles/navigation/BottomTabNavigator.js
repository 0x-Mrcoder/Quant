import React, { useRef, useEffect } from 'react';
import { View, Text, TouchableOpacity, StyleSheet, Dimensions, Platform, Vibration, Animated } from 'react-native';
import { createBottomTabNavigator } from '@react-navigation/bottom-tabs';
import { House, BrainCircuit, ScrollText, UserCog } from 'lucide-react-native';

// Import Screens
import HomeScreen from '../screens/HomeScreen';
import TradeScreen from '../screens/TradeScreen';
import HistoryScreen from '../screens/HistoryScreen';
import SettingsScreen from '../screens/SettingsScreen';

const Tab = createBottomTabNavigator();
const { width } = Dimensions.get('window');

// --- Custom Tab Bar Component ---
function CustomTabBar({ state, descriptors, navigation }) {
    // Animation for the "active indicator" (optional, for now we stick to refined icon states)

    return (
        <View style={styles.container}>
            <View style={styles.glassBackground}>
                {state.routes.map((route, index) => {
                    const { options } = descriptors[route.key];
                    const isFocused = state.index === index;

                    const activeColor = '#f59e0b'; // Amber-500
                    const inactiveColor = '#6b7280'; // Gray-500

                    // Icon Mapping
                    let IconComponent = House;
                    if (route.name === 'Home') IconComponent = House;
                    else if (route.name === 'AITrading') IconComponent = BrainCircuit;
                    else if (route.name === 'History') IconComponent = ScrollText;
                    else if (route.name === 'Mine') IconComponent = UserCog;

                    // Label Mapping
                    let label = 'Home';
                    if (route.name === 'AITrading') label = 'AI Trading';
                    else if (route.name === 'History') label = 'History';
                    else if (route.name === 'Mine') label = 'Mine';

                    const onPress = () => {
                        const event = navigation.emit({
                            type: 'tabPress',
                            target: route.key,
                            canPreventDefault: true,
                        });

                        if (!isFocused && !event.defaultPrevented) {
                            // Haptic Feedback
                            Vibration.vibrate(10);

                            navigation.navigate(route.name);
                        }
                    };

                    return (
                        <TouchableOpacity
                            key={index}
                            accessibilityRole="button"
                            accessibilityState={isFocused ? { selected: true } : {}}
                            onPress={onPress}
                            style={styles.tabButton}
                            activeOpacity={0.7}
                        >
                            <View style={[
                                styles.iconContainer,
                                isFocused && styles.activeIconContainer
                            ]}>
                                <IconComponent
                                    color={isFocused ? activeColor : inactiveColor}
                                    size={24}
                                    strokeWidth={isFocused ? 2.5 : 2}
                                    fill={isFocused && route.name === 'AITrading' ? activeColor : 'none'}
                                />
                            </View>

                            {/* Animated Label */}
                            {isFocused && (
                                <Text style={[styles.label, { color: activeColor }]}>
                                    {label}
                                </Text>
                            )}
                        </TouchableOpacity>
                    );
                })}
            </View>
        </View>
    );
}

// --- Main Navigator ---
export default function BottomTabNavigator() {
    return (
        <Tab.Navigator
            tabBar={props => <CustomTabBar {...props} />}
            screenOptions={{
                headerShown: false,
            }}
        >
            <Tab.Screen name="Home" component={HomeScreen} />
            <Tab.Screen name="AITrading" component={TradeScreen} />
            <Tab.Screen name="History" component={HistoryScreen} />
            <Tab.Screen name="Mine" component={SettingsScreen} />
        </Tab.Navigator>
    );
}

// --- Styles for "Premium Island" ---
const styles = StyleSheet.create({
    container: {
        position: 'absolute',
        bottom: Platform.OS === 'ios' ? 25 : 20,
        left: 0,
        right: 0,
        alignItems: 'center',
        justifyContent: 'center',
        // Make it invisible container so the glass bar floats
        backgroundColor: 'transparent',
    },
    glassBackground: {
        flexDirection: 'row',
        width: width - 40, // 20 margin each side
        height: 70,
        backgroundColor: '#111111', // Deep dark
        borderRadius: 35,
        alignItems: 'center',
        justifyContent: 'space-around', // Distribute items evenly
        paddingHorizontal: 10,

        // Borders & Shadows
        borderWidth: 1,
        borderColor: 'rgba(255,255,255,0.1)',
        shadowColor: '#000',
        shadowOffset: { width: 0, height: 10 },
        shadowOpacity: 0.5,
        shadowRadius: 20,
        elevation: 10,
    },
    tabButton: {
        alignItems: 'center',
        justifyContent: 'center',
        height: '100%',
        flex: 1,
    },
    iconContainer: {
        padding: 8,
        borderRadius: 20,
        alignItems: 'center',
        justifyContent: 'center',
    },
    activeIconContainer: {
        backgroundColor: 'rgba(245, 158, 11, 0.15)', // Brand/20
    },
    label: {
        position: 'absolute',
        bottom: 8, // Push to bottom of container
        fontSize: 10,
        fontWeight: 'bold',
        fontFamily: Platform.OS === 'ios' ? 'Nunito-Bold' : 'sans-serif', // Fallback
    }
});
