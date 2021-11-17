<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyImportantLinkRequest;
use App\Http\Requests\StoreImportantLinkRequest;
use App\Http\Requests\UpdateImportantLinkRequest;
use App\Models\ImportantLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ImportantLinksController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('important_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantLinks = ImportantLink::all();

        return view('admin.importantLinks.index', compact('importantLinks'));
    }

    public function create()
    {
        abort_if(Gate::denies('important_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.create');
    }

    public function store(StoreImportantLinkRequest $request)
    {
        $importantLink = ImportantLink::create($request->all());

        return redirect()->route('admin.important-links.index');
    }

    public function edit(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.edit', compact('importantLink'));
    }

    public function update(UpdateImportantLinkRequest $request, ImportantLink $importantLink)
    {
        $importantLink->update($request->all());

        return redirect()->route('admin.important-links.index');
    }

    public function show(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.importantLinks.show', compact('importantLink'));
    }

    public function destroy(ImportantLink $importantLink)
    {
        abort_if(Gate::denies('important_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $importantLink->delete();

        return 1;
    }

    public function massDestroy(MassDestroyImportantLinkRequest $request)
    {
        ImportantLink::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
