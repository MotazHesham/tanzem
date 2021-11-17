<?php

use Illuminate\Database\Seeder;
use App\Models\Gate;

class GateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1 ; $i <= 20 ; $i++){
            $gate = new Gate;
            $gate->gate = $i;
            $gate->save();
        }
    }
}
