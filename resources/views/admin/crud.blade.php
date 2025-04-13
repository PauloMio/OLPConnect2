<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eBook Setup</title>
</head>
<body>
    <h2>eBook Setup</h2>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button type="submit">Log out</button>
</form>

</body>
</html>