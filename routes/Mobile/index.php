<?php

use Illuminate\Support\Facades\Route;

Route::get('/mobile/Blocks',function (){
    return \Inertia\Inertia::render('MobilePages/listBlocks');
});
Route::get('/mobile/Houses',function (){
    return \Inertia\Inertia::render('MobilePages/listBlocks');
});
Route::get('/mobile/Deposits',function (){
    return \Inertia\Inertia::render('MobilePages/listBlocks');
});
Route::get('/mobile/Arrears',function (){
    return \Inertia\Inertia::render('MobilePages/listBlocks');
});
Route::get('/mobile/Payments',function (){
    return \Inertia\Inertia::render('MobilePages/Payment');
});

//Search deposit details
Route::post('mobile/getDeposit',function (\Illuminate\Http\Request $request){
    $deposit = \App\Models\Deposit::where('id',$request['deposit_id'])->first();

    $user = \App\Models\User::find($deposit->tenant_id);

    $deposit->tenant = $user;
    return [
        'deposit' => $deposit
    ];
})->name('search_deposit_by_id');



//Search arrears details
Route::post('mobile/getArrears',function (\Illuminate\Http\Request $request){
    $arrears = \App\Models\Arrears::where('id',$request['arrears_id'])->first();

    return [
        'arrears' => $arrears
    ];
})->name('search_arrears_by_id');


//make transaction
Route::post('postMobileTransaction',function (\Illuminate\Http\Request $request){
    $deposit_id = $request['deposit_id'];
    $arrears_id = $request['arrears_id'];
    $amount = $request['amount'];


    if($deposit_id && $arrears_id){
        if(\App\Models\Deposit::where('id',$deposit_id)->exists()  && \App\Models\Arrears::where('id',$arrears_id)->exists() && $amount){
            $payment = new \App\Models\Payment();

            $payment->deposit_id = $deposit_id;
            $payment->arrears_id = $arrears_id;
            $payment->amount = $amount;

            $payment->save();
        }
    }
})->name('postMobileTransaction');


