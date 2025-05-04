<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        display: flex;
    }

    .card {
        background: white;
        padding: 2rem;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 350px;
    }

    .card h2 {
        margin-bottom: 1.5rem;
        text-align: center;
        color: #333;
    }

    .form-group {
        margin-bottom: 1rem;
    }

    label {
        display: block;
        margin-bottom: 0.5rem;
        color: #555;
    }

    input[type="text"],
    input[type="date"] {
        width: 100%;
        padding: 0.5rem;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 1rem;
    }

    button {
        width: 100%;
        padding: 0.75rem;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 1rem;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    button:hover {
        background-color: #0056b3;
    }

    .main-content {
        margin-left: 80px;
        padding: 2rem;
        flex: 1;
    }

    .sidebar {
        width: 80px;
        height: 100vh;
        position: fixed;
        left: 0;
        top: 0;
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

<div id="mainContent">

<div class="card">
    <h2>User Login</h2>
    <form action="{{ route('account.login') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="schoolid">School ID:</label>
            <input type="text" name="schoolid" id="schoolid" placeholder="Enter School ID">
        </div>

        <div class="form-group">
            <label for="birthdate">Birthdate:</label>
            <input type="date" name="birthdate" id="birthdate">
        </div>

        <button type="submit">Submit</button>
    </form>

    <div class="login-link">
        <p>Don't have an account? <a href="{{ route('account.showSignup') }}">Register here</a>.</p>
    </div>
</div>



</body>
