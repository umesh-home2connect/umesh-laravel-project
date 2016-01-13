@extends('layouts.master')

@section('content')

<div class="panel">
    {!! Form::open(array('action'=> 'Admin\AdminController@test', 'class' => 'form-horizontal', 'files'=> true)) !!}
     <div class="form-group">
     {!! Form::label('name','Name:') !!}
     {!! Form::text('name', null, ['class' => 'form-control']) !!}
     </div>
     
     <div class="form-group">
         {!!Form::label('email','Email:') !!}
         {!!Form::email('email',null,['class' =>'form-control']) !!}
     </div>
     
     <div class='form-group'>
         {!!Form::label('password','password:') !!}
         {!!Form::password('password',['class' => 'form-control']) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('file','File Upload:') !!}
         {!!Form::file('file',['class' => 'form-control']) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('status','status:') !!}
         {!!Form::checkbox('status',1, true) !!}
         {!!Form::checkbox('status',0, false) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('radio','radio:') !!}
         {!!Form::radio('radio',1, true) !!}
         {!!Form::radio('radio',1, false) !!}
         {!!Form::radio('radio',1, false) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('number','number:') !!}
         {!!Form::number('number',1) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('date','date:') !!}
         {!!Form::date('date',\Carbon\Carbon::now()) !!}
     </div>
     <div class='form-group'>
         {!!Form::label('image','image:') !!}
         {!!Form::file('image') !!}
     </div>
     
     <div class='form-group'>
         {!!Form::label('size','Dropdown:') !!}
         {!!Form::select('size',array('L'=>'large','S'=> 'small'),'S') !!}
     </div>
     
     <div class='form-group'>
         {!!Form::label('animal','Animal:') !!}
         {!!Form::select('animal' ,array(
                                    'Cats' => array('leopard'=> 'Leopard'),
                                    'Dog'  => array('denial' => 'Denial'),
                                    )) !!}
     </div>
     <div class="row form-group">
                        {{Form::label('description','Description:')}}
                        <div class="controls col-md-6">
                        {{Form::textarea('description',null,['class' => 'form-control col-md-6', 'rows'=>'4','cols'=> '4','placeholder' => 'Put Here Few Lines About You']) }}
                        </div>
                    </div>
     
    <div class='form-group'>
         {!!Form::label('range','Number:') !!}
         {!!Form::selectRange('range', 10, 20) !!}
     </div>
    <div class='form-group'>
         {!!Form::submit('Click Me!') !!}
     </div>
     
     {!! Form::close() !!}
     
</div>

@stop