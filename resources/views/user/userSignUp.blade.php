<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f0f4f8;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .signup-container {
        background-color: #fff;
        padding: 2rem 3rem;
        border-radius: 12px;
        box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 400px;
    }

    h1 {
        text-align: center;
        margin-bottom: 1.5rem;
        color: #333;
    }

    label {
        display: block;
        margin-top: 1rem;
        margin-bottom: 0.3rem;
        font-weight: bold;
        color: #555;
    }

    input[type="text"],
    input[type="date"] {
        width: 100%;
        padding: 0.6rem;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 1rem;
    }

    button {
        margin-top: 1.5rem;
        width: 100%;
        padding: 0.7rem;
        background-color: #4f46e5;
        color: #fff;
        border: none;
        border-radius: 6px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #4338ca;
    }

    .error-messages {
        color: #e11d48;
        background-color: #fef2f2;
        border: 1px solid #fca5a5;
        padding: 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
    }

    .login-link {
        margin-top: 1rem;
        text-align: center;
        font-size: 0.9rem;
    }

    .login-link a {
        color: #4f46e5;
        text-decoration: none;
    }

    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<body>
@include('tab.homeSidebar')

<div style="margin-left: 80px;" id="main-content">
    @yield('content')


    <div class="signup-container">
    <h1>Create User Account</h1>

    @if ($errors->any())
        <div class="error-messages">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('account.signup') }}" method="POST">
        @csrf

        <label>First Name:</label>
        <input type="text" name="firstname" value="{{ old('firstname') }}">

        <label>Last Name:</label>
        <input type="text" name="lastname" value="{{ old('lastname') }}">

        <label>School ID: *</label>
        <input type="text" name="schoolid" required value="{{ old('schoolid') }}">

        <label>Birthdate: *</label>
        <input type="date" name="birthdate" required value="{{ old('birthdate') }}">

        <button type="submit">Sign Up</button>
    </form>

    <div class="login-link">
        <p>Already have an account? <a href="{{ route('account.showLogin') }}">Log in here</a>.</p>
    </div>
</div>

</div>


<script>
    // Adjust margin based on sidebar width
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('main-content');

        const resizeObserver = new ResizeObserver(() => {
            const width = sidebar.offsetWidth;
            mainContent.style.marginLeft = width + 'px';
        });

        resizeObserver.observe(sidebar);
</script>

</body>
