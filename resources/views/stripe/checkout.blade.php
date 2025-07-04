





<!DOCTYPE html>
<html>
<head>
    <title>Payment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style type="text/css">
        #card-element{
            height: 50px;
            padding-top: 16px;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card mt-5">
               
                <div class="card-body">

                     @if(session('success'))
        <p style="color:green">{{ session('success') }}</p>
    @endif
    @if(session('error'))
        <p style="color:red">{{ session('error') }}</p>
    @endif
          
                    <form id='checkout-form' method='post' action="{{ route('stripe.charge',$service->id) }}">   
                        @csrf    

                        <strong>Name:</strong>
                            <input type="input" class="form-control" name="name" value="{{ $service->cleaningService->title ?? ''}}">
                         <input type="input" class="form-control" name="amount" placeholder="" value ="{{$service->amount }}">
                         <input type='hidden' name='service_id' value="{{ $service->id}}">
                        <input type='hidden' name='stripeToken' id='stripe-token-id'>                              
                        <br>
                        <div id="card-element" class="form-control" ></div>
                        <button 
                            id='pay-btn'
                            class="btn btn-success mt-3"
                            type="button"
                            style="margin-top: 20px; width: 100%;padding: 7px;"
                            onclick="createToken()">PAY $10
                        </button>
                    <form>
<br>
<br>
                    <button type='button' style="margin-top: 20px; width: 100%;padding: 7px;" class='btn btn-warning mt-3' value="Pay With Khalti" name='khalti' id='khalti'> Pay khalti </button>
                </div>
            </div>
        </div>
    </div> 
</div>
      
</body>
     
<script src="https://js.stripe.com/v3/"></script>
<script type="text/javascript">
  
    var stripe = Stripe('{{ env('STRIPE_KEY') }}')
    var elements = stripe.elements();
    var cardElement = elements.create('card');
    cardElement.mount('#card-element');
  
    /*------------------------------------------
    --------------------------------------------
    Create Token Code
    --------------------------------------------
    --------------------------------------------*/
    function createToken() {
        document.getElementById("pay-btn").disabled = true;
        stripe.createToken(cardElement).then(function(result) {
   
            if(typeof result.error != 'undefined') {
                document.getElementById("pay-btn").disabled = false;
                alert(result.error.message);
            }
  
            /* creating token success */
            if(typeof result.token != 'undefined') {
                document.getElementById("stripe-token-id").value = result.token.id;
                document.getElementById('checkout-form').submit();
            }
        });
    }


    $(document).ready(function () {
        $('#khalti').click(function (e) {
            e.preventDefault();

            $.ajax({
                url: '{{ route("khalti.init") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    // Add any additional data needed by your backend
                },
                success: function (response) {
                    const data = typeof response === 'string' ? JSON.parse(response) : response;

        console.log('Khalti Init Response:', data);

        if (data.payment_url) {
            window.location.href = data.payment_url;
        } else {
            alert('Payment URL not received from server.');
        }
                },
                error: function (xhr, status, error) {
                    console.error('Khalti Init Error:', xhr.responseText);
                }
            });
        });
    });


    
</script>
 
</html>








