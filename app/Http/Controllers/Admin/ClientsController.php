<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyClientRequest;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use App\Models\Specialization;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Client::with(['specializations', 'user'])->select(sprintf('%s.*', (new Client())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'client_show';
                $editGate = 'client_edit';
                $deleteGate = 'client_delete';
                $crudRoutePart = 'clients';

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

            $table->editColumn('specialization', function ($row) {
                $labels = [];
                foreach ($row->specializations as $specialization) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $specialization->name_ar);
                }

                return implode(' ', $labels);
            }); 

            $table->rawColumns(['actions', 'placeholder', 'specialization', 'user']);

            return $table->make(true);
        }

        return view('admin.clients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specializations = Specialization::pluck('name_ar', 'id'); 

        return view('admin.clients.create', compact('specializations'));
    }

    public function store(StoreClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'client', 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        $client = Client::create([
            'user_id' => $user->id,
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
        ]);

        $client->specializations()->sync($request->input('specializations', []));

        Alert::success('تم بنجاح', 'تم إضافة العميل بنجاح ');
        return redirect()->route('admin.clients.index');
    }

    public function edit(Client $client)
    {
        abort_if(Gate::denies('client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $specializations = Specialization::pluck('name_ar', 'id'); 

        $client->load('specializations', 'user');

        return view('admin.clients.edit', compact('specializations', 'client'));
    }

    public function update(UpdateClientRequest $request, Client $client)
    { 
        $client->update([ 
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
        ]);

        $user = User::find($request->user_id);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password == null ? $user->password : bcrypt($request->password), 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        $client->specializations()->sync($request->input('specializations', []));

        Alert::success('تم بنجاح', 'تم تعديل بيانات العميل بنجاح ');
        return redirect()->route('admin.clients.index');
    }

    public function show(Client $client)
    {
        abort_if(Gate::denies('client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->load('specializations', 'user');

        return view('admin.clients.show', compact('client'));
    }

    public function destroy(Client $client)
    {
        abort_if(Gate::denies('client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $client->delete();

        Alert::success('تم بنجاح', 'تم  حذف العميل بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyClientRequest $request)
    {
        Client::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
