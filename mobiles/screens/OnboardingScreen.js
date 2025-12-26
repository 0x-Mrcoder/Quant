import React, { useState, useRef } from 'react';
import { View, Text, Image, TouchableOpacity, Dimensions, FlatList, Animated } from 'react-native';
import { SafeAreaView } from 'react-native-safe-area-context';
import { ArrowRight, Check } from 'lucide-react-native';

const { width, height } = Dimensions.get('window');

const SLIDES = [
    {
        id: '1',
        title: ['Meet PipFlow', 'AI Trading'],
        description: 'Harness the power of institutional-grade algorithms. Our neural network scans markets 24/7 to find precision entries.',
        image: require('../assets/logo.png'),
    },
    {
        id: '2',
        title: ['Precision', 'Without Emotion'],
        description: 'Eliminate human error. PipFlow executes trades based on logic, data, and proven strategies—not fear or greed.',
        image: require('../assets/logo.png'),
    },
    {
        id: '3',
        title: ['Your Wealth', 'On Autopilot'],
        description: 'Experience true freedom. Connect your broker once, and watch as the AI manages your portfolio in real-time.',
        image: require('../assets/logo.png'),
    },
];

const Slide = ({ item }) => {
    return (
        <View style={{ width }} className="items-center justify-center px-8">
            <View className="w-72 h-72 bg-white/5 border border-white/10 rounded-full items-center justify-center mb-12 shadow-2xl relative overflow-hidden">
                <View className="absolute inset-0 bg-brand-500/10 blur-xl" />
                <Image source={item.image} className="w-32 h-32" resizeMode="contain" />
            </View>

            <Text className="text-4xl font-bold text-white text-center mb-4 font-sans text-center">
                {item.title[0]} <Text className="text-brand-500">{item.title[1]}</Text>
            </Text>

            <Text className="text-gray-400 text-center text-lg leading-relaxed font-sans px-4">
                {item.description}
            </Text>
        </View>
    );
};

export default function OnboardingScreen({ navigation }) {
    const [currentIndex, setCurrentIndex] = useState(0);
    const flatListRef = useRef(null);

    const handleNext = () => {
        if (currentIndex < SLIDES.length - 1) {
            flatListRef.current?.scrollToIndex({ index: currentIndex + 1 });
        } else {
            navigation.replace('Login');
        }
    };

    const handleSkip = () => {
        navigation.replace('Login');
    };

    const updateIndex = (e) => {
        const contentOffsetX = e.nativeEvent.contentOffset.x;
        const currentIndex = Math.round(contentOffsetX / width);
        setCurrentIndex(currentIndex);
    };

    return (
        <SafeAreaView className="flex-1 bg-dark-bg relative font-sans">
            {/* Abstract Background Glows */}
            <View className="absolute top-[-100] left-[-50] w-[500] h-[500] bg-brand-500/10 rounded-full blur-[100px] opacity-30" />
            <View className="absolute bottom-[-100] right-[-50] w-[500] h-[500] bg-accent-500/10 rounded-full blur-[100px] opacity-30" />

            <FlatList
                ref={flatListRef}
                data={SLIDES}
                renderItem={({ item }) => <Slide item={item} />}
                horizontal
                pagingEnabled
                showsHorizontalScrollIndicator={false}
                onMomentumScrollEnd={updateIndex}
                className="flex-1"
            />

            {/* Footer Control */}
            <View className="h-40 px-8 justify-between pb-8">
                {/* Indicators */}
                <View className="flex-row justify-center gap-2 mb-6">
                    {SLIDES.map((_, index) => (
                        <View
                            key={index}
                            className={`h-2 rounded-full transition-all ${currentIndex === index ? 'w-8 bg-brand-500' : 'w-2 bg-white/20'}`}
                        />
                    ))}
                </View>

                {/* Buttons */}
                <View className="flex-row justify-between items-center">
                    <TouchableOpacity onPress={handleSkip}>
                        <Text className="text-gray-500 font-bold text-base font-sans p-4">Skip</Text>
                    </TouchableOpacity>

                    <TouchableOpacity
                        className="bg-brand-500 w-16 h-16 rounded-full items-center justify-center shadow-lg shadow-brand-500/30 active:scale-95"
                        onPress={handleNext}
                    >
                        {currentIndex === SLIDES.length - 1 ? (
                            <Check color="white" size={28} strokeWidth={3} />
                        ) : (
                            <ArrowRight color="white" size={28} strokeWidth={3} />
                        )}
                    </TouchableOpacity>
                </View>
            </View>
        </SafeAreaView>
    );
}
