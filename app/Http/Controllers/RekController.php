<?php

namespace App\Http\Controllers;

use App\Models\Rek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RekController extends Controller
{
    public function index()
    {
        $reks=Rek::paginate(10);
        return view('admin.rek.index',['reks'=>$reks]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $uuid = Str::uuid()->toString();
        $fileName = $uuid . '-' . time() . '.' . $request->img->getExtension();
        $request->img->move(public_path('../public/storage/galereya/'), $fileName);
        Rek::create([
            'img' => $fileName,
        ]);
        return redirect()->back();
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
