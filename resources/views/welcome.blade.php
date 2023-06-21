

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

            
            <div class="card-body d-flex gap-3 align-items-center">
              <div class="container d-flex align-items-center gap-2">
                <button class="btn btn-secondary"><a href="{{route('houses.show', $house)}}" class="link-light">Guarda la tua casa</a></button> 
              </div>
              <form action="{{ route('visibility.index', $house) }}" method="POST">
                @csrf
                <div class="form-check form-switch">
                  <input name="visibility" class="form-check-input submitCheckbox" type="checkbox" role="switch" {{  $house->visibility ? "checked" : "" }}>
                </div>
              </form>
            </div>
          </div>
        @endforeach
    </div>
    <div class="d-grid gap-2 col-6 mx-auto mt-3 mb-3">
      <a href="{{route('houses.create')}}" class="link-light w-100"><button class="btn btn-secondary w-100" type="button">Aggiungi una casa</button></a>
    </div>
    
    <script>
      let checkboxes = document.querySelectorAll(".submitCheckbox");

      checkboxes.forEach(function(checkbox) { checkbox.addEventListener('click', function() {
        this.closest('form').submit();
      });
  });
    </script>
@endsection

