<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Log in</title>
</head>

<body>
    <div class="container">
        <div class="img">
            <img src="{{ asset('assets/registration illustration.jpg')}}" alt="">
        </div>

        <form action="login" method="post">
            @csrf
            <h1>Log in</h1>
            <div> <input type="email" id="email" name="email" placeholder="Email" value="{{ old('email') }}">
                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div> <input type="password" id="password" name="password" placeholder="Password">
                @error('password')
                <p>{{$message}}</p>
                @enderror
            </div>
            @if(session('failed'))
            <p>{{ session('failed') }}</p>
            @endif
            <input type="submit" value="Log in">
            <a href="/">Register</a>


        </form>
    </div>
</body>

</html>