<?php

use Faker\Generator as Faker;
use App\Model\Product;
use App\Model\Review;


$factory->define(App\Model\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'detail' => $faker->paragraph,
        'price' => $faker->numberBetween(100,1000),
        'stock' => $faker->randomDigit,
        'discount' => $faker->numberBetween(2,30),
        'user_id' => function(){ 
            return App\User::all()->random();//user_id we dont have it we created from auth so function
                                            //we would use default User factory created
                                            // so special data is required refer video 19 at 03:00 min
        },

    ];
});
