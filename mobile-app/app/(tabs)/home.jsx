import { View, Text, ScrollView, Image, TextInput, TouchableOpacity, Alert } from 'react-native';
import React, { useEffect, useState } from 'react';
import { StatusBar } from 'expo-status-bar';
import { Ionicons } from '@expo/vector-icons';
import { Link, router } from 'expo-router';
import AsyncStorage from '@react-native-async-storage/async-storage';
import * as Burnt from 'burnt';
import '../../global.css'

import { images } from '../../constants';

const getUserDataAndPopular = async () => {
  try {
    // Fetch both user and popular data simultaneously
    const [userString, storedPopular] = await Promise.all([
      AsyncStorage.getItem('user'),
      AsyncStorage.getItem('popular'),
    ]);

    // Parse the fetched data
    const user = userString ? JSON.parse(userString) : null;
    const popular = storedPopular ? JSON.parse(storedPopular) : [];

    return { user, popular };
  } catch (error) {
    console.error('Error fetching data:', error);
    Alert.alert('Error', 'Failed to fetch data.');
    return { user: null, popular: [] };
  }
};

const Home = () => {
  const [fullName, setFullName] = useState('');
  const [popular, setPopular] = useState([]);

  console.log(popular)
  console.log(popular.image)

  useEffect(() => {
    const loadData = async () => {
      const { user, popular } = await getUserDataAndPopular();
      if (user) setFullName(user.fullname);
      if (popular.length) setPopular(popular);
    };

    loadData();
  }, []);


  return (
    <View className='h-full w-full bg-primary pt-10'>
        <ScrollView className='flex-1 w-full h-full bg-white'>

            <View className='px-6 bg-primary pb-6'>
                <View className='flex-row items-center mt-3 gap-x-2'>
                    <View className='overflow-hidden rounded-full'>
                        <Image source={images.profilePic} resizeMode='cover' className='h-[60] w-[60]' style={{ height: 60, width: 60,}}  />
                    </View>
                    <View className=''>
                        <Text className='text-2xl font-Raleway-Bold text-dark text-white'>{fullName}</Text>
                        <Text className='text-sm font-SpaceGrotesk-Medium text-dark text-gray-textNegative'>Agbowo, Ibadan</Text>
                    </View>
                </View>

                <View className='border mt-6 flex-1 h-[45] rounded-lg border-gray-textNegative flex-row items-center px-2'>
                    <Ionicons name="search-sharp" size={20} color="#fdfdfd" />
                    <TextInput 
                        className="flex-1 text-base font-SpaceGrotesk-Medium text-white pr-3"
                        placeholder="Search for a errand"
                        placeholderTextColor="#fdfdfd"
                        autoCapitalize="none"
                    />
                </View>
            </View>
            
            <View className='px-6 pb-6'>
                <View className='mt-5'>
                    <View className='flex-row items-center justify-between gap-x-5'>
                        <Text className='font-Raleway-Bold text-2xl'>Common Errand</Text>
                        <Text onPress={() => console.log('Pressed')} className='font-SpaceGrotesk-Medium text-base text-primary'>See all</Text>
                    </View>


                    {popular.map((restaurant) => (
                    <TouchableOpacity 
                        onPress={() => {
                            router.push({ 
                                  pathname: 'single', 
                                  params: { 
                                    vendorId: restaurant.id, 
                                    vendorName: restaurant.name, 
                                    vendorAddress: restaurant.address, 
                                    vendorImage: restaurant.image,
                                    foodItems: JSON.stringify(restaurant.items) } });
                              
                        }}
                        className='flex-row items-center justify-between gap-x-4 mt-3' 
                        key={restaurant.id}
                    >
                        <Image source={{ uri: `https://yourerrandsguy.com.ng/${restaurant.image}` }} className='w-[45vw] h-[45vw] rounded-xl'/>
                        <View className='flex-1'>
                            <Text className='font-Raleway-Bold text-3xl text-primary'>{restaurant.name}</Text>
                            <View className='flex-row mt-0 items-center gap-x-1'>
                                <Ionicons name="star-sharp" size={12} color="#fdcd11" />
                                <Text className='font-SpaceGrotesk-Regular text-xs'>4.7 Rating</Text>
                            </View>
                            <View className='flex-row items-center gap-x-1 mt-3'>
                                <Ionicons name="location-sharp" size={24} color="#00a859" />
                                <View className='flex-1'>
                                    <Text className='font-SpaceGrotesk-Bold text-lg'>Ibadan, Oyo State</Text>
                                    <Text className='font-SpaceGrotesk-Light text-xs'>{restaurant.address}</Text>
                                </View>
                            </View>

                        </View>
                    </TouchableOpacity>
                    ))}

                </View>

                <View className='mt-10'>
                    <Image source={images.advert} resizeMode='cover' className='w-[100%]' style={{ width: '100%',}}/>
                </View>

                <View className='mt-5'>
                    <Text className='font-Raleway-Bold text-2xl'>Our Services</Text>
                    
                    <View className='flex-row gap-x-3'>
                        <TouchableOpacity onPress={() => router.push('paystack')} className='py-3 items-center justify-center mt-3 border flex-1 rounded-md border-primary'>
                            <Image source={images.laundryIcon} className='w-[25] h-[25]' style={{ height: 25, width: 25,}}/>
                            <Text className='font-Raleway-Medium mt-1 text-sm'>Laundry</Text>
                        </TouchableOpacity>

                        <TouchableOpacity onPress={() => router.push('errand')} className='py-3 items-center justify-center mt-3 border flex-1 rounded-md border-primary'>
                            <Image source={images.errandIcon} className='w-[25] h-[25]' style={{ height: 25, width: 25,}}/>
                            <Text className='font-Raleway-Medium mt-1 text-sm'>Errand</Text>
                        </TouchableOpacity>

                        <TouchableOpacity onPress={() => router.push('restaurant')} className='py-3 items-center justify-center mt-3 border flex-1 rounded-md border-primary'>
                            <Image source={images.restaurantIcon} className='w-[25] h-[25]' style={{ height: 25, width: 25,}}/>
                            <Text className='font-Raleway-Medium mt-1 text-sm'>Restaurant</Text>
                        </TouchableOpacity>

                        <TouchableOpacity onPress={() => router.push('package')} className='py-3 items-center justify-center mt-3 border flex-1 rounded-md border-primary'>
                            <Image source={images.packageIcon} className='w-[25] h-[25]' style={{ height: 25, width: 25,}}/>
                            <Text className='font-Raleway-Medium mt-1 text-sm'>Package</Text>
                        </TouchableOpacity>

                    </View>
                </View>

                <View className='mt-5'>
                    <View className='flex-row items-center justify-between gap-x-5'>
                        <Text className='font-Raleway-Bold text-2xl'>History</Text>
                        <Text onPress={() => console.log('Pressed')} className='font-SpaceGrotesk-Medium text-base text-primary'>See all</Text>
                    </View>


                    <TouchableOpacity className='flex-row items-center justify-between p-4 mt-3 border rounded-md overflow-hidden border-gray-disabled'>
                        <Image source={images.onboarding2} className='w-[45] h-[45] rounded-xl' style={{ height: 45, width: 45,}}/>
                        <View className='flex-1'>
                            <View className='items-center gap-x-1 mt-3'>
                                <Text className='font-SpaceGrotesk-Bold text-xl'>Document Delivery</Text>
                                <View className='flex-row items-center gap-x-1 mt-1'>
                                    <Ionicons name="time" size={14} color="#00a859" />
                                    <Text className='font-SpaceGrotesk-Light text-sm'>22/10/2025</Text>
                                </View>
                            </View>
                        </View>
                        <View className='items-center'>
                            <Text className='font-Raleway-Bold text-xl'>N3400</Text>
                            <Text className='font-SpaceGrotesk-light text-xs text-secondary'>Completed</Text>
                        </View>
                    </TouchableOpacity>

                    <TouchableOpacity className='flex-row items-center justify-between p-4 mt-3 border rounded-md overflow-hidden border-gray-disabled'>
                        <Image source={images.onboarding2} className='w-[45] h-[45] rounded-xl' style={{ height: 45, width: 45,}}/>
                        <View className='flex-1'>
                            <View className='items-center gap-x-1 mt-3'>
                                <Text className='font-SpaceGrotesk-Bold text-xl'>Document Delivery</Text>
                                <View className='flex-row items-center gap-x-1 mt-1'>
                                    <Ionicons name="time" size={14} color="#00a859" />
                                    <Text className='font-SpaceGrotesk-Light text-sm'>22/10/2025</Text>
                                </View>
                            </View>
                        </View>
                        <View className='items-center'>
                            <Text className='font-Raleway-Bold text-xl'>N3400</Text>
                            <Text className='font-SpaceGrotesk-light text-xs text-secondary'>Completed</Text>
                        </View>
                    </TouchableOpacity>
                </View>

                
            </View>
            


        </ScrollView>
        <StatusBar style='dark' />
    
    </View>
  )
}

export default Home