<html>

  <head>
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{config('midtrans.client_key')}}"></script>
  </head>

  <body>
    <p>Input snap token retrieved from step 1 (Backend), then click Pay.</p>
    <form onsubmit="return false">
      <label for="snapToken">Snap Token:</label>
      <input type="text" id="snap-token">
      <button id="pay-button">Pay!</button>
    </form>

    <script type="text/javascript">
      var payButton = document.getElementById('pay-button');
      var snapToken = document.getElementById('snap-token');
      snapToken.value = localStorage.getItem("snapToken");

      // For example trigger on button clicked, or any time you need
      payButton.addEventListener('click', function() {
        snap.pay(localStorage.getItem("snapToken"));
      });

    </script>
  </body>

</html>