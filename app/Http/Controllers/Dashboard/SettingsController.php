<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
class SettingsController extends Controller
{
    public function index()
    {
        $setting=Setting::first();
        $this->authorize('view',$setting);
        return view('dashboard.settings');
    }
public function update(Request $request,Setting $setting)
    {   
        $this->authorize('update',$setting);

        
       //echo "<pre>";
       //var_dump($_POST);

       //dd($request->all());
     //  Setting::create($request->all());
     //  redirect()->route('dashboard.settings');

        $data=[
            'facebook'=>'nullable|string',
            'logo'=>'nullable|image|mimes:png,jpg|max:2048',
            'favicon'=>'nullable|image|mimes:png,jpg|max:2048',
            'facebook'=>'nullable|string',
            'phone'=>'required|string',
            'email'=>'nullable|email',
        ];
////valition غلط على تعدد اللغات
        // foreach (config('app.languages') as $key => $value) {
        //     $data[$key]['title']='nullable|string';
        //     $data[$key]['content']='nullable|string';
        //     $data[$key]['address']='nullable|string';
        // }

        foreach (config('app.languages') as $key => $value) {
            $data[$key.'*.title']='required|string';
            $data[$key.'*.content']='required|string';
            $data[$key.'*.address']='nullable|string';
        }

        // dd($data);  
    $validationData=$request->validate($data);
    
    $setting->update($request->except('logo','favicon','_token'));
    
    if($request->file('logo')){
        $file=$request->file('logo');
        $filename=Str::uuid().$file->getClientOriginalName();
        $file->move(public_path('imgs'),$filename);
        $path='imgs/'.$filename;
        $setting->update(['logo'=>$path]);
    }

    if($request->file('favicon')){
        $file=$request->file('favicon');
        $filename=Str::uuid().$file->getClientOriginalName();
        $file->move(public_path('imgs'),$filename);
        $path='imgs/'.$filename;
        $setting->update(['favicon'=>$path]);
    }

    
    return redirect()->route('dashboard.settings');
    // dd($setting);
    // dd($request->all());
        
    }
}
