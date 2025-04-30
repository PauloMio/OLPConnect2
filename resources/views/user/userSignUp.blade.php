<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Sign-up</title>
</head>
<body>
    
</body>
</html><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Sign-up</title>
</head>
<body>
    <h1>Create a New Account</h1>

    @if ($errors->any())
        <div style="color: red;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.signup') }}" method="POST">
        @csrf

        <label>First Name:</label><br>
        <input type="text" name="firstname" value="{{ old('firstname') }}"><br><br>

        <label>Last Name:</label><br>
        <input type="text" name="lastname" value="{{ old('lastname') }}"><br><br>

        <label>School ID: *</label><br>
        <input type="text" name="schoolid" required value="{{ old('schoolid') }}"><br><br>

        <label>Birthdate: *</label><br>
        <input type="date" name="birthdate" required value="{{ old('birthdate') }}"><br><br>

        <button type="submit">Sign Up</button>
    </form>

    <p>Already have an account? <a href="{{ route('account.showLogin') }}">Log in here</a>.</p>
</body>
</html>
