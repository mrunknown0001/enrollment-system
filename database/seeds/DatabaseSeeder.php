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


        DB::table('active_semesters')->insert([
            [
                'name' => 'First Semester',
                'active' => 0
            ],
            [
                'name' => 'Second Semester',
                'active' => 0
            ],
            [
                'name' => 'Third Semester',
                'active' => 0
            ],
            [
                'name' => 'Summer',
                'active' => 0
            ]
        ]);

        DB::table('misc_fees')->insert([
            'name' => 'misc fee',
            'amount' => 100.00,
            'type' => 3
        ]);

        DB::table('enrollment_settings')->insert([
            'status' => 0
        ]);

        DB::table('student_per_subjects')->insert([
            'limit' => 40
        ]);

        DB::table('grade_equivalents')->insert([
            [
                'equivalent' => 1.0,
                'from' => 99,
                'to' => 100,
                'description' => 'Excellent'
            ],
            [
                'equivalent' => 1.25,
                'from' => 95,
                'to' => 98,
                'description' => 'Very Good'
            ],
            [
                'equivalent' => 1.5,
                'from' => 92,
                'to' => 94,
                'description' => 'Very Good'
            ],
            [
                'equivalent' => 1.75,
                'from' => 89,
                'to' => 91,
                'description' => 'Very Good'
            ],
            [
                'equivalent' => 2.0,
                'from' => 86,
                'to' => 88,
                'description' => 'Satisfactory'
            ],
            [
                'equivalent' => 2.25,
                'from' => 83,
                'to' => 85,
                'description' => 'Satisfactory'
            ],
            [
                'equivalent' => 2.5,
                'from' => 80,
                'to' => 82,
                'description' => 'Satisfactory'
            ],
            [
                'equivalent' => 2.75,
                'from' => 77,
                'to' => 79,
                'description' => 'Fair'
            ],
            [
                'equivalent' => 3.0,
                'from' => 75,
                'to' => 76,
                'description' => 'Fair'
            ],
            [
                'equivalent' => 5.0,
                'from' => 74,
                'to' => 0,
                'description' => 'Failed'
            ]
        ]);

        $this->call([
            // EquivalentTableSeeder::class,
            SubjectTableSeeder::class,
            CourseTableSeeder::class,
            ProgramTableSeeder::class,
        ]);
    }
}
