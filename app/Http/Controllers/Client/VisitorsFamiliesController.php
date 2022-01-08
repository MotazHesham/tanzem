<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVisitorsFamilyRequest;
use App\Http\Requests\StoreVisitorsFamilyRequest;
use App\Http\Requests\UpdateVisitorsFamilyRequest;
use App\Models\Visitor;
use App\Models\VisitorsFamily;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class VisitorsFamiliesController extends Controller
{
    public function index()
    { 

        $visitorsFamilies = VisitorsFamily::with(['visitor'])->get();

        //return view('admin.visitorsFamilies.index', compact('visitorsFamilies'));
    }

    public function create()
    { 

        $visitors = Visitor::pluck('national', 'id')->prepend(trans('global.pleaseSelect'), '');

        //return view('admin.visitorsFamilies.create', compact('visitors'));
    }

    public function store(StoreVisitorsFamilyRequest $request)
    {
        $visitorsFamily = VisitorsFamily::create($request->all());

        Alert::success('تم بنجاح', 'تم إضافة فرد العائلة بنجاح ');
        return redirect()->route('client.visitors.show',$visitorsFamily->visitor_id);
    }

    public function edit(VisitorsFamily $visitorsFamily)
    { 

        $visitors = Visitor::pluck('national', 'id')->prepend(trans('global.pleaseSelect'), '');

        $visitorsFamily->load('visitor');

        return view('client.visitorsFamilies.edit', compact('visitors', 'visitorsFamily'));
    }

    public function update(UpdateVisitorsFamilyRequest $request, VisitorsFamily $visitorsFamily)
    {
        $visitorsFamily->update($request->all());

        Alert::success('تم بنجاح', 'تم تعديل بيانات فرد العائلة بنجاح ');
        return redirect()->route('client.visitors.show',$visitorsFamily->visitor_id);
    }

    public function destroy(VisitorsFamily $visitorsFamily)
    {
        abort_if(Gate::denies('visitors_family_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitorsFamily->delete();

        Alert::success('تم بنجاح', 'تم  حذف فرد العائلة بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyVisitorsFamilyRequest $request)
    {
        VisitorsFamily::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
