<?php

return [
    'userManagement' => [
        'title'          => 'User management',
        'title_singular' => 'User management',
    ],
    'permission' => [
        'title'          => 'Permissions',
        'title_singular' => 'Permission',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'Roles',
        'title_singular' => 'Role',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'Users',
        'title_singular' => 'User',
        'user_type' => [
            'client' => 'Clients',
            'companiesAndInstitution' => 'Companies And Institution',
            'governmental_entity' => 'Governmental Entity',
        ],
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'Phone',
            'phone_helper'             => ' ',
            'approved'                    => 'Approved',
            'approved_helper'             => ' ',
            'landline_phone'           => 'Landline Phone',
            'landline_phone_helper'    => ' ',
            'website'                  => 'Website',
            'website_helper'           => ' ',
            'photo'                  => 'Photo',
            'photo_helper'           => ' ',
        ],
    ],
    'auditLog' => [
        'title'          => 'Audit Logs',
        'title_singular' => 'Audit Log',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'description'         => 'Description',
            'description_helper'  => ' ',
            'subject_id'          => 'Subject ID',
            'subject_id_helper'   => ' ',
            'subject_type'        => 'Subject Type',
            'subject_type_helper' => ' ',
            'user_id'             => 'User ID',
            'user_id_helper'      => ' ',
            'properties'          => 'Properties',
            'properties_helper'   => ' ',
            'host'                => 'Host',
            'host_helper'         => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
        ],
    ],
    'userAlert' => [
        'title'          => 'User Alerts',
        'title_singular' => 'User Alert',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'Alert Text',
            'alert_text_helper' => ' ',
            'alert_link'        => 'Alert Link',
            'alert_link_helper' => ' ',
            'user'              => 'Users',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'governmentalEntity' => [
        'title'          => 'Governmental Entities',
        'title_singular' => 'Governmental Entity',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'client' => [
        'title'          => 'Clients',
        'title_singular' => 'Client',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'commerical_num'           => 'Commerical Num',
            'commerical_num_helper'    => ' ',
            'commerical_expiry'        => 'Commerical Expiry',
            'commerical_expiry_helper' => ' ',
            'licence_num'              => 'Licence Num',
            'licence_num_helper'       => ' ',
            'licence_expiry'           => 'Licence Expiry',
            'licence_expiry_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'specialization'           => 'Specialization',
            'specialization_helper'    => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
        ],
    ],
    'generalSetting' => [
        'title'          => 'General Settings',
        'title_singular' => 'General Setting',
    ],
    'specialization' => [
        'title'          => 'Specialization',
        'title_singular' => 'Specialization',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name Ar',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name En',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'companiesAndInstitution' => [
        'title'          => 'Companies And Institutions',
        'title_singular' => 'Companies And Institution',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'commerical_num'           => 'Commerical Num',
            'commerical_num_helper'    => ' ',
            'commerical_expiry'        => 'Commerical Expiry',
            'commerical_expiry_helper' => ' ',
            'licence_num'              => 'Licence Num',
            'licence_num_helper'       => ' ',
            'licence_expiry'           => 'Licence Expiry',
            'licence_expiry_helper'    => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'specializations'          => 'Specializations',
            'specializations_helper'   => ' ',
            'galery'                   => 'Galery',
            'galery_helper'            => ' ',
            'videos'                   => 'Videos',
            'videos_helper'            => ' ',
            'city'                     => 'City',
            'city_helper'              => ' ',
            'about_company'            => 'About Company',
            'about_company_helper'     => ' ',
            'facebook'                 => 'Facebook',
            'facebook_helper'          => ' ',
            'gmail'                    => 'Gmail',
            'gmail_helper'             => ' ',
            'linked'                   => 'Linked',
            'linked_helper'            => ' ',
            'instagram'                => 'Instagram',
            'instagram_helper'         => ' ',
            'twitter'                  => 'Twitter',
            'twitter_helper'           => ' ',
        ],
    ],
    'cawader' => [
        'title'          => 'Cawader',
        'title_singular' => 'Cawader',
        'fields'         => [
            'id'                               => 'ID',
            'id_helper'                        => ' ',
            'dob'                              => 'Dob',
            'dob_helper'                       => ' ',
            'created_at'                       => 'Created at',
            'created_at_helper'                => ' ',
            'updated_at'                       => 'Updated at',
            'updated_at_helper'                => ' ',
            'deleted_at'                       => 'Deleted at',
            'deleted_at_helper'                => ' ',
            'city'                             => 'City',
            'city_helper'                      => ' ',
            'degree'                           => 'Degree',
            'degree_helper'                    => ' ',
            'specialization'                   => 'Specialization',
            'specialization_helper'            => ' ',
            'working_hours'                    => 'Working Hours',
            'working_hours_helper'             => ' ',
            'identity_number'                  => 'Identity Number',
            'identity_number_helper'           => ' ',
            'user'                             => 'User',
            'user_helper'                      => ' ',
            'companies_and_institution'        => 'Companies And Institution',
            'companies_and_institution_helper' => ' ',
            'desceiption'                      => 'Desceiption',
            'desceiption_helper'               => ' ',
        ],
    ],
    'city' => [
        'title'          => 'Cities',
        'title_singular' => 'City',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name In Arabic',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name In English',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'event' => [
        'title'          => 'Events',
        'title_singular' => 'Event',
        'date' => 'Date',
        'time' => 'Attend Time',
        'others'    => [
            'info' => 'Info',
            'map' => 'Map',
            'attendance_in_event' => 'Attendance Cader in Event',
            'attendance' => 'Attendance',
            'location' => 'Location',
            'distance' => 'Distance From Event',
        ],
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'title'                  => 'Title',
            'title_helper'           => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'start_date'             => 'Start Date',
            'start_date_helper'      => ' ',
            'end_date'               => 'End Date',
            'end_date_helper'        => ' ',
            'start_time'             => 'Start Time',
            'start_time_helper'      => ' ',
            'end_time'               => 'End Time',
            'end_time_helper'        => ' ',
            'address'                => 'Address',
            'address_helper'         => ' ',
            'latitude'               => 'Latitude',
            'latitude_helper'        => ' ',
            'longitude'              => 'Longitude',
            'area'             => 'Area',
            'area_helper'      => '*Distanace between Cader and Event calulutes in Meter on a straight line between them*',
            'longitude_helper'       => ' ',
            'photo'                  => 'Photo',
            'photo_helper'           => ' ',
            'company'                => 'Company',
            'company_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'city'                   => 'City',
            'city_helper'            => ' ',
            'available_gates'        => 'Available Gates',
            'available_gates_helper' => ' ',
            'specializations'        => 'Specializations',
            'specializations_helper' => ' ',
            'cawaders'               => 'Cawaders',
            'cawaders_helper'        => ' ',
            'reviews'                => 'Reviews',
            'reviews_helper'         => ' ',
            'cost'                   => 'Cost',
            'cost_helper'            => ' ',
            'status'                 => 'Status',
            'status_helper'          => ' ',
            'client'                 => 'Client',
            'client_helper'          => ' ',
            'government'             => 'Government',
            'government_helper'      => ' ',
        ],
    ],
    'eventManagment' => [
        'title'          => 'Event Managment',
        'title_singular' => 'Event Managment',
    ],
    'brand' => [
        'title'          => 'Brands',
        'title_singular' => 'Brand',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'photo'              => 'Photo',
            'photo_helper'       => ' ',
            'event'              => 'Event',
            'event_helper'       => ' ',
            'zone_name'          => 'Zone Name',
            'zone_name_helper'   => ' ',
            'latitude'           => 'Latitude',
            'latitude_helper'    => ' ',
            'longitude'          => 'Longitude',
            'longitude_helper'   => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'gate' => [
        'title'          => 'Gates',
        'title_singular' => 'Gate',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'gate'              => 'Gate',
            'gate_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'visitor' => [
        'title'          => 'Visitors',
        'title_singular' => 'Visitor',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'national'          => 'National',
            'national_helper'   => ' ',
            'events'            => 'Events',
            'events_helper'     => ' ',
            'brands'            => 'Brands',
            'brands_helper'     => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'visitorsFamily' => [
        'title'          => 'Visitors Families',
        'title_singular' => 'Visitors Family',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'visitor'           => 'Visitor',
            'visitor_helper'    => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'gender'            => 'Gender',
            'gender_helper'     => ' ',
            'relation'          => 'Relation',
            'relation_helper'   => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'identity'          => 'Identity',
            'identity_helper'   => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'setting' => [
        'title'          => 'Settings',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'address'                   => 'Address',
            'address_helper'            => ' ',
            'phone_1'                   => 'Phone 1',
            'phone_1_helper'            => ' ',
            'phone_2'                   => 'Phone 2',
            'phone_2_helper'            => ' ',
            'email_1'                   => 'Email 1',
            'email_1_helper'            => ' ',
            'email_2'                   => 'Email 2',
            'email_2_helper'            => ' ',
            'facebook'                  => 'Facebook',
            'facebook_helper'           => ' ',
            'gmail'                     => 'Gmail',
            'gmail_helper'              => ' ',
            'linkedin'                  => 'Linkedin',
            'linkedin_helper'           => ' ',
            'instagram'                 => 'Instagram',
            'instagram_helper'          => ' ',
            'twitter'                   => 'Twitter',
            'twitter_helper'            => ' ',
            'latitude'                  => 'Latitude',
            'latitude_helper'           => ' ',
            'longitude'                 => 'Longitude',
            'longitude_helper'          => ' ',
            'home_text_1'               => 'Home Text 1',
            'home_text_1_helper'        => ' ',
            'home_text_2'               => 'Home Text 2',
            'home_text_2_helper'        => ' ',
            'about_us'                  => 'About Us',
            'about_us_helper'           => ' ',
            'caders_text'               => 'Caders Text',
            'caders_text_helper'        => ' ',
            'events_text'               => 'Events Text',
            'events_text_helper'        => ' ',
            'news_text'                 => 'News Text',
            'news_text_helper'          => ' ',
            'how_we_work_header'        => 'How We Work Header',
            'how_we_work_header_helper' => ' ',
            'how_we_work_1'             => 'How We Work 1',
            'how_we_work_1_helper'      => ' ',
            'how_we_work_2'             => 'How We Work 2',
            'how_we_work_2_helper'      => ' ',
            'how_we_work_3'             => 'How We Work 3',
            'how_we_work_3_helper'      => ' ',
            'said_about_tanzem'         => 'Said About Tanzem',
            'said_about_tanzem_helper'  => ' ',
            'organizers_text'           => 'Organizers Text',
            'organizers_text_helper'    => ' ',
            'contact_us_text'           => 'Contact Us Text',
            'contact_us_text_helper'    => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
        ],
    ],
    'saidAboutTanzem' => [
        'title'          => 'Said About Tanzem',
        'title_singular' => 'Said About Tanzem',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'Name',
            'name_helper'         => ' ',
            'job_position'        => 'Job Position',
            'job_position_helper' => ' ',
            'photo'               => 'Photo',
            'photo_helper'        => ' ',
            'text_1'              => 'Text 1',
            'text_1_helper'       => ' ',
            'text_2'              => 'Text 2',
            'text_2_helper'       => ' ',
            'created_at'          => 'Created at',
            'created_at_helper'   => ' ',
            'updated_at'          => 'Updated at',
            'updated_at_helper'   => ' ',
            'deleted_at'          => 'Deleted at',
            'deleted_at_helper'   => ' ',
        ],
    ],
    'contactu' => [
        'title'          => 'Contact Us',
        'title_singular' => 'Contact Us',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'phone'             => 'Phone',
            'phone_helper'      => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'message'           => 'Message',
            'message_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'news' => [
        'title'          => 'News',
        'title_singular' => 'News',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'title'                    => 'Title',
            'title_helper'             => ' ',
            'short_description'        => 'Short Description',
            'short_description_helper' => ' ',
            'long_description'         => 'Long Description',
            'long_description_helper'  => ' ',
            'photo'                    => 'Photo',
            'photo_helper'             => ' ',
            'user'                     => 'User',
            'user_helper'              => ' ',
            'status'                   => 'Status',
            'status_helper'            => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
        ],
    ],
    'subscription' => [
        'title'          => 'Subscription',
        'title_singular' => 'Subscription',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'email'             => 'Email',
            'email_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'importantLink' => [
        'title'          => 'Important Links',
        'title_singular' => 'Important Link',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'text'              => 'Text',
            'text_helper'       => ' ',
            'link'              => 'Link',
            'link_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'breakType' => [
        'title'          => 'Break Types',
        'title_singular' => 'Break Type',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'time'              => 'Time',
            'time_helper'       => 'In Minutes',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'cawaderSpecialization' => [
        'title'          => 'Cawader Specialization',
        'title_singular' => 'Cawader Specialization',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'Name In Arabic',
            'name_ar_helper'    => ' ',
            'name_en'           => 'Name In English',
            'name_en_helper'    => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
];
