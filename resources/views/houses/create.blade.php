@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <form action="{{route('houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <span for="title" class="input-group-text" id="inputGroup-sizing-default">Nome</span>
            <input name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            @error('title')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
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
        <div class="container d-flex flex-wrap gap-3 pb-4">
            @foreach ($services as $service)   
            <div class="form-check d-flex gap-3">
                <input name="services[]" class="form-check-input" type="checkbox" value="{{$service->id}}" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                    <i class="{{$service->icon}}"></i> <span>{{$service->name}}</span>
                </label>
            </div>
            @endforeach
        </div>
            <div class="form-check form-switch pb-4">
                <input name="visibility" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Visibilità</label>
            </div>              
        <button type="submit" class="btn btn-secondary">Aggiungi</button>
    </form>
</div>
@endsection