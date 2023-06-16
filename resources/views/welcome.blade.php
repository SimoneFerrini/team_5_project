

@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-wrap justify-content-around gap-3 pt-3">
        @foreach ($houses as $house)
        <div class="card" style="width: 18rem;">
            <img src="{{asset('storage/'. $house->thumbnail)}}" class="card-img-top" alt="Immagine di copertina">
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
              <div class="container d-flex align-items-center gap-2">
                <button class="btn btn-secondary"><a href="{{route('houses.show', $house)}}" class="link-light">Guarda la tua casa</a></button> 
                <div class="form-check form-switch">
                  <input name="visibility" class="form-check-input" type="checkbox"  role="switch" id="flexSwitchCheckChecked" checked>
                </div>
              </div>
            </div>
          </div>
          <form action="{{ route('visibility.index', $house) }}" method="POST">
            @csrf
            <button type="submit">{{$house->visibility ? 'Visibile in pagina' : 'Non visibile in pagina'}}</button>
          </form>
        @endforeach
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-3">
      <button class="btn btn-secondary" type="button"><a href="{{route('houses.create')}}" class="link-light">Aggiungi una casa</a></button>
    </div>
@endsection

{{-- <form action="/houses" method="POST">
  <input type="hidded" name="houses_id" value="{{$house->visibility}}"/>
  <button type="submit">
    bottone
  </button>
</form> --}}
