<?php

namespace App\Http\Controllers;

use App\Models\Arrears;
use App\Models\Event;
use App\Models\EventArea;
use App\Models\RentArrear;
use App\Models\ServiceArea;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SystemController extends Controller
{
    public function receive_request(): string
    {

    }

    public function generate_arrears()
    {
        $rent_arrears = $this->generate_rent_arrears();
        $rent_arrears = $this->generate_service_arrears();
        $rent_arrears = $this->generate_event_arrears();
    }

    /**
     * @throws \Exception
     */
        public function generate_rent_arrears(): bool
        {
            $active_tenants = DB::table('active_tenants')->get();

            foreach ($active_tenants as $key => $subscription) {
                DB::beginTransaction();

                try {
                    $user = User::find($subscription->user_id);

                    $start_date = date('Y-m-d H:i:s');
                    $end_date = date('Y-m-d H:i:s');
                    $amount =$subscription->rent_amount;
                    $description = "Rent as from ${start_date} to ${end_date} at ${amount} per month.";

                    $arrears = new Arrears();

                    $arrears->unit_start_date = $start_date;
                    $arrears->unit_end_date = $end_date;
                    $arrears->amount = $amount;
                    $arrears->description = $description;

                    $arrears->save();

                    $rent_arrears = new RentArrear();

                    $rent_arrears->rent_id = $subscription->rent_id;
                    $rent_arrears->arrears_id = $arrears->id;

                    $rent_arrears->save();

                    DB::commit();

                } catch (\Exception $ex) {
                    DB::rollBack();
                    throw $ex;
                }

            }

            return true;
        }

        public function generate_service_arrears(): bool
        {
            $active_subscriptions = DB::table('active_subscriptions')->get();

            foreach ($active_subscriptions as $key => $subscription) {
                DB::beginTransaction();

                try {
                    $user = User::find($subscription->user_id);

                    $details = $subscription->name;
                    $id = $subscription->subscription;

                    $start_date = date('Y-m-d H:i:s');
                    $end_date = date('Y-m-d H:i:s');
                    $amount =$subscription->price;
                    $description = "Service charge for ${details} with subscription ID ${id}";

                    $arrears = new Arrears();

                    $arrears->unit_start_date = $start_date;
                    $arrears->unit_end_date = $end_date;
                    $arrears->amount = $amount;
                    $arrears->description = $description;

                    $arrears->save();

                    $service_arrears = new ServiceArea();

                    $service_arrears->subscription_id = $id;
                    $service_arrears->arrears_id = $arrears->id;

                    $service_arrears->save();

                    DB::commit();

                } catch (\Exception $ex) {
                    DB::rollBack();
                    throw $ex;
                }

            }
            return true;
        }

        public function generate_event_arrears()
        {
            $users = DB::table('event_resolution')
                ->whereDate('event_start_date','=',date('Y-m-d'))
                ->get();


            foreach ($users as $key=>$value){
                DB::beginTransaction();

                try {
                    $arrears = new Arrears();

                    $arrears->unit_start_date = date('Y-m-d');
                    $arrears->unit_end_date = date('Y-m-d');
                    $arrears->amount = '5000';
                    $arrears->description = 'Event Contribution';

                    $arrears->save();

                    $event_arrears = new EventArea();

                    $event_arrears->invite_id = $value->invite_id;
                    $event_arrears->arrears_id =$arrears->id;

                    $event_arrears->save();

                    DB::commit();

                } catch (\Exception $ex) {
                    DB::rollBack();
                    throw $ex;
                }



            }

        }
}
