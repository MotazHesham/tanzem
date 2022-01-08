<?php

namespace App\Http\Controllers\GovernmentalEntity;

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
use Auth;

class NewsController extends Controller
{
    use MediaUploadingTrait; 

    public function index()
    { 

        $news = News::where('user_id',Auth::id())->with(['user', 'media'])->get();

        return view('government.news.index', compact('news'));
    }

    public function create()
    { 

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('government.news.create', compact('users'));
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
        return redirect()->route('government.news.index');
    }

    public function edit(News $news)
    { 

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $news->load('user');

        return view('government.news.edit', compact('users', 'news'));
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
        return redirect()->route('government.news.index');
    }

    public function show(News $news)
    { 

        $news->load('user');

        return view('government.news.show', compact('news'));
    }

    public function destroy(News $news)
    { 

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

        $model         = new News();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
