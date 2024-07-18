<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use Illuminate\Http\Request;
use PDF;

class PdfGeneratorController extends Controller
{
    public function index($id)
    {
//        $data = [
//            'imagePath'    => public_path('img/profile.png'),
//            'name'         => 'John Doe',
//            'address'      => 'USA',
//            'mobileNumber' => '000000000',
//            'email'        => 'john.doe@email.com'
//        ];
        $data=Order::where('id',$id)->first();
        $pp=OrderProduct::where('order_id',$id)->get();
        $pdf = PDF::loadView('admin.check',['order'=>$data,'pp'=>$pp]);
        $pdf->setOptions([
//            'defaultPaperSize' => 'A4', // Set the default paper size (A4 is the default value)
//            "default_paper_size" => "custom",
            'defaultPaperWidth' => '7cm',

        ]);
        return $pdf->stream('resume.pdf');
    }
}
