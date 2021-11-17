<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVisitorRequest;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Brand;
use App\Models\Event;
use App\Models\User;
use App\Models\Visitor;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Spatie\MediaLibrary\Models\Media; 
use Alert;

class VisitorsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('visitor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Visitor::with(['user', 'events', 'brands'])->select(sprintf('%s.*', (new Visitor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'visitor_show';
                $editGate = 'visitor_edit';
                $deleteGate = 'visitor_delete';
                $crudRoutePart = 'visitors';

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

        return view('admin.visitors.index');
    }

    public function create()
    {
        abort_if(Gate::denies('visitor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id');

        $brands = Brand::pluck('title', 'id');

        return view('admin.visitors.create', compact('users', 'events', 'brands'));
    }

    public function store(StoreVisitorRequest $request)
    { 

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'visitor', 
            'phone' => $request->phone,  
        ]);


        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $visitor = Visitor::create([
            'user_id' => $user->id,
            'national' => $request->national
        ]);

        Alert::success('تم بنجاح', 'تم إضافة المشترك بنجاح ');
        return redirect()->route('admin.visitors.index');
    }

    public function edit(Visitor $visitor)
    {
        abort_if(Gate::denies('visitor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id');

        $brands = Brand::pluck('title', 'id');

        $visitor->load('user', 'events', 'brands');

        return view('admin.visitors.edit', compact('users', 'events', 'brands', 'visitor'));
    }

    public function update(UpdateVisitorRequest $request, Visitor $visitor)
    {
        $user = User::find($visitor->user_id);

        $visitor->update([
            'national' => $request->national
        ]);

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

        Alert::success('تم بنجاح', 'تم تعديل بيانات المشترك بنجاح ');
        return redirect()->route('admin.visitors.index');
    }

    public function show(Visitor $visitor)
    {
        abort_if(Gate::denies('visitor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitor->load('user', 'events', 'brands', 'visitorVisitorsFamilies');

        return view('admin.visitors.show', compact('visitor'));
    }

    public function destroy(Visitor $visitor)
    {
        abort_if(Gate::denies('visitor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $visitor->delete();

        Alert::success('تم بنجاح', 'تم  حذف المشترك بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyVisitorRequest $request)
    {
        Visitor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
