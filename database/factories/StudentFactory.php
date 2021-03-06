<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Student;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
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

$factory->define(Student::class, function (Faker $faker) {

    $gradebooks = App\Gradebook::all()->pluck('id')->toArray();
    return [
        'first_name' => $faker->name,
        'last_name' => $faker->name,
        'img' => $faker->imageUrl(800, 600, ''),
        'gradebook_id' => $faker->randomElement($gradebooks)
    ];
});
