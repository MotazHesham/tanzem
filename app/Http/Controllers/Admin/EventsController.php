<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\Cawader;
use App\Models\City;
use App\Models\Client;
use App\Models\CompaniesAndInstitution;
use App\Models\Event;
use App\Models\EventBreak;
use App\Models\Gate as EventGate;
use App\Models\GovernmentalEntity;
use App\Models\Specialization;
use App\Models\Visitor;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function partials_supervisor(Request $request){  
        $event = Event::findOrFail($request->event_id); 
        foreach($request->cawaders as $cawader_id){
            $event->cawaders()->updateExistingPivot(
                $cawader_id , [ 
                    'supervisor_id' => $request->supervisor_id,  
                ]
            ); 
        }  
        Alert::success('تم التعديل بنجاح');
        return back();
    }
    public function partials_zoominmap(Request $request){
        $cader = Cawader::find($request->cader_id);

        $data = [
            'lat' => $cader->latitude,
            'lng' => $cader->longitude
        ];
        
        return response()->json($data);
    }
    public function partials_cader_break_status($id,$status){
        $event_break = EventBreak::findOrFail($id);
        $event_break->status = $status;
        $event_break->save();
        
        if($status == 'accepted'){
            Alert::success('تم قبول الأذن');
        }else{
            Alert::success('تم رفض الأذن');
        }

        return redirect()->route('admin.events.show',$event_break->event_id);
    }
    public function partials_attendance_cader(Request $request){
        $event = Event::findOrFail($request->event_id); 
        $attendance = $event->attendance()->wherePivot('cawader_id',$request->cader_id)->orderBy('pivot_created_at','asc')->get();   
        return view('admin.events.partials.attendance',compact('attendance','event'));
    }

    public function partials_cader_break(Request $request){
        $event_breaks = EventBreak::where('cawader_id',$request->cader_id)->where('event_id',$request->event_id)->get(); 
        return view('admin.events.partials.break',compact('event_breaks'));
    }

    public function changeStatus($id,$status){
        $event = Event::findOrFail($id);
        $event->status = $status;
        $event->save();

        if($status == 'active'){
            Alert::success('تم قبول الفعالية');
        }else{
            Alert::error('تم رفض الفعالية');
        }

        return redirect()->route('admin.events.index');
    }

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Event::with(['city', 'company.user', 'available_gates','specializations'])->select(sprintf('%s.*', (new Event())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'event_show';
                $editGate = 'event_edit';
                $deleteGate = 'event_delete';
                $crudRoutePart = 'events';

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
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            }); 
            $table->editColumn('date', function ($row) {
                $start = $row->start_date ? $row->start_date : '';
                $end = $row->end_date ? $row->end_date : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('time', function ($row) {
                $start = $row->start_time ? $row->start_time : '';
                $end = $row->end_time ? $row->end_time : '';
                return sprintf('<span class="badge bg-light text-dark">%s</span> <br> <span class="badge bg-secondary">%s</span>',$start,$end);
            });
            $table->editColumn('city', function ($row) {
                $name = 'name_'.app()->getLocale();
                return $row->city ? $row->city->$name : '';
            });
            $table->addColumn('company_user_name', function ($row) {
                return $row->company ? $row->company->user->name : '';
            });

            $table->editColumn('available_gates', function ($row) {
                $labels = [];
                foreach ($row->available_gates as $available_gate) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $available_gate->gate);
                }

                return implode(' ', $labels);
            });

            $table->editColumn('specializations', function ($row) {
                $labels = [];
                foreach ($row->specializations as $specialization) {
                    $labels[] = sprintf('<span class="badge badge-info label-many">%s</span>', $specialization->name_ar);
                }

                return implode(' ', $labels);
            });
            $table->editColumn('status', function ($row) {
                if($row->status == 'active'){
                    $event_status = 'success';
                }elseif($row->status == 'pending'){
                    $event_status = 'info';
                }elseif($row->status == 'closed'){
                    $event_status = 'warning';
                }elseif($row->status == 'refused'){
                    $event_status = 'danger';
                }else{
                    $event_status = 'dark';
                }
                return $row->status ? sprintf('<span class="badge badge-%s">%s</span>',$event_status,trans('global.events_status.'.$row->status)) : '';
            });
            $table->rawColumns(['actions', 'placeholder', 'company', 'date', 'time', 'status', 'available_gates','specializations']);

            return $table->make(true);
        }

        return view('admin.events.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = CompaniesAndInstitution::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = EventGate::pluck('gate', 'id');

        $specializations = Specialization::pluck('name_ar', 'id');

        $cawaders = Cawader::with('user')->where('companies_and_institution_id',null)->get(); 

        $clients = Client::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $governments = GovernmentalEntity::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.events.create', compact('cities', 'companies', 'available_gates','specializations','cawaders','clients','governments'));
    }

    public function store(StoreEventRequest $request)
    { 
        $data = $request->validated();
        $event = Event::create($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
        $event->specializations()->sync($request->input('specializations', [])); 
        $event->cawaders()->sync($data['cawaders']);
        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        Alert::success('تم بنجاح', 'تم إضافة الفعالية بنجاح ');
        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = CompaniesAndInstitution::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = EventGate::pluck('gate', 'id');

        $specializations = Specialization::pluck('name_ar', 'id'); 

        $clients = Client::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $governments = GovernmentalEntity::with('user')->get()->pluck('user.name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $event->load('city', 'company', 'specializations', 'cawaders', 'reviews', 'client', 'government', 'available_gates');

        $cawaders = Cawader::with('user')->where('companies_and_institution_id',null)->get()->map(function($cawader) use ($event) {
            $cawader->hours = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.hours') ?? null;
            $cawader->amount = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.amount') ?? null;
            $cawader->extra_hours = data_get($event->cawaders->firstWhere('id', $cawader->id), 'pivot.extra_hours') ?? null;
            return $cawader;
        });
        

        return view('admin.events.edit', compact('cities', 'companies', 'available_gates', 'event','specializations','cawaders','clients','governments'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $data = $request->validated();
        $event->update($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
        $event->specializations()->sync($request->input('specializations', []));
        $event->cawaders()->sync($data['cawaders']);
        if ($request->input('photo', false)) {
            if (!$event->photo || $request->input('photo') !== $event->photo->file_name) {
                if ($event->photo) {
                    $event->photo->delete();
                }
                $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($event->photo) {
            $event->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل بيانات الفعالية بنجاح ');
        return redirect()->route('admin.events.index');
    } 

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('city', 'company', 'available_gates', 'specializations', 'cawaders', 'reviews', 'client', 'government', 'eventBrands', 'eventsVisitors');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        Alert::success('تم بنجاح', 'تم  حذف الفعالية بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyEventRequest $request)
    {
        Event::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('event_create') && Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Event();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
