<?php

namespace App\Http\Controllers\Admin;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController
{ 
        
    public $sources = [
        [
            'model'      => '\App\Models\Event',
            'start_date_field' => 'start_date',
            'end_date_field' => 'end_date',
            'field'      => 'title',
            'prefix'     => '',
            'suffix'     => '',
            'route'      => 'admin.events.edit',
        ],
    ];

    public function index()
    {

        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::all() as $model) {
                $crudFieldValue = $model->getAttributes()[$source['start_date_field']];
                $crudFieldValue2 = $model->getAttributes()[$source['end_date_field']];

                if (!$crudFieldValue) {
                    continue;
                }

                if (!$crudFieldValue2) {
                    continue;
                }

                $events[] = [
                    'title' => trim($source['prefix'] . ' ' . $model->{$source['field']} . ' ' . $source['suffix']),
                    'start' => $crudFieldValue,
                    'end' => $crudFieldValue2,
                    'url'   => route($source['route'], $model->id),
                ];
            }
        }

        $settings1 = [
            'chart_title'           => trans('global.dashboard_widgets.Events'),
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Event',
            'group_by_field'        => 'start_date',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'event',
        ];

        $settings1['total_number'] = 0;
        if (class_exists($settings1['model'])) {
            $settings1['total_number'] = $settings1['model']::when(isset($settings1['filter_field']), function ($query) use ($settings1) {
                if (isset($settings1['filter_days'])) {
                    return $query->where($settings1['filter_field'], '>=',
                now()->subDays($settings1['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings1['filter_period'])) {
                    switch ($settings1['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings1['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings1['aggregate_function'] ?? 'count'}($settings1['aggregate_field'] ?? '*');
        }

        $settings2 = [
            'chart_title'           => trans('global.dashboard_widgets.Cawader'),
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Cawader',
            'group_by_field'        => 'dob',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'cawader',
        ];

        $settings2['total_number'] = 0;
        if (class_exists($settings2['model'])) {
            $settings2['total_number'] = $settings2['model']::when(isset($settings2['filter_field']), function ($query) use ($settings2) {
                if (isset($settings2['filter_days'])) {
                    return $query->where($settings2['filter_field'], '>=',
                now()->subDays($settings2['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings2['filter_period'])) {
                    switch ($settings2['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings2['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings2['aggregate_function'] ?? 'count'}($settings2['aggregate_field'] ?? '*');
        }

        $settings3 = [
            'chart_title'           => trans('global.dashboard_widgets.Vistors'),
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Visitor',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'visitor',
        ];

        $settings3['total_number'] = 0;
        if (class_exists($settings3['model'])) {
            $settings3['total_number'] = $settings3['model']::when(isset($settings3['filter_field']), function ($query) use ($settings3) {
                if (isset($settings3['filter_days'])) {
                    return $query->where($settings3['filter_field'], '>=',
                now()->subDays($settings3['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings3['filter_period'])) {
                    switch ($settings3['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings3['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings3['aggregate_function'] ?? 'count'}($settings3['aggregate_field'] ?? '*');
        }

        $settings4 = [
            'chart_title'           => trans('global.dashboard_widgets.News'),
            'chart_type'            => 'number_block',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\News',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-3',
            'entries_number'        => '5',
            'translation_key'       => 'news',
        ];

        $settings4['total_number'] = 0;
        if (class_exists($settings4['model'])) {
            $settings4['total_number'] = $settings4['model']::when(isset($settings4['filter_field']), function ($query) use ($settings4) {
                if (isset($settings4['filter_days'])) {
                    return $query->where($settings4['filter_field'], '>=',
                now()->subDays($settings4['filter_days'])->format('Y-m-d'));
                }
                if (isset($settings4['filter_period'])) {
                    switch ($settings4['filter_period']) {
                case 'week': $start = date('Y-m-d', strtotime('last Monday')); break;
                case 'month': $start = date('Y-m') . '-01'; break;
                case 'year': $start = date('Y') . '-01-01'; break;
            }
                    if (isset($start)) {
                        return $query->where($settings4['filter_field'], '>=', $start);
                    }
                }
            })
                ->{$settings4['aggregate_function'] ?? 'count'}($settings4['aggregate_field'] ?? '*');
        }

        $settings5 = [
            'chart_title'           => trans('global.dashboard_widgets.Clients'),
            'chart_type'            => 'pie',
            'report_type'           => 'group_by_string',
            'model'                 => 'App\Models\User',
            'group_by_field'        => 'user_type',
            'aggregate_function'    => 'count',
            'where_raw'             => 'user_type IN ( "client" , "companiesAndInstitution" , "governmental_entity") ',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-5 mt-5',
            'entries_number'        => '5',
            'translation_key'       => 'client',
        ];

        $chart5 = new LaravelChart($settings5);

        $settings7 = [
            'chart_title'           => trans('global.dashboard_widgets.Governmental'),
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\GovernmentalEntity',
            'group_by_field'        => 'created_at',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y H:i:s',
            'column_class'          => 'col-md-4 mt-5',
            'entries_number'        => '5',
            'fields'                => [
                'id'         => '',
                'user'       => 'name',
                'created_at' => '',
            ],
            'translation_key' => 'governmentalEntity',
        ];

        $settings7['data'] = [];
        if (class_exists($settings7['model'])) {
            $settings7['data'] = $settings7['model']::latest()
                ->take($settings7['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings7)) {
            $settings7['fields'] = [];
        }

        $settings8 = [
            'chart_title'           => trans('global.dashboard_widgets.Latest Clients'),
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\Client',
            'group_by_field'        => 'commerical_expiry',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4 mt-5',
            'entries_number'        => '5',
            'fields'                => [
                'id'         => '',
                'user'       => 'name',
                'created_at' => '',
            ],
            'translation_key' => 'client',
        ];

        $settings8['data'] = [];
        if (class_exists($settings8['model'])) {
            $settings8['data'] = $settings8['model']::latest()
                ->take($settings8['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings8)) {
            $settings8['fields'] = [];
        }

        $settings9 = [
            'chart_title'           => trans('global.dashboard_widgets.Latest Companies'),
            'chart_type'            => 'latest_entries',
            'report_type'           => 'group_by_date',
            'model'                 => 'App\Models\CompaniesAndInstitution',
            'group_by_field'        => 'commerical_expiry',
            'group_by_period'       => 'day',
            'aggregate_function'    => 'count',
            'filter_field'          => 'created_at',
            'group_by_field_format' => 'd/m/Y',
            'column_class'          => 'col-md-4 mt-5',
            'entries_number'        => '5',
            'fields'                => [
                'id'         => '',
                'user'       => 'name',
                'city'       => 'name_ar',
                'created_at' => '',
            ],
            'translation_key' => 'companiesAndInstitution',
        ];

        $settings9['data'] = [];
        if (class_exists($settings9['model'])) {
            $settings9['data'] = $settings9['model']::latest()
                ->take($settings9['entries_number'])
                ->get();
        }

        if (!array_key_exists('fields', $settings9)) {
            $settings9['fields'] = [];
        }

        return view('home', compact('settings1', 'settings2', 'settings3', 'settings4', 'chart5', 'settings7', 'settings8', 'settings9','events'));
    }
}
