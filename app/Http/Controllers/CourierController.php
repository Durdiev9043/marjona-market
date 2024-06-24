<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CourierController extends Controller
{

    public function index()
    {
        $couriers=User::where('role',3)->get();
        return view('admin.courier.index',['couriers'=>$couriers]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
       User::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'role' => $request->role,
            'password' => Hash::make($request->password),
        ]);
        return redirect()->route('courier.index')->with('success','Yangi yetkazib beruvchi qo\'shildi');
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
        //
    }
}
