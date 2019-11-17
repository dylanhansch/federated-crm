<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Region;
use Faker\Generator as Faker;

$factory->define(Region::class, function (Faker $faker) {
	return [
		'name' => $faker->city
	];
});
