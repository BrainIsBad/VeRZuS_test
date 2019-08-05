<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Author;
use Faker\Generator as Faker;

$factory->define(Author::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->defineAs(App\Book::class, 'book', function (Faker $faker) {
    return [
        'name' => $faker->firstNameMale . ' ' . $faker->century,
    ];
});
$factory->defineAs(App\Comment::class, 'comment', function () {
    return [
        'mark' => rand(1, 10),
    ];
});
