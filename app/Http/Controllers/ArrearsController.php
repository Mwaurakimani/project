<?php

namespace App\Http\Controllers;

use App\Models\Arrera;
use App\Models\EventArea;
use App\Models\Invite;
use App\Models\rent;
use App\Models\RentArrear;
use App\Models\ServiceArea;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Http\Request;

class ArrearsController extends Controller
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Arrera  $area
     * @return \Illuminate\Http\Response
     */
    public function show(Arrera $area)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Arrera  $area
     * @return \Illuminate\Http\Response
     */
    public function edit(Arrera $area)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Arrera  $area
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Arrera $area)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Arrera  $area
     * @return \Illuminate\Http\Response
     */
    public function destroy(Arrera $area)
    {
        //
    }

    public function get_table_ref($id)
    {
        $rent_arr = RentArrear::where('arrears_id',$id)->first();
        $service_arr = ServiceArea::where('arrears_id',$id)->first();
        $event_arr = EventArea::where('arrears_id',$id)->first();

        if($rent_arr){
            $rent = rent::where('id',$rent_arr->rent_id)->first();
            $Tenant = User::where('id',$rent->user_id)->first();
            return [
                'Tenant' => $Tenant,
                'element' => $rent_arr,
            ];
        }else if($service_arr){

            $sub = Subscription::where('id',$service_arr->subscription_id)->first();
            $Tenant = User::where('id',$sub->user_id)->first();

            return [
                'Tenant' => $Tenant,
                'element' => $service_arr,
            ];
        }else if ($event_arr){
            $invite = Invite::where('id',$event_arr->invite_id)->first();
            $Tenant = User::where('id',$invite->tenant_id)->first();

            return [
                'Tenant' => $Tenant,
                'element' => $event_arr,
            ];
        }
    }
}
