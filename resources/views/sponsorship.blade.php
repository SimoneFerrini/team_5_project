@extends('layouts.app')
@section('content')
    {{-- inizio pagamento braintree --}}

{{-- inizio sezione errori pagamento --}}
@if (session('success_message'))
<div class="alert alert-success">
    {{ session('success_message') }}
</div>
@endif

@if(count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
{{-- fine errori --}}
{{-- inizio form --}}
<div class="container text-center my-5">
    
    <form method="post" id="payment-form" action="{{ route('sponsorship.checkout', $house->id)  }}">
        @csrf
        <label for="amount">
            <span>Sponsorizzazioni:</span>
            <select id="amount" name="amount" class="form-select form-select-lg mb-3" aria-label=".form-select-lg example">
                <option value="2.99">Gold - 2.99€</option>
                <option value="5.99">Platinum - 5.99€</option>
                <option value="9.99">Diamond - 9.99€</option>
            </select>              
        </label>
        {{-- questo è il dropin da cambiare --}}
        <div style="width: 300px; margin: auto">
            <div class="bt-drop-in-wrapper">
                <div id="bt-dropin"></div>
            </div>
        </div>
        <input id="nonce" name="payment_method_nonce" type="hidden"/>
        <button class="pay_btn" type="submit"><span>Paga ora</span></button>
    </form>
    <a href="{{route('houses.show', $house)}}"><button class="btn">Indietro</button></a>
</div>
{{-- fine form --}}
{{-- script per il drop in dei pagamenti fornito da braintree --}}
<script src="https://js.braintreegateway.com/web/dropin/1.38.1/js/dropin.min.js"></script>

{{-- script per far funzionare il pagamento --}}
<script>
  var form = document.querySelector('#payment-form');
  var client_token = "{{ $token }}";

  braintree.dropin.create({
  authorization: client_token,
  selector: '#bt-dropin',
  paypal: {
      flow: 'vault'
  }
  }, function (createErr, instance) {
  if (createErr) {
      console.log('Create Error', createErr);
      return;
  }
  form.addEventListener('submit', function (event) {
      event.preventDefault();

      instance.requestPaymentMethod(function (err, payload) {
      if (err) {
          console.log('Request Payment Method Error', err);
          return;
      }
      document.querySelector('#nonce').value = payload.nonce;
      form.submit();
      });
  });
  });
</script>
@endsection