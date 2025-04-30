<!-- resources/views/tab/homeSidebar.blade.php -->
<div class="sidebar">
    <ul>
        <li><a href="{{ route('user.home') }}">Home</a></li>
        <li><a href="{{ route('account.showLogin') }}">Log In</a></li>
        <li><a href="{{ route('account.showSignup') }}">Sign Up</a></li>
    </ul>
</div>

<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    width: 200px;
    height: 100vh;
    background-color: #2c3e50;
    padding-top: 2rem;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
}

.sidebar ul {
    list-style: none;
    padding: 0;
}

.sidebar ul li {
    margin: 1rem 0;
    text-align: center;
}

.sidebar ul li a {
    color: white;
    text-decoration: none;
    font-weight: bold;
    display: block;
    padding: 0.5rem;
    transition: background 0.3s ease;
}

.sidebar ul li a:hover {
    background-color: #34495e;
}
</style>
