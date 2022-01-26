@extends('frontview.master')
@section('title', 'Donation')
@section('scripts')
<script src="https://js.stripe.com/v3/"></script>


@endsection
@section('content')
<style>
    /**
 * The CSS shown here will not be introduced in the Quickstart guide, but shows
 * how you can use CSS to style your Element's container.
 */
.StripeElement {
  box-sizing: border-box;
  height: 40px;
  padding: 10px 12px;
  border: 1px solid transparent;
  border-radius: 4px;
  background-color: white;
  box-shadow: 0 1px 3px 0 #e6ebf1;
  -webkit-transition: box-shadow 150ms ease;
  transition: box-shadow 150ms ease;
}
.StripeElement--focus {
  box-shadow: 0 1px 3px 0 #cfd7df;
}
.StripeElement--invalid {
  border-color: #fa755a;
}
.StripeElement--webkit-autofill {
  background-color: #fefde5 !important;}
</style>
<main id="main">
  <!-- ======= Breadcrumbs Section ======= -->
  <section class="breadcrumbs">
    <div class="container">

      <div class="d-flex justify-content-between align-items-center">
        <h2>Donation</h2>
      </div>

    </div>
  </section>
  <!-- End Breadcrumbs Section -->

  <div class="col-sm-9 col-md-7 col-lg-4 mx-auto" style="min-height: 79vh">
      <div class="card border-0 shadow rounded-3 my-5">
        <div class="card-body p-4 p-sm-5">
         <img src="{{asset('frontview/assets/img/logo-3.png')}}" class="img-fluid" style="margin:10px" height="90px" alt="logo">
          @if ($errors->any())
              <div class="alert alert-danger" role="alert">
                  @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                  @endforeach
              </div>
          @endif
          @if(session('success'))
              <div class="alert alert-success" role="alert">
                  {{session('success')}}
              </div>
          @endif

          <form method="POST" action="{{ route('submit.donation') }}" id="payment-form">
              @csrf
              <div class="form-floating mb-3">
                  <input type="text" class="form-control" value="{{old('name')}}" name="name"  id="name" oninput="this.value = this.value.toUpperCase()" required>
                  <label for="name">Name</label>
              </div>

              <div class="form-floating mb-3">
                  <input type="email" class="form-control" value="{{old('email')}}" name="email"  id="email" required>
                  <label for="email">Email </label>
              </div>

              <div class="input-group mb-3">
                <span class="input-group-text"  id="amount">Donation Amount (RM)</span>
                <input type="text" name="amount"  onkeypress='validate(event)' class="form-control" placeholder="RM" id="amount" aria-describedby="basic-addon1">
              </div>
              

              <div class="form-row">
                <label for="card-element">
                Credit or debit card
                </label>

                <div id="card-element">
                    <!-- A Stripe Element will be inserted here. -->
                </div>
                <!-- Used to display form errors. -->
                <div id="card-errors" role="alert"></div>
                </div>
                <br>

                  <div class="d-grid">
                      <button class="btn btn-primary btn-login " type="submit">Donate now </button>
                  </div>
          </form>
        </div>
      </div>
    </div>


</main><!-- End #main -->


@endsection

@section('js')
<script type="text/javascript">
    // Create a Stripe client.
var stripe = Stripe('pk_test_51IUTWzALc6pn5BvMAUegqRHV0AAokjG7ZuV6RWcj5rxB9KCAwamgtWpw9T4maGAe34WmDkD6LSn1Yge3nzex6gYk004pILHsNh');
// Create an instance of Elements.
var elements = stripe.elements();
// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
var style = {
  base: {
    color: '#32325d',
    fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
    fontSmoothing: 'antialiased',
    fontSize: '16px',
    '::placeholder': {
      color: '#aab7c4'
    }
  },
  invalid: {
    color: '#fa755a',
    iconColor: '#fa755a'
  }
};
// Create an instance of the card Element.
var card = elements.create('card', {style: style});
// Add an instance of the card Element into the `card-element` <div>.
card.mount('#card-element');
// Handle real-time validation errors from the card Element.
card.on('change', function(event) {
  var displayError = document.getElementById('card-errors');
  if (event.error) {
    displayError.textContent = event.error.message;
  } else {
    displayError.textContent = '';
  }
});
// Handle form submission.
var form = document.getElementById('payment-form');
form.addEventListener('submit', function(event) {
  event.preventDefault();
  stripe.createToken(card).then(function(result) {
    if (result.error) {
      // Inform the user if there was an error.
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    } else {
      // Send the token to your server.
      stripeTokenHandler(result.token);
    }
  });
});
// Submit the form with the token ID.
function stripeTokenHandler(token) {
  // Insert the token ID into the form so it gets submitted to the server
  var form = document.getElementById('payment-form');
  var hiddenInput = document.createElement('input');
  hiddenInput.setAttribute('type', 'hidden');
  hiddenInput.setAttribute('name', 'stripeToken');
  hiddenInput.setAttribute('value', token.id);
  form.appendChild(hiddenInput);
  // Submit the form
  form.submit();
}
</script>

<script>
  function validate(evt) {
  var theEvent = evt || window.event;

  // Handle paste
  if (theEvent.type === 'paste') {
      key = event.clipboardData.getData('text/plain');
  } else {
  // Handle key press
      var key = theEvent.keyCode || theEvent.which;
      key = String.fromCharCode(key);
  }
  var regex = /[0-9]|\./;
  if( !regex.test(key) ) {
    theEvent.returnValue = false;
    if(theEvent.preventDefault) theEvent.preventDefault();
  }
}
</script>

@endsection