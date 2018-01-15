<?php

use Illuminate\Database\Seeder;
use Faker\Factory;
use App\Staff;

class StaffTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // ура в ларе5.5 работает сидер по украинским(русским) ФИО.
        // не забывать $faker = Factory::create('uk_UA'); ('ru_RU');
        // фамилия ($faker->lastName) муж и жен рода одинаково, а
        // имя отч нет, поэтому делаем 1 муж 1 жен, иначе путаются...

        $faker = Factory::create('uk_UA');
        Staff::truncate();

        //должности с 1 по 26 - начальники, они в 1-ом числе
        foreach(range(1,26) as $i) {
            Staff::create([
                'position_id' => $i,
                'first_name' => (($i % 2) == 0) ? $faker->firstNameMale : $faker->firstNameFemale,
                'name' => (($i % 2) == 0) ? $faker->middleNameMale() : $faker->middleNameFemale(),
                'last_name' => $faker->lastName,
                'employed_at' => mt_rand(2012,2017).'-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'salary' => ($i==1) ? 5000 : $faker->numberBetween(15,25)*100
            ]);
        }

        // планктон :) , по многу в подчинении первых 26...
        foreach(range(1,500) as $i) {

            Staff::create([
                'position_id' => $faker->numberBetween(27,86),
                'first_name' => $faker->firstNameMale,
                'name' => $faker->middleNameMale(),
                'last_name' => $faker->lastName,
                'employed_at' => mt_rand(2012,2017).'-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'salary' => $faker->numberBetween(5,12)*100
            ]);

            Staff::create([
                'position_id' => $faker->numberBetween(27,86),
                'first_name' => $faker->firstNameFemale,
                'name' => $faker->middleNameFemale(),
                'last_name' => $faker->lastName,
                'employed_at' => mt_rand(2012,2017).'-'.mt_rand(1,12).'-'.mt_rand(1,28),
                'salary' => $faker->numberBetween(5,12)*100
            ]);

        }
    }
}
