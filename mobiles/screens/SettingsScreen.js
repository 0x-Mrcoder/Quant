import React from 'react';
import { View, Text, ScrollView, TouchableOpacity, Image, Switch, Dimensions } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { User, ChevronRight, Settings, Shield, Bell, HelpCircle, LogOut, CreditCard, Crown, Star } from 'lucide-react-native';

const { width } = Dimensions.get('window');

const MENU_ITEMS = [
    { title: 'Profile Information', icon: User, link: 'Profile', desc: 'Edit name, email, avatar' },
    { title: 'Security & Password', icon: Shield, link: 'Profile', desc: '2FA, Change Password' },
    { title: 'Notifications', icon: Bell, link: 'Notifications', type: 'toggle', value: true, desc: 'Push alerts, Email' },
    { title: 'Support Center', icon: HelpCircle, link: 'Support', desc: 'FAQ, Contact Us' },
];

export default function SettingsScreen({ navigation }) {
    return (
        <SafeAreaView className="flex-1 bg-[#050505] font-sans">
            {/* Atmosphere */}
            <View className="absolute top-0 right-0 w-[300] h-[300] bg-brand-500/10 rounded-full blur-[80px]" />

            <ScrollView className="flex-1" contentContainerStyle={{ paddingBottom: 120 }}>

                {/* 1. Header with Edit Button */}
                <View className="px-6 pt-6 pb-8 flex-row items-center gap-4">
                    <View className="relative">
                        <View className="w-20 h-20 bg-[#1a1a1a] rounded-full items-center justify-center border-2 border-white/10 overflow-hidden">
                            {/* Placeholder Avatar */}
                            <View className="w-full h-full bg-brand-500/20 items-center justify-center">
                                <Text className="text-brand-500 text-2xl font-bold">MC</Text>
                            </View>
                        </View>
                        <View className="absolute bottom-0 right-0 w-6 h-6 bg-brand-500 rounded-full border-2 border-black items-center justify-center">
                            <Star color="white" size={10} fill="white" />
                        </View>
                    </View>
                    <View className="flex-1">
                        <Text className="text-white font-bold text-xl mb-0.5">Mr. Coder</Text>
                        <Text className="text-gray-500 text-sm mb-2">mrcoder@example.com</Text>
                        <TouchableOpacity
                            onPress={() => navigation.navigate('Profile')}
                            className="bg-white/5 self-start px-3 py-1 rounded-full border border-white/10 active:bg-white/10"
                        >
                            <Text className="text-white text-xs font-bold">Edit Profile</Text>
                        </TouchableOpacity>
                    </View>
                </View>

                {/* 2. Subscription Banner (Actionable) */}
                <TouchableOpacity
                    onPress={() => navigation.navigate('Subscription')}
                    className="mx-6 p-[1px] rounded-3xl bg-gradient-to-r from-brand-500 via-purple-500 to-brand-500 mb-8 active:opacity-90"
                >
                    <View className="bg-[#111] rounded-3xl p-5 flex-row items-center justify-between">
                        <View className="flex-row items-center gap-4">
                            <View className="w-12 h-12 bg-gradient-to-br from-brand-500 to-purple-600 rounded-2xl items-center justify-center shadow-lg shadow-brand-500/20">
                                <Crown color="white" size={24} fill="white" />
                            </View>
                            <View>
                                <Text className="text-white font-bold text-lg">Pro Plan Active</Text>
                                <Text className="text-gray-400 text-xs w-32">Next billing date: Jan 24</Text>
                            </View>
                        </View>
                        <View className="bg-white/5 px-3 py-1.5 rounded-full border border-white/10 flex-row items-center gap-1">
                            <Text className="text-white text-xs font-bold">Manage</Text>
                            <ChevronRight color="white" size={12} />
                        </View>
                    </View>
                </TouchableOpacity>

                {/* 3. Settings List */}
                <View className="px-6 mb-8">
                    <Text className="text-gray-500 font-bold text-xs font-sans mb-4 uppercase tracking-widest pl-2">General Settings</Text>
                    <View className="bg-[#1a1a1a] border border-white/5 rounded-3xl overflow-hidden">
                        {MENU_ITEMS.map((item, index) => (
                            <TouchableOpacity
                                key={index}
                                activeOpacity={0.7}
                                onPress={() => item.link && navigation.navigate(item.link)}
                                className={`flex-row items-center justify-between p-4 ${index !== MENU_ITEMS.length - 1 ? 'border-b border-white/5' : ''}`}
                            >
                                <View className="flex-row items-center gap-4">
                                    <View className="w-10 h-10 bg-white/5 rounded-full items-center justify-center">
                                        <item.icon color="#9ca3af" size={20} />
                                    </View>
                                    <View>
                                        <Text className="text-white font-bold font-sans text-sm">{item.title}</Text>
                                        <Text className="text-gray-600 text-[10px]">{item.desc}</Text>
                                    </View>
                                </View>

                                {item.type === 'toggle' ? (
                                    <Switch
                                        trackColor={{ false: '#374151', true: '#f59e0b' }}
                                        thumbColor={'#fff'}
                                        value={item.value}
                                        style={{ transform: [{ scaleX: 0.8 }, { scaleY: 0.8 }] }}
                                    />
                                ) : (
                                    <ChevronRight color="#4b5563" size={18} />
                                )}
                            </TouchableOpacity>
                        ))}
                    </View>
                </View>

                {/* 4. Action Buttons */}
                <View className="px-6 gap-3">
                    <TouchableOpacity className="bg-white/5 border border-white/10 rounded-2xl p-4 flex-row items-center justify-center gap-2 active:bg-white/10">
                        <CreditCard color="white" size={18} />
                        <Text className="text-white font-bold font-sans">Payment Methods</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        className="bg-rose-500/10 border border-rose-500/20 rounded-2xl p-4 flex-row items-center justify-center gap-2 active:bg-rose-500/20"
                        onPress={() => navigation.replace('Login')}
                    >
                        <LogOut color="#f43f5e" size={18} />
                        <Text className="text-rose-500 font-bold font-sans">Log Out</Text>
                    </TouchableOpacity>
                </View>

                {/* Version */}
                <View className="items-center mt-8">
                    <Text className="text-gray-700 font-sans text-[10px]">PipFlow v2.1.0 • Build 2045</Text>
                </View>

            </ScrollView>
        </SafeAreaView>
    );
}
