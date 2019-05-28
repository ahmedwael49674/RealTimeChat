<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
      'content' => $faker->paragraphs(rand(3, 10), true),
    ];
});
