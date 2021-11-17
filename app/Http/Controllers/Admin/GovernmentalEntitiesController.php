<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGovernmentalEntityRequest;
use App\Http\Requests\StoreGovernmentalEntityRequest;
use App\Http\Requests\UpdateGovernmentalEntityRequest;
use App\Models\GovernmentalEntity;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class GovernmentalEntitiesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('governmental_entity_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = GovernmentalEntity::with(['user'])->select(sprintf('%s.*', (new GovernmentalEntity())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'governmental_entity_show';
                $editGate = 'governmental_entity_edit';
                $deleteGate = 'governmental_entity_delete';
                $crudRoutePart = 'governmental-entities';

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
            $table->addColumn('user_email', function ($row) {
                return $row->user ? $row->user->email : '';
            });
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
            });
            $table->addColumn('user_phone', function ($row) {
                return $row->user ? $row->user->phone : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user']);

            return $table->make(true);
        }

        return view('admin.governmentalEntities.index');
    }

    public function create()
    {
        abort_if(Gate::denies('governmental_entity_create'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        return view('admin.governmentalEntities.create');
    }

    public function store(StoreGovernmentalEntityRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'governmental_entity', 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        $governmentalEntity = GovernmentalEntity::create([
            'user_id' => $user->id
        ]);

        Alert::success('تم بنجاح', 'تم إضافة الجهة الحكومية بنجاح ');
        return redirect()->route('admin.governmental-entities.index');
    }

    public function edit(GovernmentalEntity $governmentalEntity)
    {
        abort_if(Gate::denies('governmental_entity_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden'); 

        $governmentalEntity->load('user');

        return view('admin.governmentalEntities.edit', compact('governmentalEntity'));
    }

    public function update(UpdateGovernmentalEntityRequest $request, GovernmentalEntity $governmentalEntity)
    { 
        $user = User::find($governmentalEntity->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        Alert::success('تم بنجاح', 'تم تعديل بيانات الجهة الحكومية بنجاح ');
        return redirect()->route('admin.governmental-entities.index');
    }

    public function show(GovernmentalEntity $governmentalEntity)
    {
        abort_if(Gate::denies('governmental_entity_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentalEntity->load('user');

        return view('admin.governmentalEntities.show', compact('governmentalEntity'));
    }

    public function destroy(GovernmentalEntity $governmentalEntity)
    {
        abort_if(Gate::denies('governmental_entity_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $governmentalEntity->delete();

        Alert::success('تم بنجاح', 'تم  حذف الجهة الحكومية بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyGovernmentalEntityRequest $request)
    {
        GovernmentalEntity::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
