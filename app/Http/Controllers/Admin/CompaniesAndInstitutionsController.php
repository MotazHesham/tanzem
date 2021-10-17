<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompaniesAndInstitutionRequest;
use App\Http\Requests\StoreCompaniesAndInstitutionRequest;
use App\Http\Requests\UpdateCompaniesAndInstitutionRequest;
use App\Models\CompaniesAndInstitution;
use App\Models\Specialization;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CompaniesAndInstitutionsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('companies_and_institution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitutions = CompaniesAndInstitution::with(['user', 'specializations'])->get();

        return view('admin.companiesAndInstitutions.index', compact('companiesAndInstitutions'));
    }

    public function create()
    {
        abort_if(Gate::denies('companies_and_institution_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name_ar', 'id');

        return view('admin.companiesAndInstitutions.create', compact('users', 'specializations'));
    }

    public function store(StoreCompaniesAndInstitutionRequest $request)
    {
        $companiesAndInstitution = CompaniesAndInstitution::create($request->all());
        $companiesAndInstitution->specializations()->sync($request->input('specializations', []));

        return redirect()->route('admin.companies-and-institutions.index');
    }

    public function edit(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name_ar', 'id');

        $companiesAndInstitution->load('user', 'specializations');

        return view('admin.companiesAndInstitutions.edit', compact('users', 'specializations', 'companiesAndInstitution'));
    }

    public function update(UpdateCompaniesAndInstitutionRequest $request, CompaniesAndInstitution $companiesAndInstitution)
    {
        $companiesAndInstitution->update($request->all());
        $companiesAndInstitution->specializations()->sync($request->input('specializations', []));

        return redirect()->route('admin.companies-and-institutions.index');
    }

    public function show(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitution->load('user', 'specializations', 'companyEvents');

        return view('admin.companiesAndInstitutions.show', compact('companiesAndInstitution'));
    }

    public function destroy(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitution->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompaniesAndInstitutionRequest $request)
    {
        CompaniesAndInstitution::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
