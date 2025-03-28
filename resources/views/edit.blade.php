<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/register.css') }}">
    <title>Register</title>
</head>

<body>
    <div class="container edit">


        <form action="/edit" method="post">
            <h1>Edit</h1>
            @csrf
            <input type="hidden" name="id" value="{{ $user->id }}">
            <div> <input type="text" id="username" name="username" placeholder="Username" value="{{ $user->username }}">
                @error('username')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div> <input type="email" id="email" name="email" placeholder="Email" value="{{ $user->email }}">
                @error('email')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div> <input type="password" id="password" name="password" placeholder="Password" value="{{ $user->password }}">
                @error('password')
                <p>{{$message}}</p>
                @enderror
            </div>
            <input type="submit" value="Edit">
            <a href="/home">Cancel</a>
        </form>

    </div>
</body>

</html>