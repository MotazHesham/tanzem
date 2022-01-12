<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCawaderRequest;
use App\Http\Requests\StoreCawaderRequest;
use App\Http\Requests\UpdateCawaderRequest;
use App\Models\Cawader;
use App\Models\City;
use App\Models\CompaniesAndInstitution;
use App\Models\CawaderSpecialization;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Spatie\MediaLibrary\Models\Media;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class CawaderController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cawader_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Cawader::with(['city', 'specializations', 'user', 'companies_and_institution'])->select(sprintf('%s.*', (new Cawader())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'cawader_show';
                $editGate = 'cawader_edit';
                $deleteGate = 'cawader_delete';
                $crudRoutePart = 'cawaders';

                return view('partials.datatablesActions', compact(
                'viewGate',
                'editGate',
                'deleteGate',
                'crudRoutePart',
                'row'
            ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('specialization', function ($row) {
                $labels = [];
                foreach ($row->specializations as $specialization) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $specialization->name_ar);
                }

                return implode(' ', $labels);
            });
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->addColumn('user_phone', function ($row) {
                return $row->user ? $row->user->phone : '';
            });

            $table->addColumn('companies_and_institution_user_name', function ($row) {
                return $row->companies_and_institution ? $row->companies_and_institution->user->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'specialization', 'user', 'companies_and_institution']);

            return $table->make(true);
        }

        return view('admin.cawaders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cawader_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = CawaderSpecialization::pluck('name_ar', 'id'); 

        $companies_and_institutions = CompaniesAndInstitution::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.cawaders.create', compact('cities', 'specializations', 'companies_and_institutions'));
    }

    public function store(StoreCawaderRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'cader', 
            'phone' => $request->phone,  
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $cawader = Cawader::create([
            'user_id' => $user->id,
            'dob' => $request->dob,
            'city_id' => $request->city_id,
            'degree' => $request->degree,
            'desceiption' => $request->desceiption,
            'working_hours' => $request->working_hours,
            'identity_number' => $request->identity_number,
            'companies_and_institution_id' => $request->companies_and_institution_id,
        ]);

        $cawader->specializations()->sync($request->input('specializations', []));

        Alert::success('تم بنجاح', 'تم إضافة الكادر بنجاح ');
        return redirect()->route('admin.cawaders.index');
    }

    public function edit(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = CawaderSpecialization::pluck('name_ar', 'id'); 

        $companies_and_institutions = CompaniesAndInstitution::with('user')->get()->pluck('user.email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $cawader->load('city', 'specializations', 'user', 'companies_and_institution');

        return view('admin.cawaders.edit', compact('cities', 'specializations', 'companies_and_institutions', 'cawader'));
    }

    public function update(UpdateCawaderRequest $request, Cawader $cawader)
    { 
        $cawader->update([ 
            'dob' => $request->dob,
            'desceiption' => $request->desceiption,
            'city_id' => $request->city_id,
            'degree' => $request->degree,
            'working_hours' => $request->working_hours,
            'identity_number' => $request->identity_number,
            'companies_and_institution_id' => $request->companies_and_institution_id,
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone,  
        ]);
        
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

        $cawader->specializations()->sync($request->input('specializations', []));

        Alert::success('تم بنجاح', 'تم تعديل بيانات الكادر بنجاح ');
        return redirect()->route('admin.cawaders.index');
    }

    public function show(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawader->load('city', 'specializations', 'user', 'companies_and_institution');

        return view('admin.cawaders.show', compact('cawader'));
    }

    public function destroy(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawader->delete();

        Alert::success('تم بنجاح', 'تم  حذف الكادر بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyCawaderRequest $request)
    {
        Cawader::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}