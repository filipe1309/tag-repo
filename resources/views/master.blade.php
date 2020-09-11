<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/c3e1d76a85.js" crossorigin="anonymous"></script>
    <title>@yield('title')</title>
</head>
<body>

    <div class="container">
        <nav class="navbar navbar-dark bg-dark navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
            <a class="navbar-brand mb-0 h1" href="/">TagApp</a>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                  <li class="nav-item active">
                    <a class="nav-link" href="#">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/tag">Tags</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="/repo">Repos</a>
                  </li>
                </ul>
              </div>
            @auth
                <a href="/logout"><?= Auth::user()['name']; ?> <span class="text-danger">(Logout)</span></a>
            @endauth
    
            @guest
                <a href="/login">Login</a>
            @endguest
    
        </nav>
        @yield('content')
    </div>
    
</body>
</html>