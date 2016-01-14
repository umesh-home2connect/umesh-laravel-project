<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use App\Page;
use Event;
use App\Events\SomeEvent;
use App\Editprofile;
use Intervention\Image\Facades\Image as Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use App\Helpers\Contracts\FileUploadContract as FileUploadContract; 
use App\Libraries\PriceLibrary;
use PDF;

class EditProfileController extends Controller
{
    protected $filePathaObj;
    
    public function __construct(FileUploadContract $fileUploadContract_obj) {
        $this->middleware('auth');
        $this->filePathaObj = $fileUploadContract_obj;
    }
    
   
    
    public function forUser(User $user){
        return Editprofile::where('user_id', $user->id)
                    ->orderBy('created_at', 'asc')
                    ->get();
    }
    
    function index(Request $request) {
        
         $userdetails =  $this->forUser($request->user());
         if($userdetails){  
            foreach ($userdetails  as $val){
               $description  = isset($val->description) ? $val->description : '';
               $image_name   = isset($val->image_name) ? $val->image_name : '';
               $user_id      = isset($val->user_id) ? $val->user_id :'';
            }
         }
         $user_reg_detail = User::where('id', $request->user()->id)->get();
           foreach($user_reg_detail as $val){
               $username        = isset($val->name) ? $val->name: '' ;
               $useremail       = isset($val->email) ? $val->email : '';
               $userpassword    = $val->password;
           }

        $userdetail = [
               'description'    => isset($description) ? $description : '',
               'name'           => $username,
               'email'          => $useremail,
               'image_name'     => $image_name != '' ? $image_name : '' ,
              ];
        
         if ($request->isMethod('post')) {
              
             
            $inputData = ['description' => $request->description];
              
            if($request->hasFile('profileimage')){
                
                $image = $request->file('profileimage');
                if($image->getClientOriginalExtension()){
                    
                 $original_filename   = 'original'.time() . '.' . $image->getClientOriginalExtension(); 
                 $small_filename      = '40_'.time().'.png';   
                 $medium_filename     = '100_'.time().'.png';   
                 $big_filename        = '800_'.time().'.png';   
                 
//                 $path_original =  public_path('images/'.$original_filename);
//                 $path_small    =  public_path('images/'.$small_filename);
//                 $path_medium   =  public_path('images/'.$medium_filename);
//                 $path_big      =  public_path('images/'.$big_filename);
                 
                 //Upload image to dir with the help of serviceProvider.
                 $uploadPath = 'images/';
                 
                 $desire_upload_path = $this->filePathaObj->create_directory_image_upload($uploadPath);
                 $path_original_dir  = $desire_upload_path.$original_filename;
                 $path_small_dir     = $desire_upload_path.$small_filename;
                 $path_medium_dir    = $desire_upload_path.$medium_filename;
                 $path_big_dir       = $desire_upload_path.$big_filename;
                 
                 Image::make($image)->save($path_original_dir);
                 Image::make($image)->fit(40)->sharpen(15)->save($path_small_dir);
                 Image::make($image)->fit(100)->save($path_medium_dir);
                 Image::make($image)->fit(800, 600, function ($constraint) {
                                                     $constraint->upsize();
                                            })->save($path_big_dir);
                 
                }else{
                    exit('Format not supported');
                }
                
                $inputData['image_name'] = $path_medium_dir;
            }
            $userData   = ['name'  => $request->name,
                           'email' => $request->email,
                           ];
            if(isset($request->password) && ($request->password != '') && ($userpassword != bcrypt($request->password))){
                  $userData['password'] = bcrypt($request->password);
            }
           if(!$user_id){
               $request->user()->editprofiles()->create($inputData);
               //order_detail()
               ////orderDetail()
//               $edit = new Editprofile();
//               $edit->description = $request->description;
//               $edit->user_id     = $request->user()->id;
//               $edit->save();
               
            } else {
                Editprofile:: where('user_id',$request->user()->id)->update($inputData);
                
                //For Authorization Testing
//                $editprofileobj = new Editprofile();
//                $this->authorize('update_editprofile', $editprofileobj );
//                $t =  Auth::user()->can('update_editprofile',$editprofileobj);
//                dd($t);
//                $this->update_editprofile(Request $request);
                
             //Don't delete it Event fired when update detail of user.
              //Event::fire(new SomeEvent());
             
            
            User::where('id',$request->user()->id)->update($userData);
            return redirect()->back()->withInput();
            }
          }
          else {
              $pagedetail = Page::paginate(5);
              $priceLib = new PriceLibrary();
              $prices = $priceLib->getPrices();
              
              
//               $value = $request->session()->get('client_session_array');
//               $user_type = $value['user_type'];
//               dd($user_type);
              
          return view('user/editprofile', ['userdetail' => $userdetail, 'pagedetail' => $pagedetail,'prices' => $prices]);
         }
    }
   

}


