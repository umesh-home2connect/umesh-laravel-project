<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use PDF;

class PdfController extends Controller
{
     public function invoice() 
     {
        $data = $this->getData();
        $date = date('Y-m-d');
        $invoice = "2222";
        $view =  \View::make('pdf.invoice', compact('data', 'date', 'invoice'))->render();
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($view);
        return $pdf->stream('invoice');
        
//         $pdf = PDF::loadView('pdf.invoice', compact('data', 'date', 'invoice') );
//            return $pdf->download('invoice.pdf');
//        return view('pdf/invoice',compact('data', 'date', 'invoice') );
    }
    
//    public function __construct() {
//        $this->middleware('auth');
//    }
 
    public function getData() 
    {
        $data =  [
            'quantity'      => '1' ,
            'description'   => 'some ramdom text',
            'price'   => '500',
            'total'     => '500'
        ];
        return $data;
    }
}
