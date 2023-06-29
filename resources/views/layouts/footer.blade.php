@extends('layouts.app')
@section('footer')
<footer id="footer_back">
    <div id="footer">
        <!-- sinistra -->
        <div class="links">
            <ul class="pt-4">
            <li><a href="#">Lavora con noi</a></li>
            <li><a href="#">About Us</a></li>
            <li><a href="#">Contatti</a></li>
            <li><a href="#">Termini&Servizi</a></li>
            </ul>
        </div>
        <!-- /sinistra -->
        
        <!-- destra -->

        <div class="footer_right">
            {{-- <img class="long_logo" src="{{asset('images/logochiaro.png')}}" alt="logo"> --}}
            <img class="short_logo" src="{{asset('images/logo-bool.png')}}" alt="logo">

        </div>
        <!-- /destra -->
    </div>
     
</footer>
</div>
@endsection