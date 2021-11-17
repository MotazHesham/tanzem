<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyNewsRequest;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Requests\UpdateNewsRequest;
use App\Models\News;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Alert;

class NewsController extends Controller
{
    use MediaUploadingTrait;

    public function changeStatus($id,$status){
        $news = News::findOrFail($id);
        $news->status = $status;
        $news->save();

        if($status == 'active'){
            Alert::success('تم قبول الخبر');
        }else{
            Alert::error('تم رفض الخبر');
        }

        return redirect()->route('admin.news.index');
    }

    public function index()
    {
        abort_if(Gate::denies('news_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $news = News::with(['user', 'media'])->get();

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        abort_if(Gate::denies('news_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.news.create', compact('users'));
    }

    public function store(StoreNewsRequest $request)
    {
        $news = News::create($request->all());

        if ($request->input('photo', false)) {
            $news->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $news->id]);
        }

        Alert::success('تم بنجاح', 'تم إضافة الخبر بنجاح ');
        return redirect()->route('admin.news.index');
    }

    public function edit(News $news)
    {
        abort_if(Gate::denies('news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $news->load('user');

        return view('admin.news.edit', compact('users', 'news'));
    }

    public function update(UpdateNewsRequest $request, News $news)
    {
        $news->update($request->all());

        if ($request->input('photo', false)) {
            if (!$news->photo || $request->input('photo') !== $news->photo->file_name) {
                if ($news->photo) {
                    $news->photo->delete();
                }
                $news->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($news->photo) {
            $news->photo->delete();
        }

        Alert::success('تم بنجاح', 'تم تعديل بيانات الخبر بنجاح ');
        return redirect()->route('admin.news.index');
    }

    public function show(News $news)
    {
        abort_if(Gate::denies('news_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $news->load('user');

        return view('admin.news.show', compact('news'));
    }

    public function destroy(News $news)
    {
        abort_if(Gate::denies('news_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $news->delete();

        Alert::success('تم بنجاح', 'تم  حذف الخبر بنجاح ');
        return 1;
    }

    public function massDestroy(MassDestroyNewsRequest $request)
    {
        News::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('news_create') && Gate::denies('news_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new News();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
