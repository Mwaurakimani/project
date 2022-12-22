<?php

namespace App\Http\Controllers;

use App\Logic\Classes\Template;
use App\Models\Service;
use App\Models\ServiceArea;
use Illuminate\Http\Request;

class ServiceAreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
    public function store($data)
    {
        $model = new Service();
        $model = Template::create_model($model,$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ServiceArea  $serviceArea
     * @return \Illuminate\Http\Response
     */
    public function show(ServiceArea $serviceArea)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ServiceArea  $serviceArea
     * @return \Illuminate\Http\Response
     */
    public function edit(ServiceArea $serviceArea)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ServiceArea  $serviceArea
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ServiceArea $serviceArea)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ServiceArea  $serviceArea
     * @return \Illuminate\Http\Response
     */
    public function destroy(ServiceArea $serviceArea)
    {
        //
    }
}
