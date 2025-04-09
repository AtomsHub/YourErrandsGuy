import { TouchableOpacity, View, Text } from 'react-native'
import React from 'react'


const AccountList = ({title, icon: IconName, name, size, color, handlePress}) => {
  return (
    <TouchableOpacity className="flex-row items-center py-2" activeOpacity={0.5} onPress={handlePress}>
        <View className='w-8 h-8 bg-white items-center justify-center rounded-full'>
            <IconName name={name} size={size} color={color}/>
        </View>
        <Text className="ml-4 text-base font-pRegular">{title}</Text>
  </TouchableOpacity>
  )
}

export default AccountList