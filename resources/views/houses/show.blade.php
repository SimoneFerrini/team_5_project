@extends('layouts.app')
@section('content')

<div id="house_container">
  <!-- se l'utente non è il solito loggato -->
  @if($house->user_id != $user_id)
  <span>Non puoi visualizzare questa casa!</span>

  <!-- se l'utente è il solito loggato -->
  @else

  <!-- gruppo delle immagini -->
  <div id="images_container">

    <!-- thumbnail -->
    <div class="my-thumb">
      <img src="{{asset('storage/'. $house->thumbnail)}}" class="card-img-top" alt="Immagine di copertina">
    </div>
    <!-- /thumbnail -->

    <!-- altre_immagini -->
    <div class="house_images">

      @foreach($images as $singleImage)


          <div class="single_image">
            <img src="http://127.0.0.1:8000/{{$singleImage->path}}" alt="img">
            <div class="house_images_btn">
              <button type="submit" data-toggle="modal" data-target="#modalMessageDelete">
                  Elimina foto
              </button>
              <!-- inizio modale per eliminare foto -->
              <div class="modal fade" id="modalMessageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare la foto?</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&Chi;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      Attenzione! L'azione sarà irreversibile.
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
                      <form action="{{route('image.destroy', $singleImage->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
              
                        <button class="btn btn-danger" type="submit">Elimina</button>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              
              
              
              
            </div>

          </div>
         


      @endforeach

    </div>
    <!-- /altre_immagini -->

  </div>


  <div id="right_container">

    <div class="info_container">
      <div class="info_body">
        <h4 class="info_title">{{$house->title}}</h4>
        @if($house->sponsorship)
        <i if class="fa-solid fa-star-of-david fa-spin"></i>
        @endif
        <p class="info_text">{{$house->description}}</p>
        <ul>
          <li>Stanze: {{$house->rooms}}</li>
          <li>Bagni: {{$house->bathrooms}}</li>
          <li>M&sup2;: {{$house->square_mt}}</li>
          <li>Servizi: 
            <ul>

              @foreach ($house->services as $singleService)
      
                <li>
                  <i class="{{$singleService->icon}}"></i>
                  <span> {{$singleService->name}}</span>
                </li>
              
              
              @endforeach
            </ul>
          </li>
        </ul>
      </div>

    </div>

    <div class="message_container">

      @foreach ($messages as $message)
      <div class="message ">
        <div class="alert mt-2 {{($message->read) ? 'alert-dark' : 'alert-success'}}" role="alert">
          <h4 style="display :{{($message->read) ? 'none' : 'block'}};" class="alert-heading">Nuovo messaggio!</h4>
          <p style="{{($message->read) ? 'alert-dark' : 'alert-success'}}"></p>
          <p>{{$message->text}}</p>
          <hr>
          <p class="mb-0">Da: {{$message->email}}</p>
          <form action="{{ route('messages.update', $message->id)}}" method="POST">
            @csrf
            @method('PUT')
            <button class="mt-2" type="submit">Segna come letto</button>
          </form>
          <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalMessageDelete">
            Elimina messaggio
          </button>
          <div class="modal fade" id="modalMessageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare il messaggio?</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&Chi;</span>
                  </button>
                </div>
                <div class="modal-body">
                  Attenzione! L'azione sarà irreversibile.
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
                  <form action="{{route('messages.destroy', $message->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
          
                    <button class="btn btn-danger" type="submit">Elimina</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      @endforeach
    </div>


  </div>


</div>


<div class="container pt-3 d-flex align-items-center flex-column">
  <div class="card" style="width: 18rem;">
   
    
  </div>
  

  <hr>
  <div class="d-flex justify-content-center flex-row w-75 mx-auto align-content-center gap-4">
    <div>
      <button class="btn btn-warning mb-3"><a href="{{route('sponsorship.index', $house)}}" class="link-light">Sponsorizza</a></button>
    </div>
    <div class="d-flex gap-2">
      <button class="btn btn-secondary mb-3"><a href="{{route('houses.edit', $house)}}" class="link-light">Modifica la tua casa</a></button>
      <button class="btn btn-secondary mb-3"><a href="{{route('image.create', $house)}}" class="link-light">Aggiungi foto</a></button>
    </div>
    <div class="d-flex gap-2 align-content-center">
      <button class="btn btn-secondary mb-3"><a href="{{route('welcome', $house)}}" class="link-light">Indietro</a></button>
      <button type="submit" class="btn btn-danger mb-3" data-toggle="modal" data-target="#exampleModalCenter" id="btn-elimina-casa">
        Elimina casa
      </button>
    </div>
  </div>
    @endif
 
</div>

    {{-- Modal --}}

<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare la casa?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&Chi;</span>
        </button>
      </div>
      <div class="modal-body">
        Attenzione! L'azione sarà irreversibile.
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Torna indietro</button>
        <form action="{{route('houses.destroy', $house)}}" method="POST">
          @csrf
          @method('DELETE')

          <button class="btn btn-danger" type="submit">Elimina</button>
      </form>
      </div>
    </div>
  </div>
</div>
@endsection