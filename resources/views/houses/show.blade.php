@extends('layouts.app')
@section('content')

@if($house->user_id != $user_id)
<svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
  <symbol id="check-circle-fill" viewBox="0 0 16 16">
    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
  </symbol>
  <symbol id="info-fill" viewBox="0 0 16 16">
    <path d="M8 16A8 8 0 1 0 8 0a8 8 0 0 0 0 16zm.93-9.412-1 4.705c-.07.34.029.533.304.533.194 0 .487-.07.686-.246l-.088.416c-.287.346-.92.598-1.465.598-.703 0-1.002-.422-.808-1.319l.738-3.468c.064-.293.006-.399-.287-.47l-.451-.081.082-.381 2.29-.287zM8 5.5a1 1 0 1 1 0-2 1 1 0 0 1 0 2z"/>
  </symbol>
  <symbol id="exclamation-triangle-fill" viewBox="0 0 16 16">
    <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
  </symbol>
</svg>
<span class="container mt-5">
  <span class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <span class="text-center">
      Non puoi visualizzare le proprietà di un altro utente.
    </span>
  </span>  
</span>
  @else
@if(session()->has('success_message'))
<span class="alert alert-success text-center my-2">
    {{ session('success_message') }}
</span>
@endif
<div id="house_container">
  <!-- se l'utente non è il solito loggato -->
  
  
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
            </div>
            <div class="modal fade" id="modalMessageDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">Sei sicuro di voler eliminare la foto?</h5>
                      <button type="button" class="close btn" data-dismiss="modal" aria-label="Close">
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
         


      @endforeach

    </div>
    <!-- /altre_immagini -->

  </div>

  <!-- messggi e info -->
  <div id="right_container">

    <div class="info_container">
      <div class="info_body">
        <div class="sponsor-wrapper d-flex align-items-center gap-3">
          <h4 class="info_title" style="margin: 0">{{$house->title}}</h4>
          @if($house->sponsorship)
          <i class="fa-solid fa-star fa-beat" style="color: #f8df07;"></i>
          @endif
        </div>
        <p class="info_text">{{$house->description}}</p>
        <ul class="main_list">
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
        <div class="alert mt-2 {{($message->read) ? 'alert-dark' : 'alert-success'}} my_message" role="alert">
          <h4 style="display :{{($message->read) ? 'none' : 'block'}};" class="alert-heading">Nuovo messaggio!</h4>
          <p style="{{($message->read) ? 'alert-dark' : 'alert-success'}}"></p>
          <p>{{$message->text}}</p>
          <hr>
          <p class="mb-0">Da: {{$message->email}}</p>

          <div class="message_btns">
            <form action="{{ route('messages.update', $message->id)}}" method="POST">
              @csrf
              @method('PUT')
              <button class="read_btn" type="submit">Segna come letto</button>
            </form>
            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#modalMessageDelete">
              Elimina messaggio
            </button>

          </div>
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


  <div  class="container d-flex align-items-center flex-column">
    <div style="width: 18rem;">
      <hr>
    </div>
      <div id="pulsanti" class="d-flex gap-2 align-content-center">
        <button class="btn btn-warning mb-3"><a href="{{route('sponsorship.index', $house)}}" class="link-light">Sponsorizza</a></button>
        <button class="btn btn-secondary mb-3"><a href="{{route('houses.edit', $house)}}" class="link-light">Modifica la tua casa</a></button>
        <button class="btn btn-secondary mb-3"><a href="{{route('image.create', $house)}}" class="link-light">Aggiungi foto</a></button>
        <button class="btn btn-secondary mb-3"><a href="{{route('welcome', $house)}}" class="link-light">Indietro</a></button>
        <button type="submit" class="btn btn-danger mb-3" data-toggle="modal" data-target="#exampleModalCenter" id="btn-elimina-casa">Elimina casa</button>
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