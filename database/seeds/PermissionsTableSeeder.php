<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'audit_log_show',
            ],
            [
                'id'    => 18,
                'title' => 'audit_log_access',
            ],
            [
                'id'    => 19,
                'title' => 'user_alert_create',
            ],
            [
                'id'    => 20,
                'title' => 'user_alert_show',
            ],
            [
                'id'    => 21,
                'title' => 'user_alert_delete',
            ],
            [
                'id'    => 22,
                'title' => 'user_alert_access',
            ],
            [
                'id'    => 23,
                'title' => 'governmental_entity_create',
            ],
            [
                'id'    => 24,
                'title' => 'governmental_entity_edit',
            ],
            [
                'id'    => 25,
                'title' => 'governmental_entity_show',
            ],
            [
                'id'    => 26,
                'title' => 'governmental_entity_delete',
            ],
            [
                'id'    => 27,
                'title' => 'governmental_entity_access',
            ],
            [
                'id'    => 28,
                'title' => 'client_create',
            ],
            [
                'id'    => 29,
                'title' => 'client_edit',
            ],
            [
                'id'    => 30,
                'title' => 'client_show',
            ],
            [
                'id'    => 31,
                'title' => 'client_delete',
            ],
            [
                'id'    => 32,
                'title' => 'client_access',
            ],
            [
                'id'    => 33,
                'title' => 'general_setting_access',
            ],
            [
                'id'    => 34,
                'title' => 'specialization_create',
            ],
            [
                'id'    => 35,
                'title' => 'specialization_edit',
            ],
            [
                'id'    => 36,
                'title' => 'specialization_show',
            ],
            [
                'id'    => 37,
                'title' => 'specialization_delete',
            ],
            [
                'id'    => 38,
                'title' => 'specialization_access',
            ],
            [
                'id'    => 39,
                'title' => 'companies_and_institution_create',
            ],
            [
                'id'    => 40,
                'title' => 'companies_and_institution_edit',
            ],
            [
                'id'    => 41,
                'title' => 'companies_and_institution_show',
            ],
            [
                'id'    => 42,
                'title' => 'companies_and_institution_delete',
            ],
            [
                'id'    => 43,
                'title' => 'companies_and_institution_access',
            ],
            [
                'id'    => 44,
                'title' => 'cawader_create',
            ],
            [
                'id'    => 45,
                'title' => 'cawader_edit',
            ],
            [
                'id'    => 46,
                'title' => 'cawader_show',
            ],
            [
                'id'    => 47,
                'title' => 'cawader_delete',
            ],
            [
                'id'    => 48,
                'title' => 'cawader_access',
            ],
            [
                'id'    => 49,
                'title' => 'city_create',
            ],
            [
                'id'    => 50,
                'title' => 'city_edit',
            ],
            [
                'id'    => 51,
                'title' => 'city_show',
            ],
            [
                'id'    => 52,
                'title' => 'city_delete',
            ],
            [
                'id'    => 53,
                'title' => 'city_access',
            ],
            [
                'id'    => 54,
                'title' => 'event_create',
            ],
            [
                'id'    => 55,
                'title' => 'event_edit',
            ],
            [
                'id'    => 56,
                'title' => 'event_show',
            ],
            [
                'id'    => 57,
                'title' => 'event_delete',
            ],
            [
                'id'    => 58,
                'title' => 'event_access',
            ],
            [
                'id'    => 59,
                'title' => 'event_managment_access',
            ],
            [
                'id'    => 60,
                'title' => 'brand_create',
            ],
            [
                'id'    => 61,
                'title' => 'brand_edit',
            ],
            [
                'id'    => 62,
                'title' => 'brand_show',
            ],
            [
                'id'    => 63,
                'title' => 'brand_delete',
            ],
            [
                'id'    => 64,
                'title' => 'brand_access',
            ],
            [
                'id'    => 65,
                'title' => 'gate_create',
            ],
            [
                'id'    => 66,
                'title' => 'gate_edit',
            ],
            [
                'id'    => 67,
                'title' => 'gate_show',
            ],
            [
                'id'    => 68,
                'title' => 'gate_delete',
            ],
            [
                'id'    => 69,
                'title' => 'gate_access',
            ],
            [
                'id'    => 70,
                'title' => 'visitor_create',
            ],
            [
                'id'    => 71,
                'title' => 'visitor_edit',
            ],
            [
                'id'    => 72,
                'title' => 'visitor_show',
            ],
            [
                'id'    => 73,
                'title' => 'visitor_delete',
            ],
            [
                'id'    => 74,
                'title' => 'visitor_access',
            ],
            [
                'id'    => 75,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
