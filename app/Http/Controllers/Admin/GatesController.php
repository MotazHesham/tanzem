<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyGateRequest;
use App\Http\Requests\StoreGateRequest;
use App\Http\Requests\UpdateGateRequest;
use App\Models\Gate;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GatesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('gate_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gates = Gate::all();

        return view('admin.gates.index', compact('gates'));
    }

    public function create()
    {
        abort_if(Gate::denies('gate_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gates.create');
    }

    public function store(StoreGateRequest $request)
    {
        $gate = Gate::create($request->all());

        return redirect()->route('admin.gates.index');
    }

    public function edit(Gate $gate)
    {
        abort_if(Gate::denies('gate_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gates.edit', compact('gate'));
    }

    public function update(UpdateGateRequest $request, Gate $gate)
    {
        $gate->update($request->all());

        return redirect()->route('admin.gates.index');
    }

    public function show(Gate $gate)
    {
        abort_if(Gate::denies('gate_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.gates.show', compact('gate'));
    }

    public function destroy(Gate $gate)
    {
        abort_if(Gate::denies('gate_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $gate->delete();

        return back();
    }

    public function massDestroy(MassDestroyGateRequest $request)
    {
        Gate::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
