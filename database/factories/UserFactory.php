<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

//use App\User;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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

//用户名假数据
$usernames = ['test.user1', 'test.user2', 'test.user3', 'test.user4', 'test.user5'];

//job title假数据
$jobTitles = ['Copy Writer', 'Graphic Designer', 'HR Specialist', 'Java Developer', 'Quality Engineer'];

//部门ID假数据
$departmentIds = [7070, 12, 15, 15082];

$factory->define(User::class, function (Faker $faker) use($usernames, $jobTitles, $departmentIds) {

    //$date_time = $faker->date . ' ' . $faker->time;

    $updated_at = $faker->dateTimeThisMonth();

    return [
        //'name' => $faker->name,
        'name' => $faker->unique()->randomElement($usernames),
        'email' => $faker->unique()->safeEmail,
        //'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'job_title' => $faker->randomElement($jobTitles),
        'departmentId' => $faker->randomElement($departmentIds),
        'description' => $faker->sentence(),
        'remember_token' => Str::random(10),
        'created_at' => $faker->dateTimeThisMonth($updated_at),
        'updated_at' => $updated_at,
    ];
});
