<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
//use Request;
use App\Adminform;
use Carbon\Carbon;
use Illuminate\Support\Facades\Input;
use DB;
use Hash;
use Mail;
class AdminController extends Controller
{
    public function index()
            
        { 
            $response = array();
            $user_details  = Adminform::all();
            $view = view('admin.index',compact('user_details'));
            
            $reqobj = new Request();
            if($reqobj->ajax()) {
                //$user_details  = Adminform::all();
          
                //$sections = $view->renderSections(); 
                //$response['name'] = $user_details->name;
               
                $response['flag'] = 1;
                echo json_encode($response); 
            } else {
            return $view;
        }
        }
    
    //let create a form
    public function create(){
        return view('admin.create');
    }
    
    public function store(Request $request)
       {   
            if($request->ajax()) {
            
              if ($request->isMethod('post')) {
                    $rules = array(
                            'name'             => 'required',                        
                            'email'            => 'required|email|unique:adminforms',   
                            'password'         => 'required',
                            'password_confirm' => 'required|same:password' 
                        );
        
                    $this->validate($request,$rules);
                    $inputData = [
                        'name'       => $request->input('name'),
                        'email'      => $request->input('email'),
                        'password'   => Hash::make($request->input('password')),
                        ];
         
                    $insert_id = DB::table('adminforms')->insertGetId($inputData); 
                    if($insert_id){
                        $postData = [
                                'user_id' => $insert_id,
                                'user_name'=> "Calipus123",
                            ];
                
                        DB::table('posts')->insert($postData);
                        
                       
                    }
                
                    $userDetails = DB::table('adminforms')
                                            ->join('posts', 'adminforms.id', '=', 'posts.user_id')
                                            ->select('adminforms.*', 'posts.user_name')
                                            ->get();
                   Mail::send('emails.welcome', $data = ['name'=> 'umesh'], function ($message) {
//                            $message->from('test@calipus.com', 'Administrator');
                            $message->to('us4760@gmail.com');
                            });
                    $view = view('admin.ajax_view',compact('userDetails'))->render();
                    $response['view'] =  $view;
                    $response['flag'] = "AjaxCall Success";
                    echo json_encode($response); 
                    
               }
            } 
            else {
               $response['flag'] = 'Not AjaxCall';
                echo json_encode($response); 
//            $rules = array(
//                'name'             => 'required',                        
//                'email'            => 'required|email|unique:adminforms',   
//                'password'         => 'required',
//                'password_confirm' => 'required|same:password' 
//            );
//        
//            $this->validate($request,$rules);
//            $input = $request->all();
//            $input['published_at'] = Carbon::now();
//            Adminform::create($input);
//            $request->session()->flash('flash_message', 'User successfully added!');
//            return redirect('admin');
//            return redirect()->back();
         }
       }
       
       public function test(Request $request){
           return view('admin.test');
           
       }
}
