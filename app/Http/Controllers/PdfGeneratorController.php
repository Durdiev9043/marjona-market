<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;

use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Http\Request;
use PDF;

class PdfGeneratorController extends Controller
{
    public function index($id)
    {
        $data=Order::where('id',$id)->first();
        $pp=OrderProduct::where('order_id',$id)->get();
        $pdf = PDF::loadView('admin.check',['order'=>$data,'pp'=>$pp]);
        $pdf->setOptions([
            'defaultPaperWidth' => '7cm',
            'encoding' => 'utf-8'
        ]);
        return $pdf->stream('resume.pdf');
    }
    public function gen(Request $request)
    {
        $code=QrCode::size(300)->generate($request->code);
//        return QrCode::generate('010460716615124721(8?tH/+.qPBUP93d3FM');
        return $code;
    }
}
