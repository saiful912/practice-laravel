<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
//    public function run()
//    {
//        User::create([
//            'full_name'=>'Abul',
//            'email'=>'abul@gmail.com',
//            'phone_number'=>'01234567',
//            'photo'=>'photo_5ce627ca8b14d4.858114972zJAL1mAdw.jpg',
//            'password'=>bcrypt('123456')
//        ]);
//    }
    //Factories
    public function run()
    {
        factory(User::class,50)->create();
    }
}
