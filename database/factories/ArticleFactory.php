<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Article::class, function (Faker $faker) {
    return [
        'cid'=>mt_rand(2,5),
        'title'=>$faker->sentence(),
        'desc'=>$faker->sentence(),
        'pic'=>'/uploads/articles/amygxMcQO7C86e6gH3WjSMzdapiKdmv5fyWxJ9u4.jpeg',
        'body'=>$faker->text(),
    ];
});
