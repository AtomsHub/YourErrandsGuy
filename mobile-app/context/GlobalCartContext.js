import React, { createContext, useContext, useState, useEffect } from "react";
import AsyncStorage from "@react-native-async-storage/async-storage";
import { Alert } from "react-native"; // Correct source



// Create the context
const GlobalCartContext = createContext();

// Custom hook to use the context
export const useGlobalCart = () => useContext(GlobalCartContext);

// Provider component
export const GlobalCartProvider = ({ children }) => {
  const [globalCart, setGlobalCart] = useState([]);

  // Load globalCart from AsyncStorage when the app starts
  useEffect(() => {
    const loadCartFromStorage = async () => {
      try {
        const storedCart = await AsyncStorage.getItem("globalCart");
        if (storedCart) {
          setGlobalCart(JSON.parse(storedCart)); // Parse and set the stored cart
        }
      } catch (error) {
        console.error("Error loading globalCart from AsyncStorage:", error);
      }
    };

    loadCartFromStorage();
  }, []);

  // Function to add items to the globalCart and persist it
  const addToGlobalCart = async (item) => {
    const updatedCart = [...globalCart, item];
    setGlobalCart(updatedCart);

    // Save the updated cart to AsyncStorage
    try {
      await AsyncStorage.setItem("globalCart", JSON.stringify(updatedCart));
    } catch (error) {
      console.error("Error saving globalCart to AsyncStorage:", error);
    }
  };

  
  const removeFromGlobalCart = (indexToRemove) => {
    Alert.alert(
      "Confirm Removal",
      "Are you sure you want to remove this item from the cart?",
      [
        {
          text: "Cancel",
          onPress: () => console.log("Removal canceled"), 
          style: "cancel",
        },
        {
          text: "Delete",
          onPress: async () => {
            const updatedCart = globalCart.filter((_, index) => index !== indexToRemove);
            setGlobalCart(updatedCart);
  
            try {
              await AsyncStorage.setItem("globalCart", JSON.stringify(updatedCart));
            } catch (error) {
              console.error("Error updating globalCart in AsyncStorage:", error);
            }
          },
          style: "destructive", // Style the button as a "delete" action
        },
      ]
    );
  };

const clearGlobalCart = async () => {
    setGlobalCart([]);

    try {
      await AsyncStorage.removeItem("globalCart");
    } catch (error) {
      console.error("Error clearing globalCart in AsyncStorage:", error);
    }
  };

  

  return (
    <GlobalCartContext.Provider value={{ globalCart, addToGlobalCart, removeFromGlobalCart, clearGlobalCart }}>
      {children}
    </GlobalCartContext.Provider>
  );
};
