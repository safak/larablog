<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // reset the users table
        DB::table('users')->truncate();

        $faker = Factory::create();
        $date = Carbon::create(2017, 04, 10, 10);

        for ($i=0; $i<10; $i++){

            $text=$faker->name;
            $slug = str_slug($text,'-');
            DB::table('users')->insert([
                'name' => $text,
                'email' => str_random(10).'@gmail.com',
                'password' => bcrypt('secret'),
                'slug' => $slug,
                'bio' => $faker->text,
                'created_at' => $date->addDays(rand(1,19))
            ]);

        }
    }
}
