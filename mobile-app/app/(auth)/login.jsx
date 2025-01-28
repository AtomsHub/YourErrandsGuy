import { View, Text, Image, ScrollView, } from 'react-native'
import React, { useState, useEffect } from 'react'
import { SafeAreaView } from 'react-native-safe-area-context'
import { StatusBar } from 'expo-status-bar'
import { Link, router } from 'expo-router';
import axios from 'axios'
import AsyncStorage from '@react-native-async-storage/async-storage'
import * as Burnt from 'burnt'
import { Toaster } from 'burnt/web';

import {images} from '../../constants'
import CustomButton from '../../components/CustomButton';
import FormField from '../../components/FormField';
import Loading from '../../components/Loading';
import PasswordField from '../../components/PasswordField';

const API_BASE_URL = process.env.EXPO_PUBLIC_API_BASE_URL

const Login = () => {
  const [form, setForm] = useState({email: '', password: '',});
  const [passwordError, setPasswordError] = useState('')
  const [isFormValid, setIsFormValid] = useState(false)
  const [emailError, setEmailError] = useState(''); 
  const [loading, setLoading] = useState(false)


  useEffect(() => {

    // Email validation
    const email = form.email
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    const hasUpperCase = /[A-Z]/.test(email)
    let emailErrorMsg = ''
    let isEmailValid = true

    if (email.length >= 1) {
      if (!emailRegex.test(email)) {
        emailErrorMsg = 'Invalid email format'
        isEmailValid = false
      } else if (hasUpperCase) {
        emailErrorMsg = 'Email should not contain uppercase letters'
        isEmailValid = false
      }
    }
    setEmailError(emailErrorMsg)

    // Password validation
    let passwordErrorMsg = ''
    let isPasswordValid = true
    if (form.password.length > 0 && form.password.length < 8) {
      passwordErrorMsg = 'Password must be at least 8 characters'
      isPasswordValid = false
    }
    setPasswordError(passwordErrorMsg)

    // Check all fields filled
    const areAllFieldsFilled = form.email.trim() !== '' && form.password.trim() !== '' 

    const isFormComplete = areAllFieldsFilled && isEmailValid && isPasswordValid 
    setIsFormValid(isFormComplete)
  }, [form])

  

  const handleSubmit = async () => {
    if (!isFormValid || loading) return;

    await AsyncStorage.setItem('emailAddress', form.email);

    setLoading(true);
    try {
      const response = await axios.post(
        `${API_BASE_URL}login`,
        {
          email: form.email,
          password: form.password,
        }
      );

      console.log("Here")
      
      console.log(response.data.status)
      if (response.data.status) { 
        // Save token to AsyncStorage
        await AsyncStorage.setItem('BearerToken', response.data.data.token);

        // Store user data
        await AsyncStorage.setItem('user', JSON.stringify(response.data.data.user));
  
        // Store popular items
        await AsyncStorage.setItem('popular', JSON.stringify(response.data.data.popular));
  
        // Store vendors
        await AsyncStorage.setItem('vendors', JSON.stringify(response.data.data.vendors));
      
        await Burnt.toast({
          title: response.data.message,
          preset: 'success',
          from: 'top',
        });
      
        // Redirect to home after successful login
        router.replace('/home');
      }
    } catch (error) {
      let message = 'Unable to connect to the server';

      if (error.response) {
        const { status, data } = error.response;
      
        // Handle email not verified case
        if (status === 403 && data.message === 'Email not verified. Please verify your email to continue.') {
          await Burnt.toast({
            title: data.message,
            preset: 'error',
            from: 'top',
          });
          router.push('./verify');
          return;
        }

        // Handle validation errors
        message = data.message || message;
        if (data.data) {
          const errorMessages = Object.values(data.data).flat().join(', ');
          message = `${message}: ${errorMessages}`;
        }
      } else if (error.request) {
        message = 'Please check your internet connection';
      }

      await Burnt.toast({
        title: message,
        preset: 'error',
        from: 'top',
      });
    } finally {
      setLoading(false);
    }
  };

  return (
    <SafeAreaView className='h-full w-full bg-white'>
      <ScrollView className='h-[80vh] w-full'>
        <View className='flex-1 px-6 pt-12'>
          <View className='mb-2'>
            <Image source={images.logo} resizeMode='contain' style={{ height: 64, width: 64,}}/>
          </View>
          <Text className='font-Raleway-Bold text-primary text-4xl'>Welcome Back!</Text>
          <Text className='font-SpaceGrotesk-Medium text-lg'>Sign In to your account</Text>

          <View className='mt-10'>
            <FormField 
              title="Email Address"
              placeholder="user@example.com"
              error={emailError}
              value={form.email}
              handleChangeText={(e) => setForm({ ...form, email: e })}
              otherStyles="mb-7"
              keyboardType="email-address"
            />

            <PasswordField 
              title="Password"
              placeholder="xxxxxxxx"
              value={form.password}
              handleChangeText={(e) => setForm({ ...form, password: e })}
              error={passwordError}
              otherStyles="mb-7"
            />

            <View className='flex-row justify-end mb-6 mt-3'>
                <Link href='./register' className='w-min-[30%] font-SpaceGrotesk-Regular text-[15px] text-secondary'> Forget Password</Link>
            </View>

          </View>
        </View>
        
      </ScrollView>

      <View className='px-6 mt-2'>
          <CustomButton
            title={loading ? "Logging in to your Account..." : "Log in"}
            containerStyles="bg-primary"
            textStyles="text-gray"
            handlePress={handleSubmit}
            disabled={!isFormValid || loading}
          />
          <View className="mt-4 mb-8">
            <Text className=' text-sm font-SpaceGrotesk-Regular text-center text-dark'>Don't have an account?
            <Link href='./register' className=' text-secondary'> Register</Link>
            </Text>
          </View>
      </View>

      {loading && <Loading /> }
      <Toaster />
      <StatusBar style='dark' />

    </SafeAreaView>
  )
}

export default Login