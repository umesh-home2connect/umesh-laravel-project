<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Helpers\Contracts\RocketShipContract as RocketShipContract;  

class DemoController extends Controller
{
   public function index(RocketShipContract $rocketship)
{
//      $rocketship = new RocketShipContract ;
        $boom = $rocketship->blastOff();
        

        return view('demo.index', compact('boom'));
}

}
