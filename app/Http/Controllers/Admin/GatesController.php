<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyGateRequest;
use App\Http\Requests\StoreGateRequest;
use App\Http\Requests\UpdateGateRequest;
use App\Models\Event;
use App\Models\Gate;
use Gate as PermissionGate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class GatesController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(PermissionGate::denies('gate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gates = Gate::with(['event', 'media'])->get();

        return view('admin.gates.index', compact('gates'));
    }

    public function create()
    {
        abort_if(PermissionGate::denies('gate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.gates.create', compact('events'));
    }

    public function store(StoreGateRequest $request)
    {
        $gate = Gate::create($request->all());

        if ($request->input('photo', false)) {
            $gate->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $gate->id]);
        }

        return redirect()->route('admin.gates.index');
    }

    public function edit(Gate $gate)
    {
        abort_if(PermissionGate::denies('gate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $gate->load('event');

        return view('admin.gates.edit', compact('events', 'gate'));
    }

    public function update(UpdateGateRequest $request, Gate $gate)
    {
        $gate->update($request->all());

        if ($request->input('photo', false)) {
            if (!$gate->photo || $request->input('photo') !== $gate->photo->file_name) {
                if ($gate->photo) {
                    $gate->photo->delete();
                }
                $gate->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($gate->photo) {
            $gate->photo->delete();
        }

        return redirect()->route('admin.gates.index');
    }

    public function show(Gate $gate)
    {
        abort_if(PermissionGate::denies('gate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gate->load('event');

        return view('admin.gates.show', compact('gate'));
    }

    public function destroy(Gate $gate)
    {
        abort_if(PermissionGate::denies('gate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gate->delete();

        return 1;

       // return back();
    }

    public function massDestroy(MassDestroyGateRequest $request)
    {
        Gate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(PermissionGate::denies('gate_create') && PermissionGate::denies('gate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Gate();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
