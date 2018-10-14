<?php

use Illuminate\Database\Seeder;

class RecordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1,200) as $i) {
            DB::table('records')->insert([
                'calorie' => random_int(10,900),
                'user_id' => random_int(1,50)
            ]);
        }
    }
}
