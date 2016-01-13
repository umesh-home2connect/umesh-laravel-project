<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Config;
class HomeController extends Controller
{
    public function index(){
       return view('home');
    }
    
     public function postChangeLanguage(Request $request) 
    {
        $rules = [
        'language' => 'in:en,ge' //list of supported languages of your application.
        ];

        $language = $request->get('lang'); //lang is name of form select field.
          
        $validator = Validator::make(compact($language),$rules);

        if($validator->passes())
        {
            Session::put('language',$language);
            App::setLocale($language);
            return redirect('/home')->withInput();
        }
        else
        {
            echo "Invalid Language";
        }
    }
}
