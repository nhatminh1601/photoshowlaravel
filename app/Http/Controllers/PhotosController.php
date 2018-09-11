<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
    public function create($album_id){
      return view('photos.create')->with('album_id',$album_id);
    }
    public function store(Request $req){
      $this->validate($req,[
        'title'=>'required',
        'photo'=>'image|max:1999',
      ]);

      // get filename with extension
      $filenameWithExt= $req->file('photo')->getClientOriginalName();
      //get just filename
      $filename=pathinfo($filenameWithExt,PATHINFO_FILENAME);
      // get extension
      $extension=$req->file('photo')->getClientOriginalExtension();
      // create new file name
      $filenameTostore=$filename.'_'.time().'.'.$extension;

      // upload image
      $path=$req->file('photo')->storeAs('public/photo/'.$req->input('album_id'),$filenameTostore);

      $photo=new Photo;
      $photo->album_id=$req->input('album_id');
      $photo->title=$req->input('title');
      $photo->description=$req->input('description');
      $photo->size=$req->file('photo')->getClientSize();
      $photo->photo=$filenameTostore;
      $photo->save();

      return redirect(url('albums').'/'.$req->input('album_id'))->with('success','Photo Updated');
    }
    public function show($id){
      $photo=Photo::find($id);
      return view('photos.show')->with('photo',$photo);
    }
    public function destroy($id){
      $photo=Photo::find($id);
      if(Storage::delete('storage/app/public/photo/'.$photo->album_id.'/'.$photo->photo)){
        $photo->delete();
        return redirect('/')->with('success','Photo Delete');
      }

    }
}
