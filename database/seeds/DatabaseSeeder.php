<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        DB::table('admins')->insert([
        	'username' => 'admin',
        	'firstname' => 'Admin',
        	'lastname' => 'Admin',
        	'id_number' => '1111111111',
            'mobile_number' => '09000000000',
        	'password' => bcrypt('admin'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);


        DB::table('id_references')->insert([
        	'year' => date('Y'),
        	'month' => date('m'),
        	'last' => 0
        ]);
    }
}
