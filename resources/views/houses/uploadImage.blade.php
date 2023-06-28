@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="container">
  <form action="{{ route('images.store', $house->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
    <h1>Carica altre immagini</h1>
    <div >
      <label>Scegli le immagini</label>
      <br>
      <input type="file"  name="images[]" multiple>
    </div>
    <br>
    <button type="submit">Invia</button>
  </form>
</div>
@endif
@endsection

