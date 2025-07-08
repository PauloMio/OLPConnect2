<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    .Log_in {
        background-color: white;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        width: 300px;
        text-align: center;
    }

    .Log_in h2 {
        margin-bottom: 20px;
    }

    .Log_in input {
        width: 100%;
        padding: 10px;
        margin: 10px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .Log_in button {
        width: 100%;
        padding: 10px;
        background-color: #007bff;
        color: white;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-weight: bold;
        margin-top: 10px;
    }

    .Log_in button:hover {
        background-color: #0056b3;
    }
</style>

<body>
@include('tab.homeSidebar')

<div style="margin-left: 80px;" id="main-content" class="main-content">
<div class="Log_in">
    <form action="{{ route('login.submit') }}" method="POST">
        @csrf
        <h2>Admin Log-In</h2>

        {{-- Display login error --}}
        @if($errors->has('email'))
            <div style="color:red; margin-bottom: 10px;">{{ $errors->first('email') }}</div>
        @endif

        <input type="text" name="email" placeholder="Email" value="{{ old('email') }}">

        <div style="position: relative;">
            <input type="password" name="password" id="password" placeholder="Password" style="padding-right: 40px;">
            <span id="togglePassword" style="position: absolute; top: 50%; right: 10px; transform: translateY(-50%); cursor: pointer;">
                👁️
            </span>
        </div>

        <button type="submit">Log-In</button>
    </form>        
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

    // Toggle password visibility
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    let isVisible = false;

    togglePassword.addEventListener('click', function () {
        isVisible = !isVisible;
        passwordInput.type = isVisible ? 'text' : 'password';
        togglePassword.textContent = isVisible ? '🙈' : '👁️';
    });
</script>

</body>