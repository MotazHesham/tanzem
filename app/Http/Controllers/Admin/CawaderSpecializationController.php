<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCawaderSpecializationRequest;
use App\Http\Requests\StoreCawaderSpecializationRequest;
use App\Http\Requests\UpdateCawaderSpecializationRequest;
use App\Models\CawaderSpecialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CawaderSpecializationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('cawader_specialization_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawaderSpecializations = CawaderSpecialization::all();

        return view('admin.cawaderSpecializations.index', compact('cawaderSpecializations'));
    }

    public function create()
    {
        abort_if(Gate::denies('cawader_specialization_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cawaderSpecializations.create');
    }

    public function store(StoreCawaderSpecializationRequest $request)
    {
        $cawaderSpecialization = CawaderSpecialization::create($request->all());

        return redirect()->route('admin.cawader-specializations.index');
    }

    public function edit(CawaderSpecialization $cawaderSpecialization)
    {
        abort_if(Gate::denies('cawader_specialization_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cawaderSpecializations.edit', compact('cawaderSpecialization'));
    }

    public function update(UpdateCawaderSpecializationRequest $request, CawaderSpecialization $cawaderSpecialization)
    {
        $cawaderSpecialization->update($request->all());

        return redirect()->route('admin.cawader-specializations.index');
    }

    public function show(CawaderSpecialization $cawaderSpecialization)
    {
        abort_if(Gate::denies('cawader_specialization_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.cawaderSpecializations.show', compact('cawaderSpecialization'));
    }

    public function destroy(CawaderSpecialization $cawaderSpecialization)
    {
        abort_if(Gate::denies('cawader_specialization_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawaderSpecialization->delete();

        return back();
    }

    public function massDestroy(MassDestroyCawaderSpecializationRequest $request)
    {
        CawaderSpecialization::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}