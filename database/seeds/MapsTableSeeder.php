<?php

use Illuminate\Database\Seeder;

class MapsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('maps')->delete();
        
        \DB::table('maps')->insert(array (
            0 => 
            array (
                'id' => 1,
                'code' => '1234',
                'created_at' => '2017-08-15 08:50:33',
                'updated_at' => '2017-08-15 08:50:33',
            ),
            1 => 
            array (
                'id' => 2,
                'code' => '1243',
                'created_at' => '2017-08-15 08:52:51',
                'updated_at' => '2017-08-15 08:52:51',
            ),
            2 => 
            array (
                'id' => 3,
                'code' => '1324',
                'created_at' => '2017-08-15 08:53:12',
                'updated_at' => '2017-08-15 08:53:12',
            ),
            3 => 
            array (
                'id' => 4,
                'code' => '1342',
                'created_at' => '2017-08-15 08:53:19',
                'updated_at' => '2017-08-15 08:53:19',
            ),
            4 => 
            array (
                'id' => 5,
                'code' => '1423',
                'created_at' => '2017-08-15 08:53:25',
                'updated_at' => '2017-08-15 08:53:25',
            ),
            5 => 
            array (
                'id' => 6,
                'code' => '1432',
                'created_at' => '2017-08-15 08:53:33',
                'updated_at' => '2017-08-15 08:53:33',
            ),
            6 => 
            array (
                'id' => 7,
                'code' => '2134',
                'created_at' => '2017-08-15 08:53:42',
                'updated_at' => '2017-08-15 08:53:42',
            ),
            7 => 
            array (
                'id' => 8,
                'code' => '2143',
                'created_at' => '2017-08-15 08:53:47',
                'updated_at' => '2017-08-15 08:53:47',
            ),
            8 => 
            array (
                'id' => 9,
                'code' => '2314',
                'created_at' => '2017-08-15 08:53:55',
                'updated_at' => '2017-08-15 08:53:55',
            ),
            9 => 
            array (
                'id' => 10,
                'code' => '2341',
                'created_at' => '2017-08-15 08:54:01',
                'updated_at' => '2017-08-15 08:54:01',
            ),
            10 => 
            array (
                'id' => 11,
                'code' => '2413',
                'created_at' => '2017-08-15 08:54:07',
                'updated_at' => '2017-08-15 08:54:07',
            ),
            11 => 
            array (
                'id' => 12,
                'code' => '2431',
                'created_at' => '2017-08-15 08:54:11',
                'updated_at' => '2017-08-15 08:54:11',
            ),
            12 => 
            array (
                'id' => 13,
                'code' => '3124',
                'created_at' => '2017-08-15 08:54:19',
                'updated_at' => '2017-08-15 08:54:19',
            ),
            13 => 
            array (
                'id' => 14,
                'code' => '3142',
                'created_at' => '2017-08-15 08:54:25',
                'updated_at' => '2017-08-15 08:54:25',
            ),
            14 => 
            array (
                'id' => 15,
                'code' => '3214',
                'created_at' => '2017-08-15 08:54:33',
                'updated_at' => '2017-08-15 08:54:33',
            ),
            15 => 
            array (
                'id' => 16,
                'code' => '3241',
                'created_at' => '2017-08-15 08:54:38',
                'updated_at' => '2017-08-15 08:54:38',
            ),
            16 => 
            array (
                'id' => 17,
                'code' => '3412',
                'created_at' => '2017-08-15 08:54:46',
                'updated_at' => '2017-08-15 08:54:46',
            ),
            17 => 
            array (
                'id' => 18,
                'code' => '3421',
                'created_at' => '2017-08-15 08:54:50',
                'updated_at' => '2017-08-15 08:54:50',
            ),
            18 => 
            array (
                'id' => 19,
                'code' => '4123',
                'created_at' => '2017-08-15 08:54:55',
                'updated_at' => '2017-08-15 08:54:55',
            ),
            19 => 
            array (
                'id' => 20,
                'code' => '4132',
                'created_at' => '2017-08-15 08:55:00',
                'updated_at' => '2017-08-15 08:55:00',
            ),
            20 => 
            array (
                'id' => 21,
                'code' => '4213',
                'created_at' => '2017-08-15 08:55:05',
                'updated_at' => '2017-08-15 08:55:05',
            ),
            21 => 
            array (
                'id' => 22,
                'code' => '4231',
                'created_at' => '2017-08-15 08:55:09',
                'updated_at' => '2017-08-15 08:55:09',
            ),
            22 => 
            array (
                'id' => 23,
                'code' => '4312',
                'created_at' => '2017-08-15 08:55:15',
                'updated_at' => '2017-08-15 08:55:15',
            ),
            23 => 
            array (
                'id' => 24,
                'code' => '4321',
                'created_at' => '2017-08-15 08:55:19',
                'updated_at' => '2017-08-15 08:55:19',
            ),
        ));
        
        
    }
}