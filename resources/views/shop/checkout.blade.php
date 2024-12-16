<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout Page</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: #f8fafc;
    }

    .checkout-container {
      max-width: 1100px;
      margin: 2rem auto;
      padding: 1rem;
      background-color: #fff;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
    }

    .checkout-header {
      margin-bottom: 1rem;
      font-size: 1.8rem;
      color: #1e293b;
    }

    .checkout-table {
      width: 100%;
      border-collapse: collapse;
      margin-bottom: 1.5rem;
    }

    .checkout-table th, .checkout-table td {
      padding: 1rem;
      text-align: center;
      border: 1px solid #d1d5db;
    }

    .checkout-table th {
      background-color: #f1f5f9;
      font-size: 1rem;
      color: #1e293b;
    }

    .checkout-table img {
      width: 60px;
      height: auto;
      border-radius: 5px;
    }

    .total-order {
      font-size: 1.2rem;
      font-weight: bold;
      color: #1e293b;
      margin-bottom: 1rem;
    }

    .pay-button {
      padding: 0.7rem;
      background-color: #073f58;
      color: white;
      border: none;
      border-radius: 5px;
      font-size: 1rem;
      cursor: pointer;
      transition: background-color 0.3s;
      align-self: flex-start;
    }

    .pay-button:hover {
      background-color: #0ea5e9;
    }

    .error-message {
      color: red;
      font-size: 0.9rem;
      display: none;
    }

    @media (max-width: 768px) {
      .checkout-container {
        width: 90%;
      }
    }
  </style>
</head>
<body>
  <div class="checkout-container">
    <h1 class="checkout-header">Checkout</h1>
    <table class="checkout-table">
      <thead>
        <tr>
          <th>Image</th>
          <th>Product</th>
          <th>Price</th>
          <th>Quantity</th>
          <th>Total</th>
        </tr>
      </thead>
      <tbody>
        @foreach($order_detail as $item)
        <tr>
          <td><img src="{{ asset('storage/' . $item->item->image) }}" alt="{{ $item->item->name }}"></td>
          <td>{{ $item->item->name }}</td>
          <td>Rp. {{ number_format($item->item->price) }}</td>
          <td>{{ $item->qty }}</td>
          <td>Rp. {{ number_format($item->price * $item->qty) }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
    <p>pesanan akan dikirim ke  : {{$order->customer->address}}</p>
    <p class="total-order">Total Order: <span>Rp. {{ number_format($order->total_order) }}</span></p>
    <form class="checkout-form" onsubmit="return false">
      <div class="form-group">
      </div>
      <button id="pay-button" class="pay-button">Pay Now</button>
      <p id="error-message" class="error-message">Please provide a valid Snap Token.</p>
    </form>
  </div>

  <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
  <script>
    var payButton = document.getElementById('pay-button');
    var errorMessage = document.getElementById('error-message');


    payButton.addEventListener('click', function () {
      var snapToken = localStorage.getItem('snapToken');

      if (!snapToken) {
        errorMessage.style.display = 'block';
        return;
      }

      errorMessage.style.display = 'none';

      // Trigger Midtrans Snap payment
      snap.pay(snapToken, {
        onSuccess: function (result) {
          window.location.href = "{{route('kurangi')}}";
          console.log('Payment Success:', result);
          alert('Payment Successful!');
        },
        onPending: function (result) {
          console.log('Payment Pending:', result);
          alert('Payment is Pending. Please complete the transaction.');
        },
        onError: function (result) {
          console.error('Payment Error:', result);
          alert('Payment Failed. Please try again.');
        }
      });
    });
  </script>
</body>
</html>
