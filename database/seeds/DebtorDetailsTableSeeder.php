<?php

use Illuminate\Database\Seeder;

class DebtorDetailsTableSeeder extends Seeder
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
            DB::table('tbl_due_listing')->insert([
                'cust_acno' => $faker->numberBetween($min = 6104, $max = 139456),
                'cust_id' => $faker->numberBetween($min = 7, $max = 750),
                'cust_mobile_number' => $faker->numberBetween($min = 710000000, $max = 727000000),
                'cust_name' => $faker->numberBetween($min = 1, $max = 3),
                'loan_amount' => $faker->numberBetween($min = 200, $max = 14000),
                'loan_balance' => $faker->numberBetween($min = 200, $max = 1400),
                'loan_due_date' => date('Y-m-d H:i:s'),
                'loan_issue_date' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);
        }
    }
}
