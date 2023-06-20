@extends('layouts.app')
@section('content')
<div class="container mt-5">
    <form action="{{route('houses.store')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="input-group mb-3">
            <div id="img-validation" class="d-flex flex-column " style="color: red; font-size: .8em">
                <input name="thumbnail" type="file" class="form-control @error('thumbnail') is-invalid @enderror" id="inputGroupFile02" onchange="validateSize(this)" required>
            </div>
            @error('thumbnail')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span for="title" class="input-group-text" id="inputGroup-sizing-default">Nome *</span>
            <input value="{{old('title')}}" name="title" id="title" type="text" class="form-control @error('title') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('title')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Descrizione *</span>
            <textarea name="description" class="form-control @error('description') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>{{old('description')}}</textarea>
            @error('description')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Stanze *</span>
            <input value="{{old('rooms')}}" name="rooms" type="number" min="1" max="50" class="form-control @error('rooms') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('rooms')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Letti *</span>
            <input value="{{old('beds')}}" name="beds" type="number" min="1" max="30" class="form-control @error('beds') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('beds')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Bagni *</span>
            <input value="{{old('bathrooms')}}" name="bathrooms" type="number" min="1" max="15" class="form-control @error('bathrooms') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('bathrooms')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Metri quadrati *</span>
            <input value="{{old('square_mt')}}" name="square_mt" type="number" min="1" max="32000" class="form-control @error('square_mt') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('square_mt')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Indirizzo *</span>
            <input value="{{old('street')}}" name="street" type="text" class="form-control @error('street') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('street')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Numero Civico *</span>
            <input value="{{old('house_number')}}" name="house_number" type="number" min="1" max="32000" class="form-control @error('house_number') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('house_number')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">Città *</span>
            <input value="{{old('city')}}" name="city" type="text" class="form-control @error('city') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('city')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="inputGroup-sizing-default">CAP *</span>
            <input value="{{old('postal_code')}}" name="postal_code" type="number" minlength="5" maxlength="5" class="form-control @error('postal_code') is-invalid @enderror" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default" required>
            @error('postal_code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="input-group mb-3">
            <div name="latitude" id="latitude" type="text" class=" @error('latitude') is-invalid @enderror"></div>
            @error('latitude')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="container d-flex flex-wrap gap-3 pb-4">
            @foreach ($services as $service)   
            <div class="form-check d-flex gap-3">
                <input name="services[]" class="form-check-input" type="checkbox" value="{{$service->id}}" id="flexCheckDefault" @checked(in_array($service->id, old('services', [])))>
                <label class="form-check-label" for="flexCheckDefault">
                    <i class="{{$service->icon}}"></i> <span>{{$service->name}}</span>
                </label>
                
            </div>
            @endforeach
        </div>
            <div class="form-check form-switch pb-4">
                <input name="visibility" class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckChecked" checked>
                <label class="form-check-label" for="flexSwitchCheckDefault">Visibilità</label>
            </div>              
        <button type="submit" class="btn btn-secondary" id="btnLoad" value="Load">Aggiungi</button>
        <hr>
        <span>* I campi sono obbligatori!</span>
    </form>
</div>
<script>
//     document.getElementById("btnLoad").addEventListener("click", function showFileSize() {
//     if (!window.FileReader) { // questo controllo è solo per il caso RARISSIMO in cui il browser non supporti il tipo di file
//         console.log("Questo file API non è supportato dal browser");
//         return;
//     }
//     let input = document.getElementById('inputGroupFile02');
//     if (!input.files) { // questo controllo è solo per il caso RARISSIMO in cui il browser non supporti il tipo di file
//         console.error("Questo browser non supporta il tipo di file");
//     } else if (!input.files[0]) {
//         addPara("Devi scegliere un'immagine prima di poter caricare la tua casa");
//     } else {
//         let file = input.files[0];
//         addPara("Il file " + file.name + " è di " + file.size + " bytes e non può essere più grande di 2Mb");
//     }
// });

// function addPara(text) {
//     if(document.getElementById('img-error')){
//         let error = document.getElementById('img-error');
//         error.remove();
//     } 
//     let p = document.createElement("p");
//     p.textContent = text;
//     p.setAttribute('id', 'img-error');
//     let imgValidation = document.getElementById('img-validation');
//     imgValidation.append(p);
// }

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

