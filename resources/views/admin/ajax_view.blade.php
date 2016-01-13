 @if($userDetails)
 <ul>
@foreach($userDetails as $val)  
<li>
{{$val->name}} {{$val->email }} {{$val->user_name}}
</li>
@endforeach
 </ul>
@endif
