@extends('layouts.app')
@section('content')
<div class="container mt-5">
  @if($house->user_id != $user_id)
  <!-- <span>Fatti una casa tua con blackjack e squillo di lusso!</span> -->
  <span>Non è possibile modificare case che non hai inserito.</span>
  @else

  <div class="my-container">
    <div class="img-container">
        <img src="{{asset('storage/'. $house->thumbnail)}}" alt="img">
    </div>
  </div>
  <form action="{{route('houses.update', $house)}}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
      @csrf
      @method('PUT')
      <div class="input-group mb-3">
        <div id="img-validation" class="d-flex flex-column " style="color: red; font-size: .8em">
            <input name="thumbnail" type="file" class="form-control" id="inputGroupFile02" onchange="validateSize(this)" >
        </div>
          @error('thumbnail')
          <div class="invalid-feedback">
              {{$message}}
            </div>
            @enderror
      </div>
      <div class="input-group mb-3">
          <span for="title" class="input-group-text" id="inputGroup-sizing-default">Nome</span>
          <input value="{{old('title') ?? $house->title}}" name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('title')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Descrizione</span>
          <textarea name="description" class="form-control @error('description') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>{{old('description') ?? $house->description}}</textarea>
          @error('description')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Stanze</span>
          <input value="{{old('rooms')?? $house->rooms}}" name="rooms" type="number" min="1" max="50" class="form-control @error('rooms') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('rooms')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Letti</span>
          <input value="{{old('beds')?? $house->beds}}" name="beds" type="number" min="1" max="30" class="form-control @error('beds') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('beds')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Bagni</span>
          <input value="{{old('bathrooms')?? $house->bathrooms}}" name="bathrooms" min="1" max="15" type="number" class="form-control @error('bathrooms') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('bathrooms')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Metri quadrati</span>
          <input value="{{old('square_mt')?? $house->square_mt}}" name="square_mt" type="number" min="1" max="32000" class="form-control @error('square_mt') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('square_mt')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Indirizzo</span>
          <input value="{{old('street')?? $house->street}}" name="street" type="text" class="form-control @error('street') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('street')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Numero Civico</span>
          <input value="{{old('house_number')?? $house->house_number}}" name="house_number" type="number" min="1" max="32000" class="form-control @error('house_number') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('house_number')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
          <span class="input-group-text" id="inputGroup-sizing-default">Città</span>
          <input value="{{old('city')?? $house->city}}" name="city" type="text" class="form-control @error('city') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
          @error('city')
              <div class="invalid-feedback">
                  {{$message}}
              </div>
          @enderror
          <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
      </div>
      <div class="input-group mb-3">
        <span class="input-group-text" id="inputGroup-sizing-default">CAP</span>
        <input value="{{old('postal_code')?? $house->postal_code}}" name="postal_code" type="number" minlength="5" maxlength="5"  class="form-control @error('postal_code') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
        @error('postal_code')
            <div class="invalid-feedback">
                {{$message}}
            </div>
        @enderror
        <div class="input-group-prepend">
                <span class="input-group-text">*</span>
            </div>
        </div>
        <div class="input-group mb-3">
            <div name="latitude" id="latitude" type="text" class=" @error('latitude') is-invalid @enderror"></div>
            @error('latitude')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <span> * Servizi:</span>
      <div class="container d-flex flex-wrap gap-3 pb-4" id="services-container">
          @foreach ($services as $service)
          <div class="form-check d-flex gap-3">
              @if($errors->any())
              <input name="services[]" class="form-check-input" type="checkbox" value="{{$service->id}}" id="flexCheckDefault" @checked(in_array($service->id, old('services', [])))>
              @else
              <input name="services[]" class="form-check-input" type="checkbox" value="{{$service->id}}" id="flexCheckDefault" @checked($house->services->contains($service->id))>
              @endif
              <label class="form-check-label" for="flexCheckDefault">
                  <i class="{{$service->icon}}"></i> <span>{{$service->name}}</span>
              </label>
              
          </div>
          @endforeach
      </div>       
      <button type="submit" class="btn btn-secondary" id="btnLoad" value="Load">Modifica</button>
      <hr>
      <span>* I campi sono obbligatori!</span>
  </form>
  @endif
</div>
<script>
function validateSize(input) {
  const fileSize = input.files[0].size / 1024 / 1024; // in MiB
  if (fileSize > 2) {
    alert('Il file non può essere più grande di 2mb');
  } else {
    // Proceed further
  }
}
</script> 
@endsection


<script>
    function validateForm() {
        var checkboxes = document.querySelectorAll('#services-container input[type="checkbox"]');
        var isChecked = false;
    
        for (var i = 0; i < checkboxes.length; i++) {
            if (checkboxes[i].checked) {
                isChecked = true;
                break;
            }
        }
    
        if (!isChecked) {
            alert('Seleziona almeno un servizio!');
            return false; // Impedisce l'invio del modulo se nessuna casella di controllo è stata spuntata
        }
    
        return true; // Invia il modulo se almeno una casella di controllo è stata spuntata
    }
    </script>