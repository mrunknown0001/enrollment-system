<?php

use Illuminate\Database\Seeder;

class CourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('courses')->insert([
        	[
        		'title' => 'Information Technology',
        		'code' => '2YIT',
        		'description' => '2 Years Course Information Technology'
        	]
        ]);
    }
}
