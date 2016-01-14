@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('editprofilelang.welcome') }}</div>
                <div class="panel-body">
                    <?php $attribute = array('action' => 'User\EditProfileController@index', 'files'=> true,'class'=> 'form-horizontal','id'=> 'editprofile');
                           $label_attribute = array('class' => 'control-label col-md-3');
                         
                    ?>
                    {{Form::open($attribute) }}
                    <div class="row form-group">
                        {{Form::label('name','Name:',$label_attribute)}}
                        <div class="controls col-md-6">
                        {{Form::text('name',  $userdetail['name']  ,['class' => 'form-control col-md-6','placeholder' => 'Your Name']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        {{Form::label('email','Email:',$label_attribute)}}
                        <div class="controls col-md-6">
                        {{Form::email('email',$userdetail['email'],['class' => 'form-control col-md-6','placeholder' => 'Your Email']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        {{Form::label('password','Password:',$label_attribute)}}
                        <div class="controls col-md-6">
                        {{Form::text('password',null,['class' => 'form-control col-md-6','placeholder' => 'Your Password']) }}
                        </div>
                    </div>
                    <div class="row form-group">
                        {{Form::label('description','Description:',$label_attribute)}}
                        <div class="controls col-md-6">
                        {{Form::textarea('description',$userdetail['description'],['class' => 'form-control col-md-6', 'rows'=>'4','cols'=> '4','placeholder' => 'Put Here Few Lines About You']) }}
                        </div>
                    </div>
                    
                      <div class='row form-group'>
                        {{ Form::label('profileimage','Profile Image:',$label_attribute) }}
                         {{ Form::file('profileimage') }}
                      </div>
                     <?php if($userdetail['image_name'] != ''){?>
                    <div class='row'>
                     <img class='col-md-offset-3' src="<?php  echo $userdetail['image_name'] ;?>" class="thumb" alt="a picture">
                    </div>
                     <?php }?>
                    <div class="row form-group">
                        {{Form::submit('Submit', ['class'=>'btn btn-success col-md-offset-3']) }}
                    </div>
                    {{Form::close() }}
                </div>
              
            </div>
            <div class="col-md-10 col-md-offset-3">
                <h3>Demo Pagination</h3>
                 {!! $pagedetail->links() !!}
                 <ul>
                 @foreach ($pagedetail as $pages)
                 <li> {{ $pages->page }}</li>
                @endforeach
                 </ul>
            </div>
            <div class="col-md-8 col-md-offset-3">
                <h3>Use of Custom helper function </h3>
                <?php $stringvar = "Calipus" ?>
                {{ blastOff($stringvar) }}
            </div>
            <div class="col-md-8 col-md-offset-3">
                <h3> Use Of Package</h3>
                <a href="timezones">click Here to view Current Time</a>
            </div>
            
            <div class="col-md-8 col-md-offset-3">
                <h3>
                    Use of Library
                </h3>
                <ul>
                @foreach($prices as $price)
                <li>
                    {{$price }}
                </li>
                @endforeach
                </ul>
            </div>
            <div class="col-md-8 col-md-offset-3">
                <h3>Use of DOMPDF </h3>
                <a href="pdf">click here to ganerate pdf</a>
            </div>
            <div class="col-md-8 col-md-offset-3">
                <h3>Current user Session Detail</h3>
                <?php
                $value = Session::get('client_session_array');
                ?>
                <ul>
                    <li>
                        <?php
                            echo "User Type : ".$value['user_type'];
                        ?>
                    </li>
                    <li>
                        <?php  echo "User Id : ".$value['user_id']; ?>
                    </li>
                    <li>
                        <?php echo "User Name : ".$value['name']; ?>
                    </li>
                    <li>
                        <?php echo "User Email : ".$value['email']; ?>
                    </li>
                    
                </ul>
  
              
                
              
            </div>
           
        </div>
    </div>
</div>
@endsection
