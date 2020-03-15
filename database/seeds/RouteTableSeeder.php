<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RouteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('routes')->insert([
            'name' => 'Unassigned'
        ]);    
    }
}
