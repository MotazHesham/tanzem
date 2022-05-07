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
                'title' => 'visitors_family_create',
            ],
            [
                'id'    => 76,
                'title' => 'visitors_family_edit',
            ],
            [
                'id'    => 77,
                'title' => 'visitors_family_delete',
            ],
            [
                'id'    => 78,
                'title' => 'visitors_family_access',
            ],
            [
                'id'    => 79,
                'title' => 'setting_edit',
            ],
            [
                'id'    => 80,
                'title' => 'setting_access',
            ],
            [
                'id'    => 81,
                'title' => 'said_about_tanzem_create',
            ],
            [
                'id'    => 82,
                'title' => 'said_about_tanzem_edit',
            ],
            [
                'id'    => 83,
                'title' => 'said_about_tanzem_show',
            ],
            [
                'id'    => 84,
                'title' => 'said_about_tanzem_delete',
            ],
            [
                'id'    => 85,
                'title' => 'said_about_tanzem_access',
            ],
            [
                'id'    => 86,
                'title' => 'contactu_create',
            ],
            [
                'id'    => 87,
                'title' => 'contactu_edit',
            ],
            [
                'id'    => 88,
                'title' => 'contactu_show',
            ],
            [
                'id'    => 89,
                'title' => 'contactu_delete',
            ],
            [
                'id'    => 90,
                'title' => 'contactu_access',
            ],
            [
                'id'    => 91,
                'title' => 'news_create',
            ],
            [
                'id'    => 92,
                'title' => 'news_edit',
            ],
            [
                'id'    => 93,
                'title' => 'news_show',
            ],
            [
                'id'    => 94,
                'title' => 'news_delete',
            ],
            [
                'id'    => 95,
                'title' => 'news_access',
            ],
            [
                'id'    => 96,
                'title' => 'subscription_create',
            ],
            [
                'id'    => 97,
                'title' => 'subscription_edit',
            ],
            [
                'id'    => 98,
                'title' => 'subscription_show',
            ],
            [
                'id'    => 99,
                'title' => 'subscription_delete',
            ],
            [
                'id'    => 100,
                'title' => 'subscription_access',
            ],
            [
                'id'    => 101,
                'title' => 'important_link_create',
            ],
            [
                'id'    => 102,
                'title' => 'important_link_edit',
            ],
            [
                'id'    => 103,
                'title' => 'important_link_show',
            ],
            [
                'id'    => 104,
                'title' => 'important_link_delete',
            ],
            [
                'id'    => 105,
                'title' => 'important_link_access',
            ],
            [
                'id'    => 106,
                'title' => 'break_type_create',
            ],
            [
                'id'    => 107,
                'title' => 'break_type_edit',
            ],
            [
                'id'    => 108,
                'title' => 'break_type_show',
            ],
            [
                'id'    => 109,
                'title' => 'break_type_delete',
            ],
            [
                'id'    => 110,
                'title' => 'break_type_access',
            ],
            [
                'id'    => 111,
                'title' => 'cawader_specialization_create',
            ],
            [
                'id'    => 112,
                'title' => 'cawader_specialization_edit',
            ],
            [
                'id'    => 113,
                'title' => 'cawader_specialization_show',
            ],
            [
                'id'    => 114,
                'title' => 'cawader_specialization_delete',
            ],
            [
                'id'    => 115,
                'title' => 'cawader_specialization_access',
            ],
            [
                'id'    => 116,
                'title' => 'slider_create',
            ],
            [
                'id'    => 117,
                'title' => 'slider_edit',
            ],
            [
                'id'    => 118,
                'title' => 'slider_show',
            ],
            [
                'id'    => 119,
                'title' => 'slider_delete',
            ],
            [
                'id'    => 120,
                'title' => 'slider_access',
            ],
            [
                'id'    => 121,
                'title' => 'skill_create',
            ],
            [
                'id'    => 122,
                'title' => 'skill_edit',
            ],
            [
                'id'    => 123,
                'title' => 'skill_show',
            ],
            [
                'id'    => 124,
                'title' => 'skill_delete',
            ],
            [
                'id'    => 125,
                'title' => 'skill_access',
            ],
            [
                'id'    => 126,
                'title' => 'rate_create',
            ],
            [
                'id'    => 127,
                'title' => 'rate_edit',
            ],
            [
                'id'    => 128,
                'title' => 'rate_show',
            ],
            [
                'id'    => 129,
                'title' => 'rate_delete',
            ],
            [
                'id'    => 130,
                'title' => 'rate_access',
            ],
            [
                'id'    => 131,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
