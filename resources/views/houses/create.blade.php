@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <form action="{{route('houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
            <input name="title" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Descrizione</span>
            <textarea name="description" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default"></textarea>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Stanze</span>
            <input name="rooms" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Letti</span>
            <input name="beds" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Bagni</span>
            <input name="bathrooms" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Metri quadrati</span>
            <input name="square_mt" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Indirizzo</span>
            <input name="street" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Numero Civico</span>
            <input name="house_number" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Città</span>
            <input name="city" type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
        </div>
        <div class="input-group mb-3">
            <input name="thumbnail" type="file" class="form-control" id="inputGroupFile02">
        </div>
        <button type="submit" class="btn btn-secondary">Aggiungi</button>
    </form>
</div>
@endsection