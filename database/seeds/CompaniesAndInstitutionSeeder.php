<?php

use Illuminate\Database\Seeder;
use App\Models\CompaniesAndInstitution;
use App\Models\User; 

class CompaniesAndInstitutionSeeder extends Seeder
{ 
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $user = User::create([
            'name' => 'envento',
            'email' => 'envento@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'companiesAndInstitution', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'envento.com', 
        ]);

        
        $companiesAndInstitution = CompaniesAndInstitution::create([
            'user_id' => $user->id, 
            'commerical_num' => '123',
            'commerical_expiry' => '28/11/2023',
            'licence_num' => '321',
            'licence_expiry' => '28/11/2023',
            'about_company' => 'للسياحة والمهرجنات', 
            'facebook' => 'facebook', 
            'gmail' => 'gmail', 
            'linked' => 'linked', 
            'instagram' => 'instagram', 
            'twitter' => 'twitter', 
            'city_id' => 1, 
        ]); 


        $companiesAndInstitution->specializations()->sync([3,2,1]);


        $user = User::create([
            'name' => 'New Level',
            'email' => 'newlevel@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'companiesAndInstitution', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'newlevel.com', 
        ]);

        
        $companiesAndInstitution = CompaniesAndInstitution::create([
            'user_id' => $user->id, 
            'commerical_num' => '123',
            'commerical_expiry' => '28/11/2023',
            'licence_num' => '321',
            'licence_expiry' => '28/11/2023',
            'about_company' => 'للسفاري الفعاليات', 
            'facebook' => 'facebook', 
            'gmail' => 'gmail', 
            'linked' => 'linked', 
            'instagram' => 'instagram', 
            'twitter' => 'twitter', 
            'city_id' => 1, 
        ]);  
        $companiesAndInstitution->specializations()->sync([1,2]);
    }
}
