<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySaidAboutTanzemRequest;
use App\Http\Requests\StoreSaidAboutTanzemRequest;
use App\Http\Requests\UpdateSaidAboutTanzemRequest;
use App\Models\SaidAboutTanzem;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class SaidAboutTanzemController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('said_about_tanzem_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidAboutTanzems = SaidAboutTanzem::with(['media'])->get();

        return view('admin.saidAboutTanzems.index', compact('saidAboutTanzems'));
    }

    public function create()
    {
        abort_if(Gate::denies('said_about_tanzem_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saidAboutTanzems.create');
    }

    public function store(StoreSaidAboutTanzemRequest $request)
    {
        $saidAboutTanzem = SaidAboutTanzem::create($request->all());

        if ($request->input('photo', false)) {
            $saidAboutTanzem->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $saidAboutTanzem->id]);
        }

        Alert::success('تم بنجاح', 'تم الإضافة بنجاح ');
        return redirect()->route('admin.said-about-tanzems.index');
    }

    public function edit(SaidAboutTanzem $saidAboutTanzem)
    {
        abort_if(Gate::denies('said_about_tanzem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saidAboutTanzems.edit', compact('saidAboutTanzem'));
    }

    public function update(UpdateSaidAboutTanzemRequest $request, SaidAboutTanzem $saidAboutTanzem)
    {
        $saidAboutTanzem->update($request->all());

        if ($request->input('photo', false)) {
            if (!$saidAboutTanzem->photo || $request->input('photo') !== $saidAboutTanzem->photo->file_name) {
                if ($saidAboutTanzem->photo) {
                    $saidAboutTanzem->photo->delete();
                }
                $saidAboutTanzem->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($saidAboutTanzem->photo) {
            $saidAboutTanzem->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل البيانات بنجاح ');
        return redirect()->route('admin.said-about-tanzems.index');
    }

    public function show(SaidAboutTanzem $saidAboutTanzem)
    {
        abort_if(Gate::denies('said_about_tanzem_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.saidAboutTanzems.show', compact('saidAboutTanzem'));
    }

    public function destroy(SaidAboutTanzem $saidAboutTanzem)
    {
        abort_if(Gate::denies('said_about_tanzem_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $saidAboutTanzem->delete();

        Alert::success('تم بنجاح', 'تم الحذف بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroySaidAboutTanzemRequest $request)
    {
        SaidAboutTanzem::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('said_about_tanzem_create') && Gate::denies('said_about_tanzem_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new SaidAboutTanzem();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
