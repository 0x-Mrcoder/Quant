import React, { useState } from 'react';
import { View, Text, TouchableOpacity, TextInput, ScrollView, Alert } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ArrowLeft, User, Mail, Smartphone, Save, Camera } from 'lucide-react-native';

export default function ProfileScreen({ navigation }) {
    const [name, setName] = useState('Mr. Coder');
    const [email, setEmail] = useState('mrcoder@example.com');
    const [phone, setPhone] = useState('+1 (555) 000-0000');

    const handleSave = () => {
        // Here you would typically make an API call
        Alert.alert('Success', 'Profile updated successfully!');
        navigation.goBack();
    };

    return (
        <SafeAreaView className="flex-1 bg-[#050505] font-sans">
            {/* Header */}
            <View className="px-6 py-4 flex-row items-center justify-between border-b border-white/5">
                <TouchableOpacity
                    className="w-10 h-10 bg-white/5 rounded-full items-center justify-center border border-white/10"
                    onPress={() => navigation.goBack()}
                >
                    <ArrowLeft color="white" size={20} />
                </TouchableOpacity>
                <Text className="text-white font-bold text-lg">Edit Profile</Text>
                <View className="w-10" />
            </View>

            <ScrollView className="flex-1 px-6 pt-8">

                {/* Avatar Section */}
                <View className="items-center mb-10">
                    <View className="relative">
                        <View className="w-28 h-28 bg-brand-500/10 rounded-full items-center justify-center border-2 border-brand-500 overflow-hidden">
                            <User color="#f59e0b" size={48} />
                        </View>
                        <TouchableOpacity className="absolute bottom-0 right-0 w-8 h-8 bg-brand-500 rounded-full items-center justify-center border-2 border-black">
                            <Camera color="white" size={14} />
                        </TouchableOpacity>
                    </View>
                    <Text className="text-gray-500 text-xs mt-4">Tap to change profile picture</Text>
                </View>

                {/* Form Fields */}
                <View className="gap-6">
                    <View>
                        <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Full Name</Text>
                        <View className="bg-[#1a1a1a] border border-white/10 rounded-xl px-4 py-3 flex-row items-center gap-3 focus:border-brand-500">
                            <User color="#6b7280" size={18} />
                            <TextInput
                                value={name}
                                onChangeText={setName}
                                className="flex-1 text-white font-bold text-base h-full"
                                placeholderTextColor="#4b5563"
                            />
                        </View>
                    </View>

                    <View>
                        <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Email Address</Text>
                        <View className="bg-[#1a1a1a] border border-white/10 rounded-xl px-4 py-3 flex-row items-center gap-3 opacity-50">
                            <Mail color="#6b7280" size={18} />
                            <TextInput
                                value={email}
                                editable={false}
                                className="flex-1 text-gray-400 font-bold text-base h-full"
                            />
                        </View>
                        <Text className="text-gray-600 text-[10px] mt-1 ml-1">Email cannot be changed directly.</Text>
                    </View>

                    <View>
                        <Text className="text-gray-400 text-xs font-bold uppercase tracking-widest mb-2">Phone Number</Text>
                        <View className="bg-[#1a1a1a] border border-white/10 rounded-xl px-4 py-3 flex-row items-center gap-3">
                            <Smartphone color="#6b7280" size={18} />
                            <TextInput
                                value={phone}
                                onChangeText={setPhone}
                                className="flex-1 text-white font-bold text-base h-full"
                                keyboardType="phone-pad"
                            />
                        </View>
                    </View>
                </View>

            </ScrollView>

            {/* Save Button */}
            <View className="p-6 bg-[#050505] border-t border-white/5">
                <TouchableOpacity
                    className="w-full bg-brand-500 py-4 rounded-xl flex-row items-center justify-center gap-2 shadow-lg active:scale-95"
                    onPress={handleSave}
                >
                    <Save color="white" size={20} />
                    <Text className="text-white font-bold text-lg font-sans">Save Changes</Text>
                </TouchableOpacity>
            </View>
        </SafeAreaView>
    );
}
