<?php

use Illuminate\Database\Seeder;

class ProgramTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('programs')->insert([
        	[
        		'title' => 'Computer Systems Servicing',
        		'code' => 'CSS',
        		'description' => 'Computer Systems Servicing, troubleshooting, and maintenance.',
        		'tuition_fee' => 300.00
        	],
        	[
        		'title' => 'Bookeeping',
        		'code' => 'BK',
        		'description' => 'Bookeeping',
        		'tuition_fee' => 300.00
        	]
        ]);
    }
}
