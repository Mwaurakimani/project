<?php

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/Tenants', function () {
    $users = User::where('account_type', 'LIKE','%TENANT%')->get();

    return Inertia::render('AppPages/Accounts/Tenants/index', [
        'users' => $users
    ]);
})->name('Tenants');

Route::get('/Tenant/{id}',function (User $id){
    $user = $id;

    $date  = strtotime($user->created_at);
    $user->date_created = date("d M Y",$date);


    $rent_details = \App\Models\rent::where('user_id',$user->id)->where('end_date',null)->first();
    $house = null;
    $subscriptions = \App\Models\Subscription::where('user_id',$user->id)
        ->where('subscription_end_date',null)->get();

    $subscriptions = $subscriptions->map(function ($item , $index){
        $item->servce = \App\Models\Service::where('id',$item->service_id)->first();

        $item->date_created = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$item->created_at)->format('Y-m-d');

        return $item;
    });
    if($rent_details){
        $house = \App\Models\House::where('id',$rent_details->house_id)->first();
    }
    $page_data = [
        'services' => get_all_services(),
        'total_deposit' => get_deposit($user->id),
        'all_arrears' => get_all_arrears($user->id),
        'invites'=>get_all_invites($user->id)
    ];


    return Inertia::render('AppPages/Accounts/Tenants/ViewTenant',[
        'tenant'=>$user,
        'rent_details' => $rent_details,
        'house' =>$house,
        'subscriptions' => $subscriptions,
        'page_data' => $page_data
    ]);
})->name('getTenant');


Route::post('subscribeToService',function (\Illuminate\Http\Request $request){
    if($request['select_service']){
        $exits = \App\Models\Subscription::where('user_id',$request['user_id'])
            ->where('house_id',$request['house_id'])
            ->where('service_id',$request['select_service'])
            ->where('subscription_end_date',null)
            ->first();

        if($exits){
        }else{
            $subscription = new \App\Models\Subscription();

            $subscription->service_id = $request['select_service'];
            $subscription->house_id = $request['house_id'];
            $subscription->user_id = $request['user_id'];
            $subscription->subscription_start_date = date('Y-m-d H:i:s');

            $subscription->save();
        }
    }
})->name('subscribe_to_service');

Route::post('updateEventStatus/id',function (\Illuminate\Http\Request $request){
    $invite = \App\Models\Invite::where('id', $request['invite_id'])->first();
    $invite->status = $request['status'];

    $invite->save();
})->name('updateEventStatus');


function get_all_services(){
    return \App\Models\Service::all();
}

function get_deposit($id){
    $deposits = \App\Models\Deposit::where('tenant_id',$id)->get();

    $deposits = $deposits->map(function ($item){
        $date  = strtotime($item->created_at);
        $item->date_created = date("d M Y",$date);

        return $item;
    });

    return array(
        'deposits' => $deposits,
        'count' => DB::select(DB::raw(
            "select
            tenant_id,
            sum(amount) as sub_total
        from deposits
        where tenant_id = ${id}
        group by tenant_id"
        ))
    );
}

function get_all_arrears($id){
    $all_arrears = DB::select(DB::raw(
        "select
                        a.id,
                        u.username as username,
                        a.amount,
                        a.unit_start_date,
                        a.description,
                        start_date,
                        end_date
                    from rents
                    join users u on u.id = rents.user_id
                    join rent_arrears ra on rents.id = ra.rent_id
                    join arrears a on a.id = ra.arrears_id
                    where u.id = :id1
                    union
                    select
                        a2.id,
                        u2.username as username,
                        a2.amount,
                         a2.unit_start_date,
                         a2.description,
                        s.subscription_start_date,
                        s.subscription_end_date
                    from services
                    join subscriptions s on services.id = s.service_id
                    join service_areas sa on s.id = sa.subscription_id
                    join arrears a2 on a2.id = sa.arrears_id
                    join users u2 on u2.id = s.user_id
                    where u2.id = :id2
                    union
                    select
                        a3.id,
                        u3.username as username,
                        a3.amount,
                         a3.unit_start_date,
                         a3.description,
                        event_start_date,
                        event_end_date
                    from events
                    join invites i on events.id = i.event_id
                    join event_areas ea on i.id = ea.invite_id
                    join arrears a3 on a3.id = ea.arrears_id
                    join users u3 on u3.id = i.tenant_id
                    where u3.id = :id3
                    "
    ), array(
        'id1' => $id,
        'id2' => $id,
        'id3' => $id,
    ));

    $count = 0;

    foreach ($all_arrears as $key => $value){
        $count = $count+$value->amount;
    }

    return array(
        'arrears' => $all_arrears,
        'count' => $count
    );
}

function get_all_invites($id){
    $invites = \App\Models\Invite::where('tenant_id',$id)->orderBy('created_at','ASC')->get();

    $invites = $invites->map(function ($item,$index){
        $event = \App\Models\Event::where('id',$item->event_id)->first();
        $item->user = User::where('id',$item->agent_id)->first();
        $item->event_date = date('M d, Y',strtotime($event->event_start_date));
        return $item;
    });
    return $invites;
}
