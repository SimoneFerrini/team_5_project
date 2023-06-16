@extends('layouts.app')
@section('content')
<div class="container pt-3 d-flex align-items-center flex-column">
      @if($house->user_id != $user_id)
      <span>Non puoi visualizzare questa casa!</span>
      @else
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
      </div>
      <hr>
      <button class="btn btn-secondary mb-3"><a href="{{route('houses.edit', $house)}}" class="link-light">Modifica la tua casa</a></button>
      <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#exampleModalCenter">
        Cancella casa
      </button>
      @endif
</div>

    {{-- Modal --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler cancellare la casa?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            Attenzione! L'azione sarà irreversibile.
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Annulla</button>
            <form action="{{route('houses.destroy', $house)}}" method="POST">
              @csrf
              @method('DELETE')

              <button class="btn btn-danger" type="submit">DELETE</button>
          </form>
          </div>
        </div>
      </div>
  
</div>
@endsection