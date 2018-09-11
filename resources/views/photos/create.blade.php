@extends('layouts.app')

@section('content')

  <h3>Upload Photo</h3>
  {!! Form::open(['action' => 'PhotosController@store', 'method' => 'post','files'=>true]) !!}
  {!! Form::text('title','',['placeholder'=>'Photo title'])!!}
  {!! Form::textarea('description','',['placeholder'=>'Photo Description'])!!}
   <input type="hidden"  name="album_id" value="{{$album_id}}">
  {!! Form::file('photo') !!}
  {!! Form::submit('submit')!!}
  {!! Form::close() !!}
@endsection
