@extends('layouts.app')

@section('content')
<div class="container spark-screen">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">{{ trans('home_lang.dashboard') }}</div>
                <div class="panel-body">
                    <h3> You are logged in!</h3>
                    <!--<a href="/tasks"><button class="btn btn-danger">Click Here To Add Task</button></a>-->   
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
