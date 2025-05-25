import { View, Text, Image, TouchableOpacity, ScrollView } from 'react-native'
import React, { useEffect, useState } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import { FontAwesome, FontAwesome6, Ionicons, MaterialIcons, SimpleLineIcons } from '@expo/vector-icons'
import Octicons from '@expo/vector-icons/Octicons';
import AsyncStorage from '@react-native-async-storage/async-storage';
import * as Burnt from 'burnt'; 

import AccountList from '../../components/AccountList';
import { router } from 'expo-router';
import { images } from '../../constants';


const getUserData = async () => {
  try {
    const userString = await AsyncStorage.getItem('user');
    const user = JSON.parse(userString);
    return user;
  } catch (error) {
    console.error('Error getting user data:', error);
    return null;
  }
};
const Account = () => {

  const [fullName, setFullName] = useState('');

  useEffect(() => {
    const loadUserData = async () => {
      const user = await getUserData();
      if (user) {
        setFullName(user.fullname);
      }
    };
    loadUserData();
  }, []);
  

  const handleLogout = async () => {
    try {
      await AsyncStorage.clear();
      await Burnt.toast({
        title: 'Logged out successfully.',
        preset: 'success',
        from: 'top',
      });
      router.replace('/login'); 
    } catch (error) {
      console.error('Error during logout:', error);
      await Burnt.toast({
        title: 'Failed to log out. Please try again.',
        preset: 'error',
        from: 'top',
      });
    }
  };
  return (
    <SafeAreaView className="flex-1 bg-white">
      
      <View className="px-5 mt-5 w-full">
        <Text className="text-2xl px-5 mt-3 text-gray-textTitle font-pRegular">Account</Text>
      </View>
      
      <ScrollView className='mt-6'>
      
      {/* Profile Section */}
      <View className="items-center mt-3">

        <Image
          source={images.profileImage}
          className="w-20 h-20 rounded-full bg-gray-900"
        />

        <View className='flex-row items-center justify-center mt-2 space-x-2'>
          <Text className="text-xl font-pRegular">{fullName || 'Guest User'}</Text>
          <View className="flex-row items-center mt-1">
            <FontAwesome name="star" size={10} color="gold" />
            <Text className="ml-1 text-[12px] font-pRegular">5.0</Text>
          </View>
        </View>

        <View className='flex-row items-center justify-center p-2 px-5 mt-2 border rounded-md border-gray-borderDisabled space-x-3'>
          <View className='h-[7] w-[7] bg-success rounded-full'></View>
          <Text className="text-gray-textTitle text-sm font-pRegular">Online</Text>

        </View>



      </View>

      <View className="my-6 px-4 space-y-4">
        
        {/* Info Section */}
        <View className="bg-gray-100 p-4 rounded-lg">

          <Text className=" text-gray-textTitle text-base font-pSemiBold mb-4">My Info</Text>
          
          <AccountList 
            title="Profile details"
            icon={Octicons} 
            name="person"
            size={14}
            color="#57554d"
            handlePress={() => router.push('/profileDetails')}
          />

          <AccountList
            icon={Ionicons} 
            title="Payment Details"
            name="wallet-outline"
            size={14}
            color="#57554d"
            handlePress={() => router.push('/payment')}
          />

          <AccountList 
            icon={FontAwesome6} 
            title="Inbox"
            name="envelope"
            size={14}
            color="#57554d"
          />
  
        </View>

        {/* Security */}
        <View className="bg-gray-100 p-4 rounded-lg">

          <Text className=" text-gray-textTitle text-base font-pSemiBold mb-4">Security</Text>
          
          <AccountList 
            icon={Ionicons} 
            title="Change Password"
            name="medkit-outline"
            size={14}
            color="#57554d"
            handlePress={() => router.push('/changePassword')}
          />

          <AccountList 
            icon={SimpleLineIcons} 
            title="Push Notification"
            name="bell"
            size={14}
            color="#57554d"
          />

          <AccountList
            icon={SimpleLineIcons} 
            title="Support"
            name="earphones-alt"
            size={14}
            color="#57554d"
            handlePress={() => router.push('/supportChat')}
          />
  
        </View>
        

        {/* Logout */}
        <View className="bg-gray-100 p-4 rounded-lg">

          <AccountList 
            icon={MaterialIcons} 
            title="Logout"
            name="logout"
            size={14}
            color="#57554d"
            handlePress={handleLogout}
          />
  
        </View>
        
      </View>
      </ScrollView>
    </SafeAreaView>
  )
}

export default Account