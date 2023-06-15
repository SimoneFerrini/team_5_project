@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-wrap">
        @foreach ($houses as $house)
        <div class="card" style="width: 18rem;">
            <img src="{{$house->thumbnail}}" class="card-img-top" alt="Immagine di copertina">
            <div class="card-body">
              <h5 class="card-title">{{$house->title}}</h5>
              <p class="card-text">{{$house->description}}</p>
            </div>
            <ul class="list-group list-group-flush">
              <li class="list-group-item">N° stanze: {{$house->rooms}}</li>
              <li class="list-group-item">N° bagni: {{$house->bathrooms}}</li>
              <li class="list-group-item">m&sup2;: {{$house->square_mt}}</li>
              <li class="list-group-item">Servizi: 
              @foreach ($house->services as $singleService)
                  <i class="{{$singleService->icon}}"></i> {{$singleService->name}}
              @endforeach
              </li>
            </ul>
            <div class="card-body">
              <a href="{{route('houses.show', $house)}}" class="card-link">Guarda la tua casa</a>
              <a href="#" class="card-link">Another link</a>
            </div>
          </div>
        @endforeach
    </div>
    <a href="{{route('houses.create')}}" class="btn btn-primary">Aggiungi una casa</a>
@endsection