<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $newOrderCount = Order::query()
            ->where('status', 1)
            ->count();

        $clientCount = User::query()
            ->where('role', 2)
            ->count();

        return view('admin.dashboard', compact(
            'newOrderCount',
            'clientCount'
        ));
    }
}
