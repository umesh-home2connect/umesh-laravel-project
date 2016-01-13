
@extends('layouts.master')

@section('page-script')
<script>
        $("document").ready(function(){
            
            $("#frm").submit(function(e){
                e.preventDefault();
                var username = $("input#name").val();
                var email = $("input#email").val();
                var password = $("input#password").val();
                var password_confirm = $("input#password_confirm").val();
              //  var token =  $("input[name=_token]").val();
                var dataString = ({'name':username,'email':email,'password':password,'password_confirm':password_confirm});
                $.ajax({
                    type: "post",
                    url : "/admin",
                    datatype:"json",
                    async:false,
                    data : dataString,
                    success : function(data){
                        console.log("unparsed response data is"+data);
                        var ResponseData = JSON.parse(data);
                        console.log("response data is"+ResponseData.flag);
                        $('.return-data').html(ResponseData.view);
                    },
                   error: function(data) {
                                if( data.status === 401 ) {//redirect if not authenticated user
                                    $( location ).prop( 'pathname', 'auth/login' );
                                    var errors = data.responseJSON.msg;
                                    errorsHtml = '<div class="alert alert-danger">'+errors+'</div>';
                                    $( '#form-errors' ).html( errorsHtml ); 
                                }
                                if( data.status === 422 ) {
                                //process validation errors here.
                                var errors = data.responseJSON; 

                                errorsHtml = '<div class="alert alert-danger"><strong>Whoops! Something went wrong!</strong><br><br><ul>';

                                $.each( errors , function( key, value ) {
                                    errorsHtml += '<li>' + value[0] + '</li>'; 
                                });
                                errorsHtml += '</ul></div>';

                                $( '#form-errors' ).html( errorsHtml ); 
                                } else {

                                }
                            }
                });

        });
        });//end of document ready function
    </script>
@stop

@section('content')
<div class="panel">
     @include('common.errors')
   <div id="form-errors"> </div>
           
     <!-- FORM STARTS HERE -->
    <?php  $attribute = array('class'=> 'border-form form-horizontal jquery-validate','id'=> 'frm'); ?>
     {!! Form::open($attribute) !!}
     <div class="row form-group">
     {!! Form::label('name','User Name:',['class' => 'control-label col-md-3']) !!}
     <div class="col-md-5 col-sm-6 col-xs-8 controls">
     {!! Form::text('name',null,[
                                'class'                 => 'form-control col-md-6',
                                'placeholder'           => 'Your Name',
                                'data-rule-required'    =>  true, 
                                'data-msg-required'     => 'Please enter Your name',
                                'data-rule-maxlength'   => '20',
                                'data-msg-maxlength'    => 'At most fours chars',
                                'data-rule-minlength'   => '2',
                                'data-msg-minlength'    => 'At least two chars'
                                
                                ]) !!}
     </div>
     </div>
     
     <div class="row form-group">
     {!! Form::label('email','Your Email:',['class'=> 'control-label col-md-3']) !!}
     <div class="col-md-5 col-sm-6 col-xs-8 controls">
     {!! Form::email('email',null, [
                                    'class'                      => 'form-control col-md-6',
                                    'placeholder'                => 'Enter Email',
                                    'data-rule-required'         => true,
                                    'data-msg-required'          => 'Please Enter Your  Email',
                                    'data-rule-email'            => true,
                                    'data-msg-email'             => 'Please Enter A Valid Email',
                                    
                                    ]) !!}
     </div>
     </div>
     
     <div class="row form-group">
     {!! Form::label('password','Your Password:',['class'=> 'control-label col-md-3']) !!}
     <div class="col-md-5 col-sm-6 col-xs-8 controls">
     {!! Form::password('password', [
                                      'class'                   => 'form-control col-md-6',
                                      'data-rule-required'      => true,
                                      'data-msg-required'       => 'Please Enter Your Password',
                                      ]) !!}
     </div>
     </div>
     
     <div class="row form-group">
     {!! Form::label('password_confirm','Confirm Password',['class'=> 'control-label col-md-3']) !!}
     <div class="col-md-5 col-sm-6 col-xs-8 controls">
     {!! Form::password('password_confirm', [
                                                'class'                 => 'form-control col-md-6',
                                                'data-rule-required'    => true,
                                                'data-msg-required'     => 'Please Enter Your Password',
                                                'equalTo'               => '#password',
                                                
                                                ]) !!}
     </div>
     </div>
     
    
     <div class="row form-group">
     {!! Form::submit('Submit',['class'=> 'btn btn-success col-md-offset-3']) !!}
     </div>
  
     {!! Form::close() !!}
     
     
     
     
<!--        <form method="POST" class="form-horizontal border-form jquery-validate" id='frm'>

            <div class="row form-group">
                <label for="name" class="control-label col-md-3">Name</label>
                <div class="col-md-5 col-sm-6 col-xs-8 controls">
               
                    <input type="text" id="name" class="form-control" name="name" placeholder="Name" required="true">
                    
                    @if ($errors->has('name')) <p class="help-block">{{ $errors->first('name') }}</p> @endif
                </div>
            </div>

            <div class="row form-group">
                <label for="email" class="control-label col-md-3">Email</label>
                <div class="col-md-5 col-sm-6 col-xs-8 controls">
                <input type="email" id="email" class="form-control col-md-6" name="email" placeholder="Email">
                @if ($errors->has('email')) <p class="help-block">{{ $errors->first('email') }}</p> @endif
                </div>
            </div>

            <div class="row form-group">
                <label for="password" class="control-label col-md-3">Password</label>
                <div class="col-md-5 col-sm-6 col-xs-8 controls">
                <input type="password" id="password" class="form-control col-md-6" name="password">
                 @if ($errors->has('password')) <p class="help-block">{{ $errors->first('password') }}</p> @endif
                </div>
            </div>

            <div class="row form-group">
                <label for="password_confirm" class="control-label col-md-3">Confirm Password</label>
                <div class="col-md-5 col-sm-6 col-xs-8 controls">
                <input type="password" id="password_confirm" class="form-control col-md-6" name="password_confirm">
                @if ($errors->has('password_confirm')) <p class="help-block">{{ $errors->first('password_confirm') }}</p> @endif
                </div>
            </div>

            <button type="submit" class="btn btn-success col-md-offset-3">Submit</button>

        </form>-->
     
     
</div>
<div class='container'>
    <div class="return-data">
        
    </div>
    
</div>
@stop

