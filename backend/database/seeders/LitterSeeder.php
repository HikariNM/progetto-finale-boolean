<?php

namespace Database\Seeders;

use App\Models\Adult;
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
            $fattriceId = Adult::where('gender', 'Femmina')->inRandomOrder()->first()?->id;
            $stalloneId = Adult::where('gender', 'Maschio')->inRandomOrder()->first()?->id;

            $newLitter = new Litter();
            $newLitter->title = $faker->unique()->randomElement(['Alpha', 'Beta', 'Gamma', 'Zelda', 'Olimpo', 'Reale', 'Draghi']);
            $newLitter->birth_date = $faker->date('Y-m-d', '-1 month');
            $newLitter->mother_id = $fattriceId;
            $newLitter->father_id = $stalloneId;
            $newLitter->description = $faker->paragraphs(2, true);
            $newLitter->status = $faker->randomElement(['In programma', 'Nata', 'Svezzata']);

            $newLitter->save();
        }
    }
}
