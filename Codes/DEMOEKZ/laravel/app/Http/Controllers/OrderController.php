<?php

namespace App\Http\Controllers;

use App\Models\order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function set (Request $r) {

        $user = Auth::user();
        $validated = $r->validate([
            'datetime' => 'required',
            'weight' => 'required',
            'dimensions' => 'required',
            'adr_o' => 'required',
            'adr_d' => 'required',
        ]);

        $validated['user_id'] = $user['id'];
        $validated['cargo_id'] = (int) $r['cargo_id'];
        Order::create($validated);

        return redirect("/");
    }
}
