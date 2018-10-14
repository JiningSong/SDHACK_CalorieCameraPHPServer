<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,50) as $i) {
            DB::table('users')->insert([
                'name' => $faker->name,
                'thumbnail' => $faker->url,
                'email' => $faker->email,
                'password' => $faker->password
            ]);
        }
    }
}
