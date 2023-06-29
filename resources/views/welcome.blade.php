

@extends('layouts.app')
@section('content')
<div class="container my-5">
  <h1 class="text-center">I Tuoi Appartamenti</h1>

  

    <div class="d-flex justify-content-center my-4">
        <a href="{{route('houses.create')}}"> 
          <button id="create_btn">
            <span>
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                <path fill="none" d="M0 0h24v24H0z"></path>
                <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
              </svg> Aggiungi una casa
            </span>
          </button>
        </a>
    </div>
    
    <div class="container d-flex flex-wrap justify-content-center gap-5 pt-3">
        @foreach ($houses as $house)
        <a href="{{route('houses.show', $house)}}" class="link-light">
          <div id="welcome_card" class="card {{$house->visibility ? '' : 'no-visibility' }}" style="width: 18rem;">

              <div class="img_container">
                <div class="my_show">MOSTRA</div>

                <img id="welcome_img" src="{{asset('storage/'. $house->thumbnail)}}" class="card-img-top" alt="Immagine di copertina">


              </div>
              <div class="card-body">
                <div class="wrapper-sponsor-show d-flex align-items-center gap-3">
                  <h5 class="card-title" style="margin: 0"><strong>{{$house->title}}</strong></h5>
                  @if($house->sponsorship)
                  <i class="fa-solid fa-star fa-beat fa-xs" style="color: #f8df07;"></i>
                  @endif
                </div>
                <p class="card-text">{{Str::limit($house->description, 20)}}</p>
              </div>
  
              <ul class="list-group list-group-flush">
                <li class="list-group-item">Stanze : {{$house->rooms}}</li>
                <li class="list-group-item">Bagni : {{$house->bathrooms}}</li>
                <li class="list-group-item">M&sup2;: {{$house->square_mt}}</li>
                <li class="list-group-item">Servizi: 
                @foreach ($house->services as $singleService)
                    <i class="{{$singleService->icon}} px-1"></i> 
                @endforeach
                </li>
              </ul>
  
              <div id="my_visibility">
               
                <span>Visibile: </span>
                <form action="{{ route('visibility.index', $house) }}" method="POST">
                  @csrf

                  <div class="form-check form-switch">
                    <label class="switch">
                      <input name="visibility" class="form-check-input submitCheckbox" type="checkbox" role="switch" {{  $house->visibility ? "checked" : "" }}>
                      <span class="slider"></span>
                    </label>
                  </div>
                </form>
              </div>
  
          </div>
        </a>
        @endforeach
    </div>
    <div class="d-flex justify-content-center my-4">
      <a href="{{route('houses.create')}}"> 
        <button id="create_btn">
          <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
              <path fill="none" d="M0 0h24v24H0z"></path>
              <path fill="currentColor" d="M11 11V5h2v6h6v2h-6v6h-2v-6H5v-2z"></path>
            </svg> Aggiungi una casa
          </span>
        </button>
      </a>
    </div>
    
    <script>
      let checkboxes = document.querySelectorAll(".submitCheckbox");

      checkboxes.forEach(function(checkbox) { checkbox.addEventListener('click', function() {
        this.closest('form').submit();
      });
    });
    
    </script>



</div>
@endsection

