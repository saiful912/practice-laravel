<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\User::class, function (Faker $faker) {
    return [
        'email' => $faker->unique()->safeEmail,
        'full_name' => $faker->unique()->fullName,
        'phone_number' => $faker->unique()->phoneNumber,
        'password' => bcrypt('123456'),
        'photo' => $faker->imageUrl(),
        'remember_token' => str_random(10),
        'email_verified' => 1,
        'email_verified_at' => \Carbon\Carbon::now(),
        'email_verification_token' => '',
    ];
});