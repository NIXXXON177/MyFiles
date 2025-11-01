<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function accepted($id) {
       $order = Order::find($id);
       $order->status = 'accepted';
       $order->save();
       return redirect()->back();
    }

    public function declined($id) {
        $order = Order::find($id);
        $order->status = 'declined';
        $order->save();
        return redirect()->back();
    }
}
