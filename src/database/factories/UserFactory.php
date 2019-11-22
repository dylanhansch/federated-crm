<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
	return [
		'email' => $faker->unique()->safeEmail,
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'phone_number' => (string) $faker->randomNumber(9) . (string) $faker->randomNumber(4),
		'password' => Hash::make($faker->password)
	];
});
