<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserOrderController extends Controller
{
    public function index()
    {
        $orders = auth()->user()->orders()->paginate(20);
        // dd(auth()->user()->store);
        return view('user-orders', compact('orders'));
    }
}
