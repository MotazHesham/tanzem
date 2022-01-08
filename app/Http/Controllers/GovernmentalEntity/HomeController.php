<?php

namespace App\Http\Controllers\GovernmentalEntity;

use LaravelDaily\LaravelCharts\Classes\LaravelChart; 
use App\Models\GovernmentalEntity;
use App\Models\Event;
use App\Models\News;
use Auth;

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
            'route'      => 'government.events.edit',
        ],
    ];
    public function index()
    {
        $government = GovernmentalEntity::where('user_id',Auth::id())->first(); 

        $settings1 = [
            'chart_title'           => trans('global.dashboard_widgets.Events'), 
            'total_number'          => Event::where('government_id',$government->id)->count(), 
        ];
        $settings2 = [
            'chart_title'           => trans('global.dashboard_widgets.News'), 
            'total_number'          => News::where('user_id',Auth::id())->count(), 
        ];

        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::where('government_id',$government->id)->get() as $model) {
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
        return view('government.home', compact('events','settings1','settings2'));
    }

}