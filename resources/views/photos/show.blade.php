@extends('layouts.app')
@section('content')
  <h3>{{$photo->title}}</h3>
  <p>{{$photo->description}}</p>
  <img class="thumbnail" src="/photoshow/storage/app/public/photo/{{$photo->album_id}}/{{$photo->photo}}"
  <br><br>
    {!! Form::open(['action' => ['PhotosController@destroy',$photo->id], 'method' => 'post']) !!}
    <input type="hidden" name="_method" value="DELETE">
    {!! Form::submit('Delete Photo',['class'=>'button alert'])!!}
    {!! Form::close() !!}
@endsection
