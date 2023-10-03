<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SsoConfig;
use App\Models\CrmConfiguration;

class SsoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    try{
        return view('backend.sso.index',[
            'sso'=>SsoConfig::findOrFail(1),
            'crm'=>CrmConfiguration::findOrFail(1),
        ]);


    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{
        $table =SsoConfig::findOrFail(1);
        $table->client_id = $request->client_id;
        $table->client_secret = $request->client_secret;
        $table->redirect_url = $request->redirect_url;
        $table->url = $request->url;
        $table->update();

        return redirect()->back()->with('message','Sso Update Succussfully');


    } catch (\Exception $e) {
        return view('errors.404');
    }
    }

    public function crm_update(Request $request, $id)
    {
        try{
        $table =CrmConfiguration::findOrFail(1);
        $table->url = $request->url;
        $table->user_name = $request->user_name;
        $table->password = $request->password;
        $table->grant_type = $request->grant_type;
        $table->pdf_url = $request->pdf_url;
        $table->update();

        return redirect()->back()->with('message','Crm Update Succussfully');

    } catch (\Exception $e) {
        return view('errors.404');
    }

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
