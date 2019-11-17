<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Territory;
use Faker\Generator as Faker;

$factory->define(Territory::class, function (Faker $faker) {
	return [
		'name' => $faker->city
	];
});
