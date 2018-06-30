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

        // admin user
        DB::table('admins')->insert([
        	'username' => 'admin',
        	'firstname' => 'Admin',
        	'lastname' => 'Admin',
        	'id_number' => '1111111111',
            'mobile_number' => '09000000000',
        	'password' => bcrypt('admin'),
            'created_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);

        // reference in creating id number
        DB::table('id_references')->insert([
        	'year' => date('Y'),
        	'month' => date('m'),
        	'last' => 0
        ]);

        // four terms available
        DB::table('terms')->insert([
            [
                'name' => 'Prelim'
            ],
            [
                'name' => 'Midterm'
            ],
            [
                'name' => 'Semi-Finals'
            ],
            [
                'name' => 'Finals'
            ]
        ]);

        // year level
        DB::table('year_levels')->insert([
            [
                'name' => 'First Year',
                'description' => 'First Year Level'
            ],
            [
                'name' => 'Second Year',
                'description' => 'Second Year Level'
            ]
        ]);
        
        
        // initial price per unit
        DB::table('price_per_units')->insert([
            'name' => 'Lecture',
            'price' => 0
        ]);

        $this->call([
            SubjectTableSeeder::class,
            CourseTableSeeder::class,
            ProgramTableSeeder::class,
        ]);
    }
}
