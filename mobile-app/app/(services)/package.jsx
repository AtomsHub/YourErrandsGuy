import { View, Text, ScrollView, TouchableOpacity, Alert } from 'react-native'
import React, { useEffect, useState } from 'react'
import { AntDesign, Entypo, Ionicons, MaterialCommunityIcons } from '@expo/vector-icons';
import { router } from "expo-router";

import { useGlobalCart } from "../../context/GlobalCartContext";
import FormField from '../../components/FormField'
import CustomButton from '../../components/CustomButton';

const Package = () => {
    const { addToGlobalCart } = useGlobalCart();

    const [formData, setFormData] = useState({
        pickupLocation: '',
        dropoffLocation: '',
        senderPhone: '',
        senderName: '',
        senderEmail: '',
        receiverName: '',
        receiverPhone: '',
        receiverEmail: '',
    });

    const [selectedItems, setSelectedItems] = useState([]);
    const [useInsurance, setUseInsurance] = useState(false);
    const [errors, setErrors] = useState({});
    const [itemAmount, setItemAmount] = useState(0);
    const [isFormComplete, setIsFormComplete] = useState(false); 
    const deliveryFee = 500;
    const totalAmount = itemAmount + deliveryFee;


    const itemAmountFn = () => {
        if (!useInsurance) {
            setItemAmount(800)
        } else setItemAmount(0)
        setUseInsurance(!useInsurance)
    }
    
    const validatePhoneNumber = (number) => {
        const isValid = /^\d{11}$/.test(number) && number.startsWith('0');
        return isValid ? '' : 'Invalid Nigerian phone number';
    };

    const validateEmail = (email) => {
        const isValid = /^[\w-.]+@[\w-]+\.[a-z]{2,7}$/i.test(email);
        return isValid ? '' : 'Invalid email address';
    };

    const handleChangeText = (field, value) => {
        setFormData((prev) => ({
            ...prev,
            [field]: value,
        }));

        if (field === 'receiverPhone') {
            setErrors((prev) => ({
                ...prev,
                receiverPhone: validatePhoneNumber(value),
            }));
        }

        if (field === 'receiverEmail') {
            setErrors((prev) => ({
                ...prev,
                receiverEmail: validateEmail(value),
            }));
        }

        if (field === 'senderPhone') {
            setErrors((prev) => ({
                ...prev,
                senderPhone: validatePhoneNumber(value),
            }));
        }

        if (field === 'senderEmail') {
            setErrors((prev) => ({
                ...prev,
                senderEmail: validateEmail(value),
            }));
        }
    };

    useEffect(() => {
        const hasErrors = Object.values(errors).some((error) => error);
        const isFormFilled = Object.values(formData).every((value) => value.trim() !== '');
        setIsFormComplete(isFormFilled && !hasErrors && selectedItems.length > 0);
    }, [formData, errors, selectedItems]);


    const selectPackage = (item) => {
        if (selectedItems.includes(item)) {
        setSelectedItems(selectedItems.filter((selected) => selected !== item));
        } else {
        setSelectedItems([...selectedItems, item]);
        }
    };

    const proceedToGlobalCart = () => {
        const globalCartItem = {
            services: 'Package',
            formDetails: formData,
            items: selectedItems,
            deliveryFee,
            itemAmount,
            totalAmount,
        };
        addToGlobalCart(globalCartItem);
        Alert.alert('Success', 'Order added to cart', [{ text: 'Ok', onPress: () => router.replace('cart'), style: "success" }]);
    };


  return (
    <ScrollView className='bg-white flex-1'>
      <View className='px-6 mb-10'>

        <Text className='font-Raleway-Bold text-2xl mt-8 mb-4'>Delivery Details</Text>
        <View className='flex-row gap-x-3'>
            <View className='items-center mt-2'>
                <View className='rounded-xl p-1 bg-primary'></View>
                <View className='my-2 bg-primary h-[85] w-[2]'></View>
                <View className='rounded-xl p-1 bg-primary'></View>
            </View>
            <View className='flex-1'>
                <FormField 
                    title="Pickup"
                    placeholder="Pickup Address"
                    handleChangeText={(value) => handleChangeText('pickupLocation', value)}
                    value={formData.pickupLocation}
                />

                <FormField 
                    title="Dropoff"
                    placeholder="Dropoff Location"
                    otherStyles="mt-7"
                    handleChangeText={(value) => handleChangeText('dropoffLocation', value)}
                    value={formData.dropoffLocation}
                />

                <View className='bg-secondary-100 mt-4 p-4 rounded-lg flex-row justify-between items-center'>
                    <Text className='font-SpaceGrotesk-Medium text-md flex-1'>Delivery Fee</Text>
                    <Text className='font-SpaceGrotesk-Medium text-md'>₦ {deliveryFee}</Text>
                </View>
            </View>
        </View>

        <Text className='font-Raleway-Bold text-2xl mt-10 mb-4'>Sender Information</Text>
        <View className=''>
            <FormField 
                title="Name"
                placeholder="Adebola Ibrahim Nneka"
                handleChangeText={(value) => handleChangeText('senderName', value)}
                value={formData.senderName}
            />
            <FormField 
                title="Phone Number"
                placeholder="08000000000"
                otherStyles='mt-5'
                keyboardType="phone-pad"
                handleChangeText={(value) => handleChangeText('senderPhone', value)}
                value={formData.senderPhone}
                error={errors.senderPhone}
            />
            <FormField 
                title="Email"
                placeholder="email@example.com"
                otherStyles='mt-4'
                keyboardType="email-address"
                handleChangeText={(value) => handleChangeText('senderEmail', value)}
                value={formData.senderEmail}
                error={errors.senderEmail}
            />
        
        </View>

        <Text className='font-Raleway-Bold text-2xl mt-10 mb-4'>Receiver Information</Text>
        <View className=''>
            <FormField 
                title="Name"
                placeholder="Adebola Ibrahim Nneka"
                handleChangeText={(value) => handleChangeText('receiverName', value)}
                value={formData.receiverName}
            />
            <FormField 
                title="Phone Number"
                placeholder="08000000000"
                otherStyles='mt-5'
                keyboardType="phone-pad"
                handleChangeText={(value) => handleChangeText('receiverPhone', value)}
                value={formData.receiverPhone}
                error={errors.receiverPhone}
            />
            <FormField 
                title="Email"
                placeholder="email@example.com"
                otherStyles='mt-4'
                keyboardType="email-address"
                handleChangeText={(value) => handleChangeText('receiverEmail', value)}
                value={formData.receiverEmail}
                error={errors.receiverEmail}
            />
        
        </View>

        <Text className='font-Raleway-Bold text-2xl mt-10 mb-4'>What's in the package?</Text>
        <View className='flex-row gap-x-4 bg-primary-300 p-4 rounded-lg items-center'>
            <View className='bg-primary items-center justify-center rounded-full p-2'>
            <MaterialCommunityIcons name="sign-caution" size={24} color="white" />
            </View>
            <View className='flex-1'>
                <Text className='font-SpaceGrotesk-Medium text-lg'>Note</Text>
                <Text className='font-SpaceGrotesk-Medium text-sm'>The package size limits and weight must not exceed 65 x 55 x 40 cm and 20kg respectively</Text>
            </View>
        </View>
        <View className='flex flex-wrap w-full flex-row mt-4 gap-3'>
            {['Food', 'Clothes', 'Books', 'Medicine', 'Phone', 'Document', 'Other', 'Prefer not to say'].map((item, index) => (
                <TouchableOpacity key={index} onPress={() => selectPackage(item)} className={`rounded-xl ${selectedItems.includes(item) ? 'bg-primary-100' : 'bg-gray-borderDisabled'}`}>
                  <Text className="font-SpaceGrotesk-Medium text-md p-3 px-5 w-[100%]">{item}</Text>
                </TouchableOpacity>
              ))}
        </View>

        <Text className='font-Raleway-Bold text-2xl mt-10 mb-4'>Package Protection</Text>
        <TouchableOpacity onPress={itemAmountFn} className='flex-row gap-x-4 border border-gray-borderDefault p-4 rounded-lg items-center'>
            <Ionicons name="shield-checkmark" size={24} color="#00a859" />
            <View className='flex-1'>
                <Text className='font-SpaceGrotesk-Medium text-lg'>Apply package protection</Text>
                <Text className='font-SpaceGrotesk-Medium text-sm'>Use our insurance to safeguard your packages against any incidents. We've got you covered!</Text>
            </View>
            {useInsurance ? <AntDesign name="checkcircleo" size={20} color="#fdcd11" /> : <Entypo name="circle" size={20} color="#fdcd11" />}
            
        </TouchableOpacity>

        {useInsurance && (
            <View className='bg-secondary-100 mt-4 p-4 rounded-lg flex-row justify-between items-center'>
                <Text className='font-SpaceGrotesk-Medium text-md flex-1'>Insurance Fee</Text>
                <Text className='font-SpaceGrotesk-Medium text-md'>₦ {itemAmount}</Text>
            </View>
        )}

        <CustomButton 
            title={`Add to Cart ₦${totalAmount}`}
            containerStyles="bg-primary mt-5 "
            textStyles="text-white"
            handlePress={proceedToGlobalCart}
            disabled={!isFormComplete}
        />



      </View>
    </ScrollView>
  )
}

export default Package