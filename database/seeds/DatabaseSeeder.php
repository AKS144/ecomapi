<?php

use Illuminate\Database\Seeder;
//use App\Model\Review;
//use App\Model\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        factory(App\User::class,5)->create();//create 5 user default User model
        factory(App\Model\Product::class,50)->create();     
        factory(App\Model\Review::class,300)->create();
         
    }
}
