<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">

</head>

<body>
    <div class="search">
        <form action="homesearch" method="post">
            @csrf
            <label for="search">Search</label>
            <input type="text" id="search" name="search" placeholder="Search" value="{{ old('search') }}">
            <input type="submit" value="Search">
        </form>
    </div>
    <table>
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Email</th>
            <th>Role</th>
            <th>Date created</th>
        </tr>

        @foreach($users as $u)
        <tr>
            <td>{{ $u->id }}</td>
            <td>{{ $u->username }}</td>
            <td>{{ $u->email }}</td>
            <td>{{ $u->role }}</td>
            <td>{{ $u->date_created }}</td>
            @if($user->role == 'admin')
            <td><button class="deletebtn" value="{{ $u->id }}" onclick="deleteUser()">Delete</button></td>
            <td><button><a href="/editpage/{{ $u->id }}">Edit</a></button></td>
            @endif
        </tr>
        @endforeach
    </table>

    <div class="delete-modal">
        <h2>Confirm delete user?</h2>
        <div class="options">
            <button id="no" onclick="cancelDelete()">No</button>
            <a id="confirm" href="delete/">Confirm</a>
        </div>
    </div>

    <a href="/loginpage" class="logout">Log out</a>

    <script>
        function deleteUser() {
            let delbtn = document.querySelectorAll('.deletebtn');
            delbtn.forEach((btn) => {
                btn.addEventListener('click', () => {
                    document.querySelector('.delete-modal').setAttribute('style', 'display: flex');
                    let id = btn.value;
                    document.querySelector('#confirm').href = `delete/${id}`;
                });
            });
        }

        function cancelDelete() {
            document.querySelector('.delete-modal').setAttribute('style', 'display: none');
        }
    </script>
</body>

</html>