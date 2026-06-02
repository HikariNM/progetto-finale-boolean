<?php

namespace Database\Seeders;

use App\Models\Adult;
use App\Models\Title;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Generator as Faker;

class AdultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(Faker $faker): void
    {

        $fakeTitles = [
            'Campione Italiano di Bellezza',
            'Top Dog ENCI 2024',
            'Campione Internazionale',
            'San Marino Junior Champion'
        ];

        for ($i = 0; $i < 4; $i++) {

            $gender = $faker->randomElement(['Maschio', 'Femmina']);
            $tableStatus = $faker->randomElement(['Attivo', 'Ritirato']);

            $newAdult = new Adult();
            $newAdult->gender = $gender;
            $newAdult->name = ($gender === 'Maschio') ? $faker->firstName('male') : $faker->firstName('female');
            $newAdult->breed = 'Australian Shepherd';
            $newAdult->birth_date = $faker->date('Y-m-d', '-2 years');
            $newAdult->microchip = $faker->unique()->numerify('###############');
            $newAdult->pedigree_code = 'LOI' . $faker->unique()->numerify('######');
            $newAdult->coat_color = $faker->randomElement(['Black Tricolor', 'Red Tricolor', 'Blue Merle', 'Red Merle']);
            $newAdult->tail_type = $faker->randomElement(['NBT', 'Coda lunga']);
            $newAdult->description = $faker->paragraphs(2, true);
            $newAdult->status = $tableStatus;
            $newAdult->is_neutered = ($tableStatus === 'Ritirato') ? $faker->boolean(80) : $faker->boolean(10);

            $newAdult->save();

            for ($j = 0; $j < 3; $j++) {
                $newTitle = new Title();
                $newTitle->adult_id = $newAdult->id;
                $newTitle->name = $faker->randomElement($fakeTitles);

                $newTitle->save();
            }
        }
    }
}
