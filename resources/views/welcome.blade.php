<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

    <!-- Styles -->
    <style>
        html, body {
            background-color: #fff;
            color: #636b6f;
            font-family: 'Nunito', sans-serif;
            font-weight: 200;
            height: 100vh;
            margin: 0;
        }

        .full-height {
            height: 100vh;
        }

        .flex-center {
            align-items: center;
            display: flex;
            justify-content: center;
        }

        .position-ref {
            position: relative;
        }

        .top-right {
            position: absolute;
            right: 10px;
            top: 18px;
        }

        .content {
            text-align: center;
        }

        .title {
            font-size: 84px;
        }

        .links > a {
            color: #636b6f;
            padding: 0 25px;
            font-size: 13px;
            font-weight: 600;
            letter-spacing: .1rem;
            text-decoration: none;
            text-transform: uppercase;
        }

        .m-b-md {
            margin-bottom: 30px;
        }

        .table-responsive{
          width: 100% !important;
      }

      .table {
        border: 1px solid black;
        width: 20% !important; /*Importante manter o !important rs */
        margin: auto;
    }

    .table-status {
        margin-top: 20px;
        margin-bottom: 20px !important;
    }
</style>
</head>
<body>
    <div class="content" >
        <div class="title m-b-md">
            Escolha o tipo de Usuario
        </div>     
        <div class="">
            @if (Route::has('login'))
            @if (Route::has('register'))
            @auth
            <a href="{{ url('/home') }}">Home</a>
            @else
            <table class="table">
                <tr>
                    <td><a href="{{ route('login-usuario') }}">Usuario</a></td>
                    <td><a href="{{ route('register-u') }}">Register</a></td>
                </tr>
                <tr>
                    <td><a href="{{ route('login-bolsista') }}">Bolsista</a></td>
                </tr>
                <tr>
                    <td><a href="{{ route('login-supervisor') }}">Supervisor</a></td>
                </tr>
                <tr>
                    <td><a href="{{ route('login-admin') }}">Admin</a></td>
                </tr>
            </table>
            @endauth
            @endif
            @endif
        </div>
    </div>
</body>
</html>