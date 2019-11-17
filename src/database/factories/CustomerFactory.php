<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Customer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
	return [
		'territory_id' => $faker->randomDigit,
		'first_name' => $faker->firstName,
		'middle_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'street_address_1' => $faker->streetAddress,
		'city' => $faker->city,
		'subdivision' => $faker->city,
		'postal_code' => $faker->postcode,
		'country' => $faker->country,
		'phone_number' => (string) $faker->randomNumber(9) . (string) $faker->randomNumber(1),
		'email' => $faker->email,
		'status' => 'CURRENT'
	];
});
