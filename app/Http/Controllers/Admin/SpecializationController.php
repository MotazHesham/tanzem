<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroySpecializationRequest;
use App\Http\Requests\StoreSpecializationRequest;
use App\Http\Requests\UpdateSpecializationRequest;
use App\Models\Specialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class SpecializationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('specialization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specializations = Specialization::all();

        return view('admin.specializations.index', compact('specializations'));
    }

    public function create()
    {
        abort_if(Gate::denies('specialization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specializations.create');
    }

    public function store(StoreSpecializationRequest $request)
    {
        $specialization = Specialization::create($request->all());

        Alert::success('تم بنجاح', 'تم إضافة التخصص بنجاح ');
        return redirect()->route('admin.specializations.index');
    }

    public function edit(Specialization $specialization)
    {
        abort_if(Gate::denies('specialization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specializations.edit', compact('specialization'));
    }

    public function update(UpdateSpecializationRequest $request, Specialization $specialization)
    {
        $specialization->update($request->all());

        Alert::success('تم بنجاح', 'تم تعديل بيانات التخصص بنجاح ');
        return redirect()->route('admin.specializations.index');
    }

    public function show(Specialization $specialization)
    {
        abort_if(Gate::denies('specialization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.specializations.show', compact('specialization'));
    }

    public function destroy(Specialization $specialization)
    {
        abort_if(Gate::denies('specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specialization->delete();

        Alert::success('تم بنجاح', 'تم  حذف التخصص بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroySpecializationRequest $request)
    {
        Specialization::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
