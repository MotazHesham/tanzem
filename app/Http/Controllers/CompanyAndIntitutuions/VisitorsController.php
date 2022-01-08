<?php

namespace App\Http\Controllers\CompanyAndIntitutuions;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyVisitorRequest;
use App\Http\Requests\StoreVisitorRequest;
use App\Http\Requests\UpdateVisitorRequest;
use App\Models\Brand;
use App\Models\Event;
use App\Models\User;
use App\Models\Visitor;
use App\Models\CompaniesAndInstitution;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Spatie\MediaLibrary\Models\Media; 
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Alert;
use Auth;

class VisitorsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    { 

        if ($request->ajax()) {
            $company = CompaniesAndInstitution::where('user_id',Auth::id())->first();
            $company_id = $company->id;

            $query = Visitor::with(['user', 'brands'])
                            ->whereHas('events', function ($query) use ($company_id){
                                $query->where('company_id', $company_id);})
                            ->select(sprintf('%s.*', (new Visitor())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) { 
                $crudRoutePart = 'company.visitors';

                return view('partials.datatablesActions_noAuth', compact( 
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

        return view('company.visitors.index');
    }

    public function create()
    { 

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id');

        $brands = Brand::pluck('title', 'id');

        return view('company.visitors.create', compact('users', 'events', 'brands'));
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
        return redirect()->route('company.visitors.index');
    }

    public function edit(Visitor $visitor)
    { 

        $users = User::pluck('email', 'id')->prepend(trans('global.pleaseSelect'), '');

        $events = Event::pluck('title', 'id');

        $brands = Brand::pluck('title', 'id');

        $visitor->load('user', 'events', 'brands');

        return view('company.visitors.edit', compact('users', 'events', 'brands', 'visitor'));
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
        return redirect()->route('company.visitors.index');
    }

    public function show(Visitor $visitor)
    { 

        $visitor->load('user', 'events', 'brands', 'visitorVisitorsFamilies');

        return view('company.visitors.show', compact('visitor'));
    }

    public function destroy(Visitor $visitor)
    { 

        $visitor->delete();

        Alert::success('تم بنجاح', 'تم  حذف المشترك بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyVisitorRequest $request)
    {
        Visitor::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    { 

        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
