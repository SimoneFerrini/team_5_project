@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="container my-5 w-100 mx-auto text-center">
  <h1>Casa aggiunta con successo!</h1>
  <h3 class="my-5">Vuoi aggiungere altre immagini?</h3>
  <a href="{{route('image.create', $house)}}"><button class="orange_btn">Si</button></a>
  <a href="{{route('houses.show', $house)}}"><button class="green_btn">No</button></a>


</div>
@endif
@endsection

