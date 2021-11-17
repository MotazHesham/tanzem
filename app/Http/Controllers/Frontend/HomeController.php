<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Event;
use App\Models\SaidAboutTanzem;
use App\Models\CompaniesAndInstitution;
use App\Models\News;
use App\Http\Requests\StoreSubscriptionRequest;  
use App\Models\Subscription;
use Alert;

class HomeController extends Controller
{
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
}
