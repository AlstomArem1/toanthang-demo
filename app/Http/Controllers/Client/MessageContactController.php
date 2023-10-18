<?php

namespace App\Http\Controllers\Client;

use App\Events\PlaceOrderSuccess;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageContactController extends Controller
{
    //
    public function messcontact(Request $request){
        try{
            DB::beginTransaction();
            $orders = new Order();
            $orders->user_id = Auth::user()->id;
            $orders->note = $request->notes;
            $orders->save();

            $user = User::find(Auth::user()->id);
            $user->phone = $request->phone;
            $user->save();

            DB::commit();

            event(new MessageContactController($orders, $user));

            return redirect()->route('home.index');
        }
        catch(\Exception $exception){
            DB::rollBack();
            dd($exception->getMessage());
        }
    }
}
