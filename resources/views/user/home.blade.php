<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>This is User Home Page!</h1>


    Role--{{Auth::user()->role}}

    <form action="{{ route('logout')}}" method="POST">
        @csrf
        <button class="btn btn-danger" type="submit" style="color: red">Logout</button>
    </form>
</body>
</html>