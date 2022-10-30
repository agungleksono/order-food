<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - Order Food App</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link href="/styles/signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
    <main class="form-signin w-100 m-auto">
    @if (session()->has('error'))
      <div class="card-body"><div class="alert alert-danger text-center" role="alert">
        {{ session('error') }}
      </div>
    @endif
      <h1 class="h3 mb-5 fw-normal">Login</h1>
      
      <form method="POST" action="/login">
        @csrf
        <div class="form-floating">
          <input type="text" class="form-control" name="username" id="username" placeholder="Username" autofocus required>
          <label for="username">Username</label>
        </div>
        <div class="form-floating">
          <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
          <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary mt-4" type="submit">Login</button>
      </form>
    </main>
    
  </body>
</html>
