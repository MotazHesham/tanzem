<?php

use Illuminate\Database\Seeder;
use App\Models\Cawader;  
use App\Models\User; 

class CawadersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([ 
            'name' => 'احمد محمد',
            'email' => 'ahmed@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'cader', 
            'phone' => '0501002003',  
        ]); 

        $cawader = Cawader::create([
            'user_id' => $user->id,
            'dob' => '28/11/2023',
            'city_id' => 1,
            'degree' => 'Bachelors Degree',
            'desceiption' => 'Teamworker',
            'working_hours' => '8',
            'identity_number' => '123',
            'companies_and_institution_id' => 1,
        ]);

        $cawader->specializations()->sync([1,2]);


        
        $user = User::create([ 
            'name' => 'مصطفي',
            'email' => 'mostafa@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'cader', 
            'phone' => '0501002003',  
        ]); 

        $cawader = Cawader::create([
            'user_id' => $user->id,
            'dob' => '28/11/2023',
            'city_id' => 3,
            'degree' => 'Diploma',
            'desceiption' => 'Teamworker',
            'working_hours' => '8',
            'identity_number' => '321',
            'companies_and_institution_id' => 2,
        ]);

        $cawader->specializations()->sync([1,2,3,4]);
    }
}
