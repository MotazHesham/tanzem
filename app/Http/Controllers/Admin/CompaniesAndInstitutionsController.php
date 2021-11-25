<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompaniesAndInstitutionRequest;
use App\Http\Requests\StoreCompaniesAndInstitutionRequest;
use App\Http\Requests\UpdateCompaniesAndInstitutionRequest;
use App\Models\CompaniesAndInstitution;
use App\Models\Specialization;
use App\Models\User;
use App\Models\City;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Alert;

class CompaniesAndInstitutionsController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('companies_and_institution_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitutions = CompaniesAndInstitution::with(['user', 'specializations'])->get();

        return view('admin.companiesAndInstitutions.index', compact('companiesAndInstitutions'));
    }

    public function create()
    {
        abort_if(Gate::denies('companies_and_institution_create'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $specializations = Specialization::pluck('name_ar', 'id');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.companiesAndInstitutions.create', compact('specializations','cities'));
    }

    public function store(StoreCompaniesAndInstitutionRequest $request)
    { 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'companiesAndInstitution', 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $companiesAndInstitution = CompaniesAndInstitution::create([
            'user_id' => $user->id,
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
            'about_company' => $request->about_company, 
            'facebook' => $request->facebook, 
            'gmail' => $request->gmail, 
            'linked' => $request->linked, 
            'instagram' => $request->instagram, 
            'twitter' => $request->twitter, 
            'city_id' => $request->city_id, 
        ]);

        $companiesAndInstitution->specializations()->sync($request->input('specializations', []));

        foreach ($request->input('galery', []) as $file) {
            $companiesAndInstitution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('galery');
        }

        foreach ($request->input('videos', []) as $file) {
            $companiesAndInstitution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('videos');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $companiesAndInstitution->id]);
        }


        Alert::success('تم بنجاح', 'تم إضافة الشركة بنجاح ');
        return redirect()->route('admin.companies-and-institutions.index');
    }

    public function edit(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $specializations = Specialization::pluck('name_ar', 'id');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companiesAndInstitution->load('user', 'specializations','city');

        return view('admin.companiesAndInstitutions.edit', compact('specializations', 'companiesAndInstitution','cities'));
    }

    public function update(UpdateCompaniesAndInstitutionRequest $request, CompaniesAndInstitution $companiesAndInstitution)
    { 
        $companiesAndInstitution->update([ 
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
            'about_company' => $request->about_company, 
            'facebook' => $request->facebook, 
            'gmail' => $request->gmail, 
            'linked' => $request->linked, 
            'instagram' => $request->instagram, 
            'twitter' => $request->twitter, 
            'city_id' => $request->city_id, 
        ]);

        if (count($companiesAndInstitution->galery) > 0) {
            foreach ($companiesAndInstitution->galery as $media) {
                if (!in_array($media->file_name, $request->input('galery', []))) {
                    $media->delete();
                }
            }
        }
        $media = $companiesAndInstitution->galery->pluck('file_name')->toArray();
        foreach ($request->input('galery', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $companiesAndInstitution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('galery');
            }
        }

        if (count($companiesAndInstitution->videos) > 0) {
            foreach ($companiesAndInstitution->videos as $media) {
                if (!in_array($media->file_name, $request->input('videos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $companiesAndInstitution->videos->pluck('file_name')->toArray();
        foreach ($request->input('videos', []) as $file) {
            if (count($media) === 0 || !in_array($file, $media)) {
                $companiesAndInstitution->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('videos');
            }
        }

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        $companiesAndInstitution->specializations()->sync($request->input('specializations', []));
        
        if ($request->input('photo', false)) {
            if (!$user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل بيانات الشركة بنجاح ');
        return redirect()->route('admin.companies-and-institutions.index');
    }

    public function show(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitution->load('user', 'specializations');

        return view('admin.companiesAndInstitutions.show', compact('companiesAndInstitution'));
    }

    public function destroy(CompaniesAndInstitution $companiesAndInstitution)
    {
        abort_if(Gate::denies('companies_and_institution_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companiesAndInstitution->delete();

        Alert::success('تم بنجاح', 'تم  حذف الشركة بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyCompaniesAndInstitutionRequest $request)
    {
        CompaniesAndInstitution::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('companies_and_institution_create') && Gate::denies('companies_and_institution_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new CompaniesAndInstitution();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
