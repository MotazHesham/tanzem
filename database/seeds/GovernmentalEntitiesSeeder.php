<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\GovernmentalEntity;

class GovernmentalEntitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'هيئة الترفيه',
            'email' => 'tarfeh@gov.com',
            'password' => bcrypt('password'),
            'user_type' => 'governmental_entity', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'tarfeh.com', 
        ]);

        $governmentalEntity = GovernmentalEntity::create([
            'user_id' => $user->id
        ]);

        $user = User::create([
            'name' => 'وزارة الرياضة',
            'email' => 'ryadah@gov.com',
            'password' => bcrypt('password'),
            'user_type' => 'governmental_entity', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'ryadah.com', 
        ]);
        
        $governmentalEntity = GovernmentalEntity::create([
            'user_id' => $user->id
        ]);

        $user = User::create([
            'name' => 'الهئة العامة للمؤتمرات',
            'email' => 'moatmrat@gov.com',
            'password' => bcrypt('password'),
            'user_type' => 'governmental_entity', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'moatmrat.com', 
        ]);
        
        $governmentalEntity = GovernmentalEntity::create([
            'user_id' => $user->id
        ]);
    }
}
