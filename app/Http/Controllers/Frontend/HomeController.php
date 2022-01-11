<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Event;
use App\Models\SaidAboutTanzem;
use App\Models\CompaniesAndInstitution;
use App\Models\News;
use App\Models\User;
use App\Http\Requests\StoreSubscriptionRequest;  
use App\Models\Subscription;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\Models\Media;
use App\Http\Requests\StoreCompaniesAndInstitutionRequest;
use Alert;
use Auth;

class HomeController extends Controller
{
    use MediaUploadingTrait;

    public function register_company(StoreCompaniesAndInstitutionRequest $request)
    {  
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'user_type' => 'companiesAndInstitution', 
            'phone' => $request->phone, 
            'landline_phone' => $request->landline_phone, 
            'website' => $request->website, 
        ]);

        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        $companiesAndInstitution = CompaniesAndInstitution::create([
            'user_id' => $user->id,
            'commerical_num' => $request->commerical_num,
            'commerical_expiry' => $request->commerical_expiry,
            'licence_num' => $request->licence_num,
            'licence_expiry' => $request->licence_expiry,
            'about_company' => $request->about_company,  
            'city_id' => $request->city_id, 
        ]);

        $companiesAndInstitution->specializations()->sync($request->input('specializations', [])); 

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $companiesAndInstitution->id]);
        }
        
        Auth::login($user);

        Alert::success('تم التسجيل بنجاح');
        return redirect()->route('company.home');
    }

    public function home(){ 
        $setting = Setting::first();
        $events = Event::where('status','active')->orderBy('created_at','desc')->get()->take(4);
        $saidAboutTanzem = SaidAboutTanzem::orderBy('created_at','desc')->get()->take(3);
        $companiesAndInstitution = CompaniesAndInstitution::orderBy('created_at','desc')->get()->take(12);
        $news = News::where('status','active')->orderBy('created_at','desc')->get()->take(12);
        
        return view('frontend.home',compact('setting','events','saidAboutTanzem','companiesAndInstitution','news'));
    } 

    public function news($id){
        $news = News::findOrFail($id);
        return view('frontend.news-details',compact('news'));
    }

    public function subscription(Request $request)
    {
        $subscription = Subscription::where('email',$request->email)->first();

        if($subscription){
            Alert::warning('لم يتم الأشتراك','تم الأشتراك من قبل');
        }else{
            $subscription = Subscription::create($request->all());
            Alert::success('تم الأشتراك بنجاح','سنوافيك بكل الأخبار الجديدة');
        }

        return back();
    }
    public function storeCKEditorImages(Request $request)
    { 
        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
