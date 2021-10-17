<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyEventRequest;
use App\Http\Requests\StoreEventRequest;
use App\Http\Requests\UpdateEventRequest;
use App\Models\City;
use App\Models\CompaniesAndInstitution;
use App\Models\Event;
use App\Models\Gate;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class EventsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Event::with(['city', 'company', 'available_gates'])->select(sprintf('%s.*', (new Event())->table));
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

            $table->editColumn('start_time', function ($row) {
                return $row->start_time ? $row->start_time : '';
            });
            $table->editColumn('address', function ($row) {
                return $row->address ? $row->address : '';
            });
            $table->addColumn('company_commerical_num', function ($row) {
                return $row->company ? $row->company->commerical_num : '';
            });

            $table->editColumn('available_gates', function ($row) {
                $labels = [];
                foreach ($row->available_gates as $available_gate) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $available_gate->gate);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'company', 'available_gates']);

            return $table->make(true);
        }

        return view('admin.events.index');
    }

    public function create()
    {
        abort_if(Gate::denies('event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = CompaniesAndInstitution::pluck('commerical_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = Gate::pluck('gate', 'id');

        return view('admin.events.create', compact('cities', 'companies', 'available_gates'));
    }

    public function store(StoreEventRequest $request)
    {
        $event = Event::create($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
        if ($request->input('photo', false)) {
            $event->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $event->id]);
        }

        return redirect()->route('admin.events.index');
    }

    public function edit(Event $event)
    {
        abort_if(Gate::denies('event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companies = CompaniesAndInstitution::pluck('commerical_num', 'id')->prepend(trans('global.pleaseSelect'), '');

        $available_gates = Gate::pluck('gate', 'id');

        $event->load('city', 'company', 'available_gates');

        return view('admin.events.edit', compact('cities', 'companies', 'available_gates', 'event'));
    }

    public function update(UpdateEventRequest $request, Event $event)
    {
        $event->update($request->all());
        $event->available_gates()->sync($request->input('available_gates', []));
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

        return redirect()->route('admin.events.index');
    }

    public function show(Event $event)
    {
        abort_if(Gate::denies('event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->load('city', 'company', 'available_gates', 'eventBrands', 'eventsVisitors');

        return view('admin.events.show', compact('event'));
    }

    public function destroy(Event $event)
    {
        abort_if(Gate::denies('event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $event->delete();

        return back();
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
