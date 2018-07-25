<?php

use Illuminate\Database\Seeder;

class SubjectTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subjects')->insert([
        	[
        		'code' => 'revENG01',
        		'description' => 'Philippine Literature',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'revCOMP1',
        		'description' => 'Introduction to Computer Concepts & Programming Fundamentals',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'IT101L',
        		'description' => 'Visual Graphic and Web Design',
        		'units' => 3,
        		'hours' => 3,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'SOC01',
        		'description' => 'Rizal Life, Works and Writings',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'SOC02',
        		'description' => 'Philippine History: Roots and Development',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'PE01',
        		'description' => 'Phisical Fitness',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'IT102L',
        		'description' => 'Object Oriented Programming',
        		'units' => 3,
        		'hours' => 3,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'IT103L',
        		'description' => 'Traditional and Digital Animation',
        		'units' => 3,
        		'hours' => 3,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'MATH01',
        		'description' => 'College Algebra',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'MATH02',
        		'description' => 'Plane Trigonometry',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'NSTP01',
        		'description' => 'Community Service 1',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'PDPR',
        		'description' => 'Personality Development and Public Relation',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 1
        	],
        	[
        		'code' => 'IT105L',
        		'description' => 'Web Programming',
        		'units' => 4,
        		'hours' => 4,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'IT106L',
        		'description' => 'Multimedia System',
        		'units' => 4,
        		'hours' => 4,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'IT107',
        		'description' => 'Data Structure',
        		'units' => 3,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'IT108L',
        		'description' => 'Database Management System',
        		'units' => 3,
        		'hours' => 2,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'SOC03',
        		'description' => 'Logic',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'PE2',
        		'description' => 'Rhythmic Activities',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'FTS',
        		'description' => 'Field Trips and Seminar',
        		'units' => 1,
        		'hours' => 0,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'revENG02',
        		'description' => 'World Literature',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'IT104L',
        		'description' => 'Game Programming',
        		'units' => 3,
        		'hours' => 3,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'NSTP2',
        		'description' => 'Community Service 2',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 1,
                'semester' => 2
        	],
        	[
        		'code' => 'ENG03',
        		'description' => 'Writing Skills',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'revCOMP02L',
        		'description' => 'Touch Typing',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'IT109L',
        		'description' => 'Web Security Protocols',
        		'units' => 4,
        		'hours' => 4,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'PE03',
        		'description' => 'Individual/Dual Games and Sports',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'IT110L',
        		'description' => 'Logic Design & Switching',
        		'units' => 3,
        		'hours' => 3,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'IT111',
        		'description' => 'Free Elective 1',
        		'units' => 3,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'MATH03',
        		'description' => 'Probability & Statistics',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'PHYS01',
        		'description' => 'Physics',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 1
        	],
        	[
        		'code' => 'IT112',
        		'description' => 'Free Elective 2',
        		'units' => 3,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'IT113L',
        		'description' => 'Software Engineering',
        		'units' => 4,
        		'hours' => 4,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'SAD',
        		'description' => 'System Analysis & Desig`n',
        		'units' => 4,
        		'hours' => 1,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'PE4',
        		'description' => 'Team Games and Sports',
        		'units' => 2,
        		'hours' => 2,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'NS',
        		'description' => 'Artificial Intelligence',
        		'units' => 4,
        		'hours' => 4,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'ENG04',
        		'description' => 'Communication Skills',
        		'units' => 2,
        		'hours' => 1,
        		'year_level' => 2,
                'semester' => 2
        	],
        	[
        		'code' => 'OJT',
        		'description' => 'On the Job Trading for Information Technology',
        		'units' => 1,
        		'hours' => 250,
        		'year_level' => 2,
                'semester' => 2
        	]
        ]);
    }
}
