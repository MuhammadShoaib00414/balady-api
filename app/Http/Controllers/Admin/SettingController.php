<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SsoConfig;
use App\Models\CrmConfiguration;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    try{
        return view('backend.setting.index',[
            'sso'=>SsoConfig::first() ?: $this->datSave('ssoConfig'),
            'crm'=>CrmConfiguration::first() ?: $this->datSave('CrmConfig'),
        ]);


    } catch (\Exception $e) {
        dd($e->getMessage());
        return view('errors.404');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SsoConfig $ssoConfig,CrmConfiguration $crmConfiguration)
    {
        $ssoConfig->update([
            'client_id' => $request->client_id,
            'client_secret' => $request->client_secret,
            'redirect_url' => $request->redirect_url,
            'sso_url' => $request->sso_url,
        ]);

        $crmConfiguration->update([
            'url' => $request->url,
            'user_name' => $request->user_name,
            'password' => $request->password,
            'grant_type' => $request->grant_type,
            'pdf_url' => $request->pdf_url
        ]);

        return redirect()->back()->with('message','Sso Update Succussfully');

    }


   private function datSave($type){

    if($type == 'ssoConfig')
        SsoConfig::create([
            'client_id'     => 'testing',
            'client_secret' => 'testing',
            'redirect_url'  => 'testing',
            'url'       => 'testing',
        ]);
    else
        CrmConfiguration::create([
            'url'       => "testing",
            'user_name' => "testing",
            'password'  => "testing",
            'grant_type'=> "testing",
            'pdf_url' => 'testing',
        ]);

   }

}
