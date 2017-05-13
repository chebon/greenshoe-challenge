<?php

use Illuminate\Database\Seeder;

class DebtorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i<=20; $i++){
            DB::table('tbl_profiles')->insert([
                'batch_numbers' => $faker->numberBetween($min = 5, $max = 50),
                'clearing_mpesa_trans_id' => $faker->numberBetween($min = 4, $max = 800),
                'date_cleared' => date('Y-m-d H:i:s'),
                'fully_cleared' => $faker->numberBetween($min = 0, $max = 1),
                'mobile_number' => $faker->numberBetween($min = 710000000, $max = 727000000),
                'national_id' => $faker->numberBetween($min = 27009467, $max = 32449264),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
