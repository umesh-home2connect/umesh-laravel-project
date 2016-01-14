@extends('layouts.app')
@section('content')
 
    <form action="{{route('addentry', [])}}" method="post" enctype="multipart/form-data">
        {{csrf_field() }}
        <input type="file" name="filefield">
        <input type="submit">
    </form>
 
 <h1> Document  list</h1>
 <div class="row">
        <ul class="thumbnails">
 @foreach($entries as $entry)
            <div class="col-md-2">
               
                <div class="thumbnail">
                    <img src="{{route('getentry', $entry->filename)}}" alt="ALT NAME" class="img-responsive" />
                    <div class="caption">
                        <p>{{$entry->original_filename}}</p>
                    </div>
                    <div>
                        <a href="{{route('getentry', $entry->filename)}}">Click Here to download</a> <br />
                        <a href="{{route('deleteentry', $entry->filename)}}">Click Here to delete</a>
                    </div>
                </div>
              
            </div>
 @endforeach
 </ul>
 </div>
 
@endsection