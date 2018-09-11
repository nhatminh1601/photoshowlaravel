<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;

class AlbumsController extends Controller
{
    public function index(){
      $albums=Album::with('Photos')->get();
       return view('albums.index')->with('albums',$albums);
    }

    public function create(){
        return view('albums.create');
    }
    public function store(Request $req){
      $this->validate($req,[
        'name'=>'required',
        'cover_image'=>'image|max:1999',
      ]);

      // get filename with extension
      $filenameWithExt= $req->file('cover_image')->getClientOriginalName();
      //get just filename
      $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
      // get extension
      $extension=$req->file('cover_image')->getClientOriginalExtension();
      // create new file name
      $filenameTostore=$filename.'_'.time().'.'.$extension;

      // upload image
      $path=$req->file('cover_image')->storeAs('public/album_cover',$filenameTostore);

      $album=new Album;
      $album->name=$req->input('name');
      $album->description=$req->input('description');
      $album->cover_image=$filenameTostore;
      $album->save();
      return redirect(url(''))->with('success','Album Created');
    }
    public function show($id){
      $album=Album::with('Photos')->find($id);
      return view('albums.show')->with('album',$album);

    }
}
