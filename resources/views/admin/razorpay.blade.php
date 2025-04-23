<!DOCTYPE html>
<html>
<head>
    <title>Razorpay Payment</title>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
</head>
<body>
    <button id="rzp-button1">Pay with Razorpay</button>
    <form id="razorpay-form" action="{{ route('payment.complete') }}" method="POST">
        @csrf
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_order_id" id="razorpay_order_id">
        <input type="hidden" name="razorpay_signature" id="razorpay_signature">
        <input type="hidden" name="amount" value="{{ $order->amount / 100 }}"> <!-- Pass amount in rupees -->
    </form>

    <script>
        var options = {
            "key": "{{ env('RAZORPAY_KEY') }}", // Your Razorpay Key ID
            "amount": "{{ $order->amount }}", // Amount in paise
            "currency": "{{ $order->currency }}",
            "name": "Your App Name",
            "description": "Order #{{ $order->id }}",
            "order_id": "{{ $order->id }}", // Razorpay Order ID
            "handler": function (response){
                document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                document.getElementById('razorpay_order_id').value = response.razorpay_order_id;
                document.getElementById('razorpay_signature').value = response.razorpay_signature;
                document.getElementById('razorpay-form').submit();
            },
            "prefill": {
                "name": "{{ auth()->user()->name }}", // Prefill user name
                "email": "{{ auth()->user()->email }}" // Prefill user email
            }
        };
        
        var rzp1 = new Razorpay(options);
        
        document.getElementById('rzp-button1').onclick = function(e){
            rzp1.open();
            e.preventDefault();
        }
    </script>
</body>
</html>
