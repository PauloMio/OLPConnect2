<!-- resources/views/tab/homeSidebar.blade.php -->
<div class="sidebar">
    <ul>
        <li>
            <a href="{{ route('user.home') }}">
                <img src="{{ asset('storage/icons/home.png') }}" alt="Home" class="icon">
            </a>
        </li>
        <li>
            <a href="{{ route('account.showLogin') }}">
                <img src="{{ asset('storage/icons/login.png') }}" alt="Login" class="icon">
            </a>
        </li>
        <li>
            <a href="{{ route('account.showSignup') }}">
                <img src="{{ asset('storage/icons/signup.png') }}" alt="Sign Up" class="icon">
            </a>
        </li>
        <li>
            <a href="{{ route('login') }}">
                <img src="{{ asset('storage/icons/admin.png') }}" alt="Admin" class="icon">
            </a>
        </li>
    </ul>
</div>

<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 80px;
    height: 100vh;
    background-color: #2c3e50;
    padding-top: 1rem;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    align-items: center;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 0;
    width: 100%;
}

.sidebar ul li {
    margin: 1.5rem 0;
    text-align: center;
}

.sidebar ul li a {
    display: block;
}

.icon {
    width: 32px;
    height: 32px;
    filter: brightness(0) invert(1); /* makes icons white if they’re dark */
    transition: transform 0.2s;
}

.icon:hover {
    transform: scale(1.1);
}
</style>
