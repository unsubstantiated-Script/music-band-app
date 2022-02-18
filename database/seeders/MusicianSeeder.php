<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MusicianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Musician::query()->delete();

        $faker = \Faker\Factory::create();

        foreach (range(1, 100) as $number) {
            \App\Models\Musician::create([
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'instrument' => $faker->word,
                'website' => $faker->url,
            ]);
        }

    }
}
