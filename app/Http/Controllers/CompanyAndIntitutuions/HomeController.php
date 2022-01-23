<?php

namespace App\Http\Controllers\CompanyAndIntitutuions;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;
use App\Models\CompaniesAndInstitution;
use App\Models\Event;
use App\Models\News;
use App\Models\Cawader;
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
            'route'      => 'client.events.edit',
        ],
    ];
    public function index()
    {
        if(Auth::user()->user_type == 'cader'){
            $cawader = Cawader::where('user_id',Auth::id())->first(); 
            $company = CompaniesAndInstitution::findOrFail($cawader->companies_and_institution_id); 
        }else{
            $company = CompaniesAndInstitution::where('user_id',Auth::id())->first(); 
        }

        $settings1 = [
            'chart_title'           => trans('global.dashboard_widgets.Events'), 
            'total_number'          => Event::where('company_id',$company->id)->count(), 
        ];
        $settings2 = [
            'chart_title'           => trans('global.dashboard_widgets.News'), 
            'total_number'          => News::where('user_id',Auth::id())->count(), 
        ];
        $settings3 = [
            'chart_title'           => trans('global.dashboard_widgets.Cawader'), 
            'total_number'          => Cawader::where('companies_and_institution_id',$company->id)->count(), 
        ];

        $events = [];
        foreach ($this->sources as $source) {
            foreach ($source['model']::where('company_id',$company->id)->get() as $model) {
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
        return view('company.home', compact('events','settings1','settings2','settings3'));
    }
}
