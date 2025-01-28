import { View, ActivityIndicator } from 'react-native'
import React from 'react'

const Loading = () => {
  return (
    <View className="absolute top-0 left-0 right-0 bottom-0 bg-black/50 justify-center items-center">
        <ActivityIndicator size="large" color="#ffffff" />
    </View>
  )
}

export default Loading