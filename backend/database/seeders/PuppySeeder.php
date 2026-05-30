<?php

namespace Database\Seeders;

use App\Models\Litter;
use App\Models\Puppy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class PuppySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {
        $litters = Litter::all();

        foreach ($litters as $litter) {

            $randomPuppiesCount = rand(3, 6);
            for ($i = 0; $i < $randomPuppiesCount; $i++) {
                $newPuppy = new Puppy();
                $newPuppy->litter_id = $litter->id;
                $newPuppy->name = $faker->firstName();
                $newPuppy->gender = $faker->randomElement(['Maschio', 'Femmina']);
                $newPuppy->color = $faker->randomElement(['BlackTricolor', 'BlueMerle', 'RedMerle', 'RedTricolor']);
                $newPuppy->status = $faker->randomElement(['Disponibile', 'Prenotato', 'Venduto']);

                $newPuppy->save();
            }
        }
    }
}
