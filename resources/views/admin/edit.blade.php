<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>eBook Setup</title>
</head>
<body>
    <h2>Update eBook</h2>

    <div class="TopControl">
        <a href="{{ route('admin.create') }}"><button type="button">Upload eBook</button></a>
    </div>

    <div class="eBook Table">
        <table>
            <tr>
                <th></th>
            </tr>
        </table>
    </div>

    <div class="LogOut">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit">Log out</button>
        </form>
    </div>


</body>
</html>