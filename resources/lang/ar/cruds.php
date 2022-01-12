<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
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
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
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
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'user_type' => [
            'client' => 'عملاء',
            'companiesAndInstitution' => 'شركات ومؤسسات',
            'governmental_entity' => 'جهات حكومية',
        ],
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'الأسم',
            'name_helper'              => ' ',
            'email'                    => 'البريد الألكتروني',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'كلمة المرور',
            'password_helper'          => ' ',
            'roles'                    => 'الأدوار',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'phone'                    => 'الجوال',
            'phone_helper'             => ' ',
            'landline_phone'           => 'رقم الهاتف الأرضي',
            'landline_phone_helper'    => ' ',
            'website'                  => 'الويب سايت',
            'website_helper'           => ' ',
            'photo'                  => 'الصورة',
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
        'title'          => 'تنبيهات المستخدمين',
        'title_singular' => 'تنبيهات المستخدمين',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'alert_text'        => 'المحتوي',
            'alert_text_helper' => ' ',
            'alert_link'        => 'الرابط',
            'alert_link_helper' => 'اللينك عند ضغط المستحدم علي التنبيه',
            'user'              => 'المستخدمين',
            'user_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
        ],
    ],
    'governmentalEntity' => [
        'title'          => 'الجهات الحكومية',
        'title_singular' => 'جهة حكومية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'المستخدم',
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
        'title'          => 'العملاء',
        'title_singular' => 'عميل',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'commerical_num'           => 'رقم السجل التجاري',
            'commerical_num_helper'    => ' ',
            'commerical_expiry'        => 'تاريخ انتهاء السجل التجاري',
            'commerical_expiry_helper' => ' ',
            'licence_num'              => 'رقم الترخيص',
            'licence_num_helper'       => ' ',
            'licence_expiry'           => 'تاريح انتهاء رقم الترخيص',
            'licence_expiry_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'specialization'           => 'التخصصات',
            'specialization_helper'    => ' ',
            'user'              => 'المستخدم',
            'user_helper'       => ' ',
        ],
    ],
    'generalSetting' => [
        'title'          => 'الأعدادات العامة',
        'title_singular' => 'الأعدادات العامة',
    ],
    'specialization' => [
        'title'          => 'تخصصات الفعاليات',
        'title_singular' => 'تخصص فعالية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'الأسم باللغة العربية',
            'name_ar_helper'    => ' ',
            'name_en'           => 'الأسم باللغة الانجليزية',
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
        'title'          => 'الشركات والمؤسسات',
        'title_singular' => 'شركات ومؤسسات',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'commerical_num'           => 'رقم السجل التجاري',
            'commerical_num_helper'    => ' ',
            'commerical_expiry'        => 'تاريخ انتهاء السجل التجاري',
            'commerical_expiry_helper' => ' ',
            'licence_num'              => 'رقم الترخيص',
            'licence_num_helper'       => ' ',
            'licence_expiry'           => 'تاريح انتهاء رقم الترخيص',
            'licence_expiry_helper'    => ' ',
            'user'                     => 'المستخدم',
            'user_helper'              => ' ',
            'specializations'           => 'التخصصات',
            'specializations_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'specializations'          => 'التخصصات',
            'specializations_helper'   => ' ',
            'galery'                   => 'الصور',
            'galery_helper'            => ' ',
            'videos'                   => 'الفيديوهات',
            'videos_helper'            => ' ',
            'city'                     => 'المدينة',
            'city_helper'              => ' ',
            'about_company'            => 'عن الشركة',
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
        'title'          => 'كوادر',
        'title_singular' => 'كادر',
        'fields'         => [
            'id'                               => 'ID',
            'id_helper'                        => ' ',
            'dob'                              => 'تاريخ الميلاد',
            'dob_helper'                       => ' ',
            'created_at'                       => 'Created at',
            'created_at_helper'                => ' ',
            'updated_at'                       => 'Updated at',
            'updated_at_helper'                => ' ',
            'deleted_at'                       => 'Deleted at',
            'deleted_at_helper'                => ' ',
            'city'                             => 'المدينة',
            'city_helper'                      => ' ',
            'degree'                           => 'المؤهل الدراسي',
            'degree_helper'                    => ' ',
            'specialization'                   => 'التخصصات',
            'specialization_helper'            => ' ',
            'working_hours'                    => 'ساعات العمل',
            'working_hours_helper'             => ' ',
            'identity_number'                  => 'رقم الهوية الوطنية',
            'identity_number_helper'           => ' ',
            'user'                             => 'اليوزر',
            'user_helper'                      => ' ',
            'companies_and_institution'        => 'شركة',
            'companies_and_institution_helper' => ' ',
            'desceiption'                      => 'الوصف',
            'desceiption_helper'               => ' ',
        ],
    ], 
    'city' => [
        'title'          => 'المدن',
        'title_singular' => 'مدينة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'الأسم باللغة العربية',
            'name_ar_helper'    => ' ',
            'name_en'           => 'الأسم باللغة الأنجليزية',
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
        'title'          => 'الفعاليات',
        'title_singular' => 'فعالية',
        'date' => 'التاريخ',
        'time' => 'وقت الحضور',
        'others'    => [
            'info' => 'معلومات الفعالية',
            'map' => 'عرض الخريطة',
            'attendance_in_event' => 'سجل حضور الكادر في الفعالية',
            'attendance' => 'وقت الحضور',
            'location' => 'مكان الحضور',
            'distance' => 'المسافة عن مكان الفعالية',
        ],
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'title'                  => 'اسم الفعالية',
            'title_helper'           => ' ',
            'description'            => 'الوصف',
            'description_helper'     => ' ',
            'start_date'             => 'بداية الفعالية',
            'start_date_helper'      => ' ',
            'end_date'               => 'نهاية الفعالية',
            'end_date_helper'        => ' ',
            'start_time'             => 'بداية الحضور',
            'start_time_helper'      => ' ',
            'end_time'               => 'نهاية الحضور',
            'end_time_helper'        => ' ',
            'address'                => 'العنوان',
            'address_helper'         => ' ',
            'latitude'               => 'خط العرض',
            'latitude_helper'        => ' ',
            'longitude'              => 'خط الطول',
            'longitude_helper'       => ' ',
            'area'                    => 'المساحة',
            'area_helper'             => '*يتم حساب المسافة بين الكادر ومكان الفعالية بالمتر علي خط مستقيم بينهما*',
            'photo'                  => 'الصورة',
            'photo_helper'           => ' ',
            'company'                => 'الشركة',
            'company_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
            'city'                   => 'المدينة',
            'city_helper'            => ' ',
            'available_gates'        => 'الأبواب المتاحة',
            'available_gates_helper' => ' ',
            'specializations'        => 'التخصصات',
            'specializations_helper' => ' ',
            'cawaders'               => 'الكوادر',
            'cawaders_helper'        => ' ',
            'reviews'                => 'التقييمات',
            'reviews_helper'         => ' ',
            'cost'                   => 'السعر',
            'cost_helper'            => ' ',
            'status'                 => 'الحالة',
            'status_helper'          => ' ',
            'client'                 => 'العميل',
            'client_helper'          => ' ',
            'government'             => 'الجهة الحكومية',
            'government_helper'      => ' ',
        ],
    ],
    'eventManagment' => [
        'title'          => 'أدارة الفعاليات',
        'title_singular' => 'أدارة الفعاليات',
    ],
    'brand' => [
        'title'          => 'الأقسام الداخلية',
        'title_singular' => 'قسم داخلي',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'الأسم',
            'title_helper'       => ' ',
            'description'        => 'الوصف',
            'description_helper' => ' ',
            'photo'              => 'صورة',
            'photo_helper'       => ' ',
            'event'              => 'فعالية',
            'event_helper'       => ' ',
            'zone_name'          => 'أسم المنطقة',
            'zone_name_helper'   => 'مثال منطقة A أو B',
            'latitude'               => 'خط العرض',
            'latitude_helper'        => ' ',
            'longitude'              => 'خط الطول',
            'longitude_helper'       => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'gate' => [
        'title'          => 'البوابات',
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
        'title'          => 'المشتركين',
        'title_singular' => 'مشترك',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'user'              => 'User',
            'user_helper'       => ' ',
            'national'          => 'رقم الهوية الوطنية',
            'national_helper'   => ' ',
            'events'            => 'الفعاليات',
            'events_helper'     => ' ',
            'brands'            => 'الأقسام الداخلية',
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
        'title'          => 'أفراد العائلة',
        'title_singular' => 'فرد عائلة',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'visitor'           => 'المشترك',
            'visitor_helper'    => ' ',
            'name'              => 'الأسم',
            'name_helper'       => ' ',
            'gender'            => 'النوع',
            'gender_helper'     => ' ',
            'relation'          => 'صلة القرابة',
            'relation_helper'   => ' ',
            'phone'             => 'رقم الجوال',
            'phone_helper'      => ' ',
            'identity'          => 'رقم الهوية',
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
        'title'          => 'الأعدادات',
        'title_singular' => 'Setting',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'address'                   => 'العنوان',
            'address_helper'            => ' ',
            'phone_1'                   => 'الجوال 1',
            'phone_1_helper'            => ' ',
            'phone_2'                   => 'الجوال 2',
            'phone_2_helper'            => ' ',
            'email_1'                   => 'البريد الألكتروني 1',
            'email_1_helper'            => ' ',
            'email_2'                   => 'البريد الألكتروني 2',
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
            'latitude'                  => 'خط العرض',
            'latitude_helper'           => ' ',
            'longitude'                 => 'خط الطول',
            'longitude_helper'          => ' ',
            'home_text_1'               => 'نص 1 للصفحة الرئيسية',
            'home_text_1_helper'        => ' ',
            'home_text_2'               => 'نص 2 للصفحة الرئيسية',
            'home_text_2_helper'        => ' ',
            'about_us'                  => 'عن تنظيم',
            'about_us_helper'           => ' ',
            'caders_text'               => 'نص الكوادر',
            'caders_text_helper'        => ' ',
            'events_text'               => 'نص الفعاليات',
            'events_text_helper'        => ' ',
            'news_text'                 => 'نص الأخبار',
            'news_text_helper'          => ' ',
            'how_we_work_header'        => 'نص كيف نعمل',
            'how_we_work_header_helper' => ' ',
            'how_we_work_1'             => '1 نص كيف نعمل',
            'how_we_work_1_helper'      => ' ',
            'how_we_work_2'             => 'نص كيف نعمل 2',
            'how_we_work_2_helper'      => ' ',
            'how_we_work_3'             => 'نص كيف نعمل 3',
            'how_we_work_3_helper'      => ' ',
            'said_about_tanzem'         => 'نص قالو عن تنظيم',
            'said_about_tanzem_helper'  => ' ',
            'organizers_text'           => 'نص منظمي الفعاليات',
            'organizers_text_helper'    => ' ',
            'contact_us_text'           => 'نص تواصل معنا',
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
        'title'          => 'قالو عن تنظيم',
        'title_singular' => 'قالو عن تنظيم',
        'fields'         => [
            'id'                  => 'ID',
            'id_helper'           => ' ',
            'name'                => 'الأسم',
            'name_helper'         => ' ',
            'job_position'        => 'المسمي الوظيفي',
            'job_position_helper' => ' ',
            'photo'               => 'صورة',
            'photo_helper'        => ' ',
            'text_1'              => 'العنوان',
            'text_1_helper'       => ' ',
            'text_2'              => 'الوصف',
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
        'title'          => 'تواصل معنا',
        'title_singular' => 'تواصل معنا',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'الأسم',
            'name_helper'       => ' ',
            'email'             => 'البريد الألكتروني',
            'email_helper'      => ' ',
            'phone'             => 'الجوال',
            'phone_helper'      => ' ',
            'title'             => 'الموضوع',
            'title_helper'      => ' ',
            'message'           => 'الرسالة',
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
        'title'          => 'الأخبار',
        'title_singular' => 'خبر',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'title'                    => 'عنوان الخبر',
            'title_helper'             => ' ',
            'short_description'        => 'وصف مختصر',
            'short_description_helper' => ' ',
            'long_description'         => 'الوصف',
            'long_description_helper'  => ' ',
            'photo'                    => 'الصورة',
            'photo_helper'             => ' ',
            'user'                     => 'عن طريق',
            'user_helper'              => ' ',
            'status'                   => 'الحالة',
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
        'title'          => 'الأشتراكات',
        'title_singular' => 'اشتراك',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'email'             => 'البريد الألكتروني',
            'email_helper'      => ' ',
            'created_at'        => 'نم الأضافة في',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'importantLink' => [
        'title'          => 'روابط تهمك',
        'title_singular' => 'رابط',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'text'              => 'النص',
            'text_helper'       => ' ',
            'link'              => 'الرابط',
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
        'title'          => 'أنواع الأذونات',
        'title_singular' => 'أذن أنصراف',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'النوع',
            'name_helper'       => ' ',
            'time'              => 'الوقت المسموح',
            'time_helper'       => 'بالدقائق',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'cawaderSpecialization' => [
        'title'          => 'تخصصات الكوادر',
        'title_singular' => 'تخصص كادر',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name_ar'           => 'الأسم باللغة العربية',
            'name_ar_helper'    => ' ',
            'name_en'           => 'الأسم باللغة الانجليزية',
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
