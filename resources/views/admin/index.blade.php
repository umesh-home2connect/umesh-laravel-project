@extends('layouts.master')

@section('page-script')
<script>
$(document).ready(function(){

     var base_url = 'http://localhost:8000'
    $(document).on('click','.getUsers', function(event){
        event.preventDefault();
        
          var data = {
            testdata: 'testdatacontent'
        }
          $.ajax({
                  url: base_url + "/admin",
                  type: "post",
                  datatype:"json",
                  async:false,
                  data :data,
                  success: function(data){
                     
                    var ResponseData = JSON.parse(data);
                   // console.log('the return flag is' +ResponseData.flag);
                    $(".fetchusers").append(ResponseData.name); 
                  },
                  error: function(){
                      alert("error !!!");
                  },
                 
          });
    }); 

});
</script>
@stop

@section('content')
<div class="panel-body">
   
   @if(Session::has('flash_message'))
        <div class="alert alert-success col-xs-9 col-sm-9 col-md-9 col-lg-9 col-xs-offset-1 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
        {{ Session::get('flash_message') }}
        </div>
    @endif
</div>
<div class="panel">
    <p>welcome to index page of AdminController</p>
    <div>
        <span>To submit Data</span><a href='/admin/create'> Click Here! </a>
    </div>
    <div>
        <h3>Registred Users By Admin</h3><button type="button" name="submit-button"class="getUsers">click</button>
        <div class='fetchusers'>
    
        </div>
    </div>
</div>
@stop