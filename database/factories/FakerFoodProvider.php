<?php

namespace Database\Factories;

use Faker\Provider\Base;

class FakerFoodProvider extends Base
{
    protected static $foodNames = [
        'Pizza Margherita', 'Sushi Platter', 'Vegan Burger', 
        'Chicken Alfredo', 'Caesar Salad', 'BBQ Ribs',
        'Fish Tacos', 'Chocolate Cake', 'Ice Cream Sundae'
    ];

    public static function foodName()
    {
        return static::randomElement(static::$foodNames);
    }
}
