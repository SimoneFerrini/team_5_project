@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="container">
  <img src="{{asset('storage/'. $house->thumbnail)}}" alt="thumb">
  <form action="{{ route('images.store', $house->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    <h1>Carica altre immagini</h1>
    <div >
      <label>Scegli le immagini</label>
      <br>
      <input type="file"  name="images[]" multiple>
    </div>
    <br>
    <div class="d-flex">
      @foreach ($images as $singleImage)
      <img class="w-50" src="{{asset('/'.$singleImage->path)}}" alt="img">
          
      @endforeach
  
    </div>
    <button type="submit">Invia</button>
    <a href="{{route('houses.show', $house)}}"><button>Annulla</button></a>
  </form>

</div>
@endif
@endsection

