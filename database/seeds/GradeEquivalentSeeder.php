<?php

use Illuminate\Database\Seeder;

class GradeEquivalentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
