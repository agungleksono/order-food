<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Order Food App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

    
    <!-- Custom styles for this template -->
    <link href="/styles/dashboard.css" rel="stylesheet">
  </head>
  <body>

<div class="container-fluid">
  <div class="row">
  <div class="mt-4 px-5">
      <h5 class="card-title">Daftar Pesanan</h5><hr>
      <p>Nama : {{ $user_name }}</p>
      <div class="table-responsive-sm">
        <table class="table table-hover">
        <thead>
          <tr>
            <th class="text-center">No.</th>
            <th>Nomor Pesanan</th>
            <th class="text-center">Nomor Meja</th>
            <th class="text-center">Total Harga</th>
          </tr>
        </thead>
        <tbody class="table-container">
        @foreach ($orders as $order)
          <tr>
            <th class="text-center">{{ $loop->iteration }}</th>
            <td>{{ $order->order_number }}</td>
            <td class="text-center">{{ $order->table_number }}</td>
            <td class="text-center">{{ $order->bill }}</td>            
          </tr>
        @endforeach
        </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

      <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script>
	  	<script src="/js/dashboard.js"></script>
      <script>
        window.print();
      </script>
  	</body>
</html>