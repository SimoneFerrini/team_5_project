@extends('layouts.app')
@section('content')
@if($house->user_id != $logged_user_id)
  <span>Non puoi visualizzare questa casa!</span>
@else
<div class="upload_image">

  <div class="my-thumb">
    <img src="{{asset('storage/'. $house->thumbnail)}}" alt="thumb">

  </div>

  <div class="house_images">
      @foreach ($images as $singleImage)
      <div class="single_image">
        <img src="{{asset('/'.$singleImage->path)}}" alt="img">

        <div class="house_images_btn">
              <button type="submit" data-toggle="modal" data-target="#modalMessageDelete">
                  Elimina foto
              </button>       
        </div>

      </div>
      
      @endforeach

      <div class="w-100 container mx-auto my-5">
        <form action="{{ route('images.store', $house->id) }}" method="POST" enctype="multipart/form-data">
          @csrf
          <h1 class="text-center">Carica altre immagini</h1>
          <hr>
          <div>
            <input type="file" name="images[]" multiple class="choose_img">
          </div>
  
          <hr>
  
          <div class="upload_images_btns">
            <button type="submit">Invia</button>
            <a href="{{route('houses.show', $house)}}"><button class="annulla">Annulla</button></a>
  
          </div>
  
        </form>

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
  
      </div>

</div>
@endif



@endsection
