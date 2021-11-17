<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyContactuRequest;
use App\Http\Requests\StoreContactuRequest;
use App\Http\Requests\UpdateContactuRequest;
use App\Models\Contactu;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ContactusController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('contactu_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactus = Contactu::all();

        return view('admin.contactus.index', compact('contactus'));
    }

    public function create()
    {
        abort_if(Gate::denies('contactu_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactus.create');
    }

    public function store(StoreContactuRequest $request)
    {
        $contactu = Contactu::create($request->all());

        return redirect()->route('admin.contactus.index');
    }

    public function edit(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactus.edit', compact('contactu'));
    }

    public function update(UpdateContactuRequest $request, Contactu $contactu)
    {
        $contactu->update($request->all());

        return redirect()->route('admin.contactus.index');
    }

    public function show(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.contactus.show', compact('contactu'));
    }

    public function destroy(Contactu $contactu)
    {
        abort_if(Gate::denies('contactu_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $contactu->delete();

        return 1;
    }

    public function massDestroy(MassDestroyContactuRequest $request)
    {
        Contactu::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
