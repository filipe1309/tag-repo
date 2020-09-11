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

    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-2 d-flex justify-content-between">
        <a class="navbar navbar-expand-lg" href="/">Home</a>
        @auth

            <a href="/logout"><?= Auth::user()['name']; ?> <span class="text-danger">(Logout)</span></a>
        @endauth

        @guest
            <a href="/login">Login</a>
        @endguest

    </nav>

    <div class="container">
        <div class="jumbotron">
            <h1>TagApp</h1>
        </div>

        @yield('content')
    </div>
</body>
</html>