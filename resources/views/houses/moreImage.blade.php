@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="container">
  <h1>Casa aggiunta con successo!</h1>
  <h3>Vuoi aggiungere altre immagini?</h3>
  <button class="btn btn-secondary"><a href="{{route('image.create', $house)}}" class="link-light">Si</a></button>
  <button class="btn btn-secondary"><a href="{{route('houses.show', $house)}}" class="link-light">No</a></button>


</div>
@endif
@endsection

