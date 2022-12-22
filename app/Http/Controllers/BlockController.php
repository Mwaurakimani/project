<?php

namespace App\Http\Controllers;

use App\Logic\Classes\Template;
use App\Models\Block;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BlockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store($data)
    {
        $model = new Block();
        Template::create_model($model,$data);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return Response
     */
    public function show(Block $block)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Block  $block
     * @return Response
     */
    public function edit(Block $block)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Block  $block
     * @return Response
     */
    public function update(Request $request, Block $block)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Block  $block
     * @return Response
     */
    public function destroy(Block $block)
    {
        //
    }
}
