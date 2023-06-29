@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="upload_image">

  <div class="my-thumb">
    <img src="{{asset('storage/'. $house->thumbnail)}}" alt="thumb">

  </div>

      <div class="w-100 container mx-auto my-5">
        <form action="{{ route('images.store', $house->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h1 class="text-center">Carica altre immagini</h1>
          <hr>
          <div>
            <input type="file" name="images[]" multiple class="choose_img">
          </div>
  
          <hr>
  
          <div class="upload_images_btns">
            <button type="submit">Invia</button>
            <a href="{{route('houses.show', $house)}}"><button class="annulla">Annulla</button></a>
  
          </div>
  
        </form>

      </div>
  
      </div>

</div>
@endif



@endsection
