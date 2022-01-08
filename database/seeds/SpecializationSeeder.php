<?php

use Illuminate\Database\Seeder;
use App\Models\Specialization;

class SpecializationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 

        $ar = ['ممثل','حارس','مصمم','سائق'];
        $en = ['Actor','Security','Designer','Driver'];

        for ($i = 0 ; $i <= 3 ; $i++) {
            $specialization = new Specialization;
            $specialization->name_en = $en[$i];
            $specialization->name_ar = $ar[$i];
            $specialization->save();
        }
    }
}
