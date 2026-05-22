<?php

namespace Database\Seeders;

use App\Models\Litter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class LitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        for ($i = 0; $i < 3; $i++) {
            $newLitter = new Litter();
            $newLitter->title = $faker->unique()->randomElement(['Alpha', 'Beta', 'Gamma', 'Zelda', 'Olimpo', 'Reale', 'Draghi']);
            $newLitter->birth_date = $faker->date('Y-m-d', '-1 month');
            $newLitter->mother_name = $faker->firstName('female');
            $newLitter->father_name = $faker->firstName('male');
            $newLitter->description = $faker->paragraphs(2, true);
            $newLitter->status = $faker->randomElement(['In programma', 'Nata', 'Svezzata']);
            $newLitter->puppies_count = rand(3, 5);

            $newLitter->save();
        }
    }
}
