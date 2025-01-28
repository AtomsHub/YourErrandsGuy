import React, { useState, useEffect } from 'react';
import { View, Text, ScrollView, TouchableOpacity, Alert } from 'react-native';
import { router } from 'expo-router';

import FormField from '../../components/FormField';
import { Ionicons } from '@expo/vector-icons';
import CustomButton from '../../components/CustomButton';
import { useGlobalCart } from '../../context/GlobalCartContext';

const Errand = () => {
  const { addToGlobalCart } = useGlobalCart();

  // State for form data
  const [formData, setFormData] = useState({
    errandLocation: '',
    dropoffLocation: '',
    receiverName: '',
    receiverPhone: '',
    receiverEmail: '',
  });

  // State for adding individual items
  const [itemData, setItemData] = useState({
    description: '',
    rate: '',
    quantity: 1,
  });

  const [errors, setErrors] = useState({});
  const [items, setItems] = useState([]);
  const [isFormComplete, setIsFormComplete] = useState(false); 
  const deliveryFee = 500;

  const validatePhoneNumber = (number) => {
    const isValid = /^\d{11}$/.test(number) && number.startsWith('0');
    return isValid ? '' : 'Invalid Nigerian phone number';
  };

  const validateEmail = (email) => {
    const isValid = /^[\w-.]+@[\w-]+\.[a-z]{2,7}$/i.test(email);
    return isValid ? '' : 'Invalid email address';
  };

  const handleChangeText = (field, value, isItemField = false) => {
    if (isItemField) {
      setItemData((prev) => ({
        ...prev,
        [field]: value,
      }));
      if (field === 'rate') {
        setErrors((prev) => ({
          ...prev,
          rate: isNaN(value) ? 'Amount must be a number' : '',
        }));
      }
    } else {
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
    }
  };

  useEffect(() => {
    const hasErrors = Object.values(errors).some((error) => error);
    const isFormFilled = Object.values(formData).every((value) => value.trim() !== '');
    setIsFormComplete(isFormFilled && !hasErrors && items.length > 0);
  }, [formData, errors, items]);

  const handleAddItem = () => {
    if (itemData.description && itemData.rate && !isNaN(itemData.rate)) {
      const newItem = {
        description: itemData.description,
        rate: itemData.rate,
        quantity: itemData.quantity,
      };
      setItems((prev) => [...prev, newItem]);
      setItemData({ description: '', rate: '', quantity: 1 }); // Reset itemData after adding
    }
  };

  const handleDeleteItem = (index) => {
    setItems((prev) => prev.filter((_, i) => i !== index));
  };

  const handleIncrease = () => setItemData((prev) => ({ ...prev, quantity: prev.quantity + 1 }));

  const handleDecrease = () => {
    setItemData((prev) => {
      if (prev.quantity > 1) return { ...prev, quantity: prev.quantity - 1 };
      return prev;
    });
  };

  const itemAmount = items.reduce((acc, item) => acc + parseInt(item.rate) * item.quantity, 0);
  const totalAmount = itemAmount + deliveryFee;

  const proceedToGlobalCart = () => {
    const globalCartItem = {
      services: 'Errand',
      formDetails: formData,
      items: items,
      deliveryFee,
      itemAmount,
      totalAmount,
    };
    addToGlobalCart(globalCartItem);
    Alert.alert('Success', 'Order added to cart', [{ text: 'Ok', onPress: () => router.replace('cart') }]);
  };

  return (
    <ScrollView className="bg-white flex-1">
      <View className="px-6 mb-10">
        <Text className="font-Raleway-Bold text-2xl mt-8 mb-4">Delivery Details</Text>
        <View className="flex-row gap-x-3">
          <View className="items-center mt-2">
            <View className="rounded-xl p-1 bg-primary"></View>
            <View className="my-2 bg-primary h-[85] w-[2]"></View>
            <View className="rounded-xl p-1 bg-primary"></View>
          </View>
          <View className="flex-1">
            <FormField
              title="Errand"
              placeholder="Errand Location"
              handleChangeText={(value) => handleChangeText('errandLocation', value)}
              value={formData.errandLocation}
            />

            <FormField
              title="Dropoff"
              placeholder="Dropoff Location"
              otherStyles="mt-7"
              handleChangeText={(value) => handleChangeText('dropoffLocation', value)}
              value={formData.dropoffLocation}
            />

            <View className="bg-secondary-100 mt-4 p-4 rounded-lg flex-row justify-between items-center">
              <Text className="font-SpaceGrotesk-Medium text-md flex-1">Delivery Fee</Text>
              <Text className="font-SpaceGrotesk-Medium text-md">₦ {deliveryFee}</Text>
            </View>
          </View>
        </View>

        <Text className="font-Raleway-Bold text-2xl mt-10 mb-4">What do you want to send us?</Text>
        <View className="w-full flex-row flex-wrap gap-3 items-end justify-between">
          <FormField
            title="Description"
            placeholder="Narrate your errand"
            handleChangeText={(value) => handleChangeText('description', value, true)}
            value={itemData.description}
          />
          <FormField
            title="Rate"
            placeholder="Amount in Naira"
            otherStyles="w-[50%]"
            keyboardType="number-pad"
            handleChangeText={(value) => handleChangeText('rate', value, true)}
            value={itemData.rate}
            error={errors.rate}
          />

          <View className="flex-1">
            <Text className="text-xl font-SpaceGrotesk-Semibold mb-1 text-gray-textSubtitle">Quantity</Text>
            <View className="flex-row items-center justify-between border border-gray-300 rounded-md h-[52]">
              <TouchableOpacity onPress={handleDecrease} className="px-3 py-2">
                <Text className="text-lg font-bold">-</Text>
              </TouchableOpacity>
              <Text className="px-4 py-2 text-lg font-SpaceGrotesk-Semibold">{itemData.quantity}</Text>
              <TouchableOpacity onPress={handleIncrease} className="px-3 py-2">
                <Text className="text-lg font-bold">+</Text>
              </TouchableOpacity>
            </View>
          </View>

          <CustomButton
            title="Add"
            containerStyles="bg-primary px-5 h-[54] rounded-full"
            textStyles="text-white"
            handlePress={handleAddItem}
            disabled={!itemData.description || !itemData.rate || !!errors.rate}
          />
        </View>

        {items.length > 0 && (
          <View className="border border-gray-borderDefault p-4 rounded-lg items-center mt-6">
            {items.map((item, index) => (
              <View
                key={index}
                className="flex-row gap-x-4 border-b mb-4 pb-4 border-gray-borderDefault"
              >
                <Text className="font-Raleway-Medium text-md flex-1">
                  {item.description} (x{item.quantity})
                </Text>
                <Text className="font-SpaceGrotesk-Semibold text-primary-400 text-md">
                  ₦{item.rate}
                </Text>
                <TouchableOpacity onPress={() => handleDeleteItem(index)}>
                  <Ionicons name="trash" size={20} color="red" />
                </TouchableOpacity>
              </View>
            ))}

            <View className="bg-secondary mt-4 p-4 rounded-lg flex-row justify-between items-center">
              <Text className="font-SpaceGrotesk-Medium text-lg flex-1">Errand Amount</Text>
              <Text className="font-SpaceGrotesk-Medium text-lg">₦{itemAmount}</Text>
            </View>
          </View>
        )}

        <Text className="font-Raleway-Bold text-2xl mt-10 mb-4">Receiver Information</Text>
        <View className="">
          <FormField
            title="Name"
            placeholder="Adebola Ibrahim Nneka"
            handleChangeText={(value) => handleChangeText('receiverName', value)}
            value={formData.receiverName}
          />
          <FormField
            title="Phone Number"
            placeholder="08000000000"
            otherStyles="mt-5"
            keyboardType="phone-pad"
            handleChangeText={(value) => handleChangeText('receiverPhone', value)}
            value={formData.receiverPhone}
            error={errors.receiverPhone}
          />
          <FormField
            title="Email"
            placeholder="email@example.com"
            otherStyles="mt-4"
            keyboardType="email-address"
            handleChangeText={(value) => handleChangeText('receiverEmail', value)}
            value={formData.receiverEmail}
            error={errors.receiverEmail}
          />
        </View>

        <CustomButton
          title={`Add to Cart ₦${totalAmount}`}
          containerStyles="bg-primary mt-8 "
          textStyles="text-white"
          handlePress={proceedToGlobalCart}
          disabled={!isFormComplete}
        />
      </View>
    </ScrollView>
  );
};

export default Errand;
