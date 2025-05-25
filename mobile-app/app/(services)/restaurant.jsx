import React, { useEffect, useState } from 'react';
import { View, Text, ScrollView, Alert } from 'react-native';
import AsyncStorage from '@react-native-async-storage/async-storage';
import { router } from 'expo-router';
import RestaurantCard from '../../components/RestaurantCard';
import { images } from '../../constants';

const Restaurant = () => {
  const [vendors, setVendors] = useState([]);

  // Fetch vendors from AsyncStorage
  useEffect(() => {
    const fetchVendors = async () => {
      try {
        const storedVendors = await AsyncStorage.getItem('vendors');
        if (storedVendors) {
          const parsedVendors = JSON.parse(storedVendors);
          setVendors(parsedVendors); // Update state with vendors
        }
      } catch (error) {
        Alert.alert('Error', 'Failed to fetch vendors');
        console.error(error);
      }
    };

    fetchVendors();
  }, []);

  

  // Handle vendor card press
  const handlePress = (vendor) => {
    router.push({ 
      pathname: './single', 
      params: { 
        vendorId: vendor.id, 
        vendorName: vendor.name, 
        vendorAddress: vendor.address, 
        vendorImage: vendor.image,
        foodItems: JSON.stringify(vendor.items) } });
  };
  return (
    <ScrollView className="bg-white flex-1">
      <View className="mt-6 px-6">
        <Text className="font-SpaceGrotesk-Bold text-3xl mb-8">All Vendors</Text>

        {vendors.length > 0 ? (
          vendors.map((vendor) => (
            <RestaurantCard
              key={vendor.id}
              imageSource={{ uri: `https://yourerrandsguy.com.ng/${vendor.image}` } || images.onboarding2} // Use the image URL from the vendor
              restaurantName={vendor.name}
              deliveryPrice={1200} // Adjust if you want dynamic pricing  
              availability={true} // Replace with dynamic availability if needed
              rating={4.0} // Replace with dynamic rating if available
              reviews={83} // Replace with dynamic reviews if available
              onPress={() => handlePress(vendor)}
            />
          ))
        ) : (
          <Text>No vendors available</Text>
        )}
      </View>
    </ScrollView>
  );
};

export default Restaurant;
