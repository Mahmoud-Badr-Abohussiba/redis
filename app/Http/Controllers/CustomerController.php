<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class CustomerController extends Controller
{
   public function checkCustomerRedis(Request $request){
    //  $customer_id= Customer::query()->where('national_id',$request->national_id)->first()->id;
     $customer_id = Redis::get('national_id_'.$request->national_id);
      if($customer_id){
          Customer::query()->where('national_id',$request->national_id)->update($request->all());
          return response()->json(['updated-->'. $customer_id]);
      }else{
          Customer::create($request->all());
          return response()->json(['created']);
      }
     }

    public function checkCustomerCache(Request $request){
//         $customer_id= Customer::query()->where('national_id',$request->national_id)->first()->id;
       $customer_id = Cache::get('national_id_'.$request->national_id);
        if($customer_id){
            Customer::query()->where('national_id',$request->national_id)->update($request->all());
            return response()->json(['updated-->'. $customer_id]);
        }else{
            Customer::create($request->all());
          return response()->json(['created']);
        }
    }


}
