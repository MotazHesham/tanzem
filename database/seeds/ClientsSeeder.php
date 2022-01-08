<?php

use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\User;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'صله',
            'email' => 'sela@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'client', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'sela.com', 
        ]);

        $client = Client::create([
            'user_id' => $user->id,
            'commerical_num' => '123',
            'commerical_expiry' => '28/11/2023',
            'licence_num' => '321',
            'licence_expiry' => '28/11/2023',
        ]);
        
        $user = User::create([
            'name' => 'روتانا',
            'email' => 'rotana@gmail.com',
            'password' => bcrypt('password'),
            'user_type' => 'client', 
            'phone' => '0501002003', 
            'landline_phone' => '123', 
            'website' => 'rotana.com', 
        ]);

        $client = Client::create([
            'user_id' => $user->id,
            'commerical_num' => '123',
            'commerical_expiry' => '28/11/2023',
            'licence_num' => '321',
            'licence_expiry' => '28/11/2023',
        ]);
    }
}
