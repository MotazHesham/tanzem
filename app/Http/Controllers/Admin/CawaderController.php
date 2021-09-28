<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCawaderRequest;
use App\Http\Requests\StoreCawaderRequest;
use App\Http\Requests\UpdateCawaderRequest;
use App\Models\Cawader;
use App\Models\City;
use App\Models\Specialization;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CawaderController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('cawader_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Cawader::with(['city', 'specializations'])->select(sprintf('%s.*', (new Cawader())->table));
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
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $specialization->name_ar);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'specialization']);

            return $table->make(true);
        }

        return view('admin.cawaders.index');
    }

    public function create()
    {
        abort_if(Gate::denies('cawader_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name_ar', 'id');

        return view('admin.cawaders.create', compact('cities', 'specializations'));
    }

    public function store(StoreCawaderRequest $request)
    {
        $cawader = Cawader::create($request->all());
        $cawader->specializations()->sync($request->input('specializations', []));

        return redirect()->route('admin.cawaders.index');
    }

    public function edit(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cities = City::pluck('name_ar', 'id')->prepend(trans('global.pleaseSelect'), '');

        $specializations = Specialization::pluck('name_ar', 'id');

        $cawader->load('city', 'specializations');

        return view('admin.cawaders.edit', compact('cities', 'specializations', 'cawader'));
    }

    public function update(UpdateCawaderRequest $request, Cawader $cawader)
    {
        $cawader->update($request->all());
        $cawader->specializations()->sync($request->input('specializations', []));

        return redirect()->route('admin.cawaders.index');
    }

    public function show(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawader->load('city', 'specializations');

        return view('admin.cawaders.show', compact('cawader'));
    }

    public function destroy(Cawader $cawader)
    {
        abort_if(Gate::denies('cawader_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $cawader->delete();

        return back();
    }

    public function massDestroy(MassDestroyCawaderRequest $request)
    {
        Cawader::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
