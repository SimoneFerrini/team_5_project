@extends('layouts.app')
@section('content')

<div class="container mt-5">
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
  <span class="alert alert-warning d-flex align-items-center" role="alert">
    <svg class="bi flex-shrink-0 me-2" role="img" aria-label="Warning:"><use xlink:href="#exclamation-triangle-fill"/></svg>
    <span>
      Non è possibile modificare proprietà inserite da altri utenti.
    </span>
  </span>  
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