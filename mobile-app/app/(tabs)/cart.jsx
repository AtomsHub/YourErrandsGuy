import React, { useRef, useState, useEffect } from "react";
import { View, Text, ScrollView } from "react-native";
import { SafeAreaView } from "react-native-safe-area-context";
import { Paystack } from 'react-native-paystack-webview';
import AsyncStorage from '@react-native-async-storage/async-storage';
import axios from 'axios';
import * as Burnt from 'burnt';

import { useGlobalCart } from '../../context/GlobalCartContext';
import CustomButton from "../../components/CustomButton";
import ErrandCartCard from '../../components/ErrandCartCard';
import PackageCartCard from "../../components/PackageCartCard";
import RestaurantCartCard from "../../components/RestaurantCartCard";
import Loading from '../../components/Loading';

const PAYSTACK_SECRET_KEY = process.env.EXPO_PUBLIC_PAYSTACK_SECRET_KEY
const API_BASE_URL = process.env.EXPO_PUBLIC_API_BASE_URL
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
const Cart = () => {
	const { globalCart, removeFromGlobalCart, clearGlobalCart } = useGlobalCart();
	const paystackWebViewRef = useRef(null);
	const [loading, setLoading] = useState(false);

	const [fullName, setFullName] = useState('');
	const [email, setEmail] = useState('');
	const [phone, setPhone] = useState('');

	  useEffect(() => {
		const loadUserData = async () => {
		  const user = await getUserData();
		  if (user) {
			setFullName(user.fullname);
			setEmail(user.email);
			setPhone(user.phone);
		  }
		};
		loadUserData();
	  }, []);

	const calculateTotalAmount = () => {
		return globalCart.reduce((acc, item) => acc + (item.totalAmount || 0), 0);
	};

	const totalAmount = calculateTotalAmount();
	  
	const handlePaymentSuccess = async () => {
	try {
		setLoading(true);
		const checkoutData = {
			cartItems: globalCart,
			totalAmount
		};
		
		const token = await AsyncStorage.getItem('BearerToken');
		// Send order to backend
		const response = await axios.post(
		`${API_BASE_URL}orders/save`,
		checkoutData,
		{
			headers: {
			  Authorization: `Bearer ${token}`,
			},
		}
		);
		console.log('API Response:', response.status);
		console.log('API DATA:', response.data);
	
		if (response.status === 200) {
		Burnt.toast({
			title: 'Order placed successfully!',
			preset: 'done',
			from: 'top',
		});
		// router.replace('/orders');
		}
	} catch (error) {
		Burnt.toast({
			title: 'Order saving failed. Please contact support.',
			preset: 'error',
			from: 'top',
		  });
	} finally {
		setLoading(false);
	}
	};

	if (globalCart.length === 0) {
		return (
		<View className="flex-1 justify-center items-center bg-white">
			<Text className="font-SpaceGrotesk-Bold text-lg">No items in cart</Text>
		</View>
		);
	}

  return (
	<SafeAreaView className="flex-1 h-full w-full justify-between bg-white">
	  <Paystack  
		paystackKey={PAYSTACK_SECRET_KEY}
		amount={totalAmount.toFixed(2)}
		currency="NGN"
		channels={['card', 'bank', 'ussd', 'qr', 'mobile_money']}
		billingName={fullName}
		billingMobile={phone}
		billingEmail={email}
		activityIndicatorColor="green"
		onCancel={() => {
		handlePaymentSuccess(),
		  Burnt.toast({
			title: 'Payment cancelled',
			preset: 'error',
			from: 'top',
		  });
		}}
		onSuccess={() => {
			handlePaymentSuccess();
			clearGlobalCart();
		}}

		ref={paystackWebViewRef}
	  />


	  <View className="flex-row justify-between items-center rounded-lg p-3 mt-4 px-6">
		<Text className="font-SpaceGrotesk-Bold text-2xl">Cart</Text>
	  </View>

	  <ScrollView className="p-4 px-6 pb-4">
		{globalCart.map((cartItem, index) => {
		  if (cartItem.services === "Restaurant") {
			return <RestaurantCartCard key={index} cartItem={cartItem} deleteFromCart={() => removeFromGlobalCart(index)}/>
			
		  } else if (cartItem.services === "Errand") {
			return <ErrandCartCard key={index} cartItem={cartItem} deleteFromCart={() => removeFromGlobalCart(index)}/>
			
		  } else if (cartItem.services === "Package") {
			return <PackageCartCard key={index} cartItem={cartItem} deleteFromCart={() => removeFromGlobalCart(index)} />

		  } else {
			return (
			  <View key={index} className="p-4">
				<Text className="font-SpaceGrotesk-Bold text-lg">Unknown service type: {cartItem.services}</Text>
			  </View>
			);
		  }
		})}

		<View className="p-4 px-6 pb-4"></View>
	  </ScrollView>

	<View className="px-6 pb-4 mt-3 bg-white">
	<CustomButton
		title={`Proceed to Checkout ₦${totalAmount}`}
		containerStyles="bg-primary"
		textStyles="text-white"
		handlePress={() => paystackWebViewRef.current?.startTransaction()}
		disabled={loading || globalCart.length === 0}
	/>
	</View>
	
	{loading && <Loading /> }
	</SafeAreaView>
  );
};

export default Cart;
