<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Vialoja\Entities\Permission::class, function (Faker\Generator $faker) {
    return [
        'name' => str_slug(str_random(10), '_'),
        'description' => str_random(10)
    ];
});
