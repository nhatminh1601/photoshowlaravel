@extends('layouts.app')

@section('content')
  @if(count($albums)>0)
    <?php
      $colcount=count($albums);
      $i=1;
    ?>
    <div id="albums">
      <div class="row text-center">
        @foreach($albums as $album)
          @if($i==$colcount)
            <div class="medium-4 columns end">
              <a href="{{url('albums')}}\{{$album->id}}">
                <img class="thumbnail" src="/photoshow/storage/app/public/album_cover/{{$album->cover_image}}" width="300px" />
              </a>
              <br>
              <h4>{{$album->name}}</h4>
            @else
            <div class="medium-4 columns">
              <a href="{{url('albums')}}\{{$album->id}}">
                <img class="thumbnail" src="/photoshow/storage/app/public/album_cover/{{$album->cover_image}}" width="300px"/>
              </a>
              <br>
              <h4>{{$album->name}}</h4>
            @endif
            @if($i%3==0)
          </div></div><div class="row text-center">
            @else
          </div>
          @endif
          <?php $i++; ?>
        @endforeach
      </div>
    </div>
    @else
      <p> No Albus To Display</p>
  @endif

@endsection
