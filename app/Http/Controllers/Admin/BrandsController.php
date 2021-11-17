<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyBrandRequest;
use App\Http\Requests\StoreBrandRequest;
use App\Http\Requests\UpdateBrandRequest;
use App\Models\Brand;
use App\Models\Event;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use Alert;

class BrandsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('brand_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Brand::with(['event'])->select(sprintf('%s.*', (new Brand())->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate = 'brand_show';
                $editGate = 'brand_edit';
                $deleteGate = 'brand_delete';
                $crudRoutePart = 'brands';

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
            $table->addColumn('event_title', function ($row) {
                return $row->event ? $row->event->title : '';
            });

            $table->editColumn('zone_name', function ($row) {
                return $row->zone_name ? $row->zone_name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'event']);

            return $table->make(true);
        }

        return view('admin.brands.index');
    }

    public function create()
    {
        abort_if(Gate::denies('brand_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.brands.create', compact('events'));
    }

    public function store(StoreBrandRequest $request)
    {
        $brand = Brand::create($request->all());

        if ($request->input('photo', false)) {
            $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $brand->id]);
        }

        Alert::success('تم بنجاح', 'تم إضافة القسم الداخلي بنجاح ');
        return redirect()->route('admin.brands.index');
    }

    public function edit(Brand $brand)
    {
        abort_if(Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $brand->load('event');

        return view('admin.brands.edit', compact('events', 'brand'));
    }

    public function update(UpdateBrandRequest $request, Brand $brand)
    {
        $brand->update($request->all());

        if ($request->input('photo', false)) {
            if (!$brand->photo || $request->input('photo') !== $brand->photo->file_name) {
                if ($brand->photo) {
                    $brand->photo->delete();
                }
                $brand->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($brand->photo) {
            $brand->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل بيانات القسم الداخلي بنجاح ');
        return redirect()->route('admin.brands.index');
    }

    public function show(Brand $brand)
    {
        abort_if(Gate::denies('brand_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->load('event', 'brandsVisitors');

        return view('admin.brands.show', compact('brand'));
    }

    public function destroy(Brand $brand)
    {
        abort_if(Gate::denies('brand_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $brand->delete();

        Alert::success('تم بنجاح', 'تم  حذف القسم الداخلي بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyBrandRequest $request)
    {
        Brand::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('brand_create') && Gate::denies('brand_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Brand();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
