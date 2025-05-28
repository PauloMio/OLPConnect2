<!-- Sidebar -->
<div id="sidebar" class="sidebar collapsed">
    <button id="toggleSidebar" class="toggle-btn" aria-label="Toggle Sidebar">
        ☰
    </button>
    <ul>
        <li>
            <a href="{{ route('user.home') }}">
                <img src="{{ asset('storage/icons/home.png') }}" alt="Home" class="icon">
                <span class="label">Home</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.showLogin') }}">
                <img src="{{ asset('storage/icons/login.png') }}" alt="Login" class="icon">
                <span class="label">Login</span>
            </a>
        </li>
        <li>
            <a href="{{ route('account.showSignup') }}">
                <img src="{{ asset('storage/icons/signup.png') }}" alt="Sign Up" class="icon">
                <span class="label">Sign Up</span>
            </a>
        </li>
        <li>
            <a href="{{ route('login') }}">
                <img src="{{ asset('storage/icons/admin.png') }}" alt="Admin" class="icon">
                <span class="label">Admin</span>
            </a>
        </li>
    </ul>
</div>

<!-- Styles -->
<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    background-color: #2c3e50;
    box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    display: flex;
    flex-direction: column;
    transition: width 0.3s ease;
    overflow-x: hidden;
    z-index: 1000;
    width: 220px;
}

.sidebar.collapsed {
    width: 80px;
}

.toggle-btn {
    background: none;
    color: white;
    font-size: 24px;
    border: none;
    padding: 1rem;
    cursor: pointer;
    text-align: left;
}

.sidebar ul {
    list-style: none;
    padding: 0;
    margin: 1rem 0 0 0;
    width: 100%;
}

.sidebar ul li {
    margin: 1rem 0;
}

.sidebar ul li a {
    display: flex;
    align-items: center;
    padding: 0.5rem 1rem;
    color: white;
    text-decoration: none;
    transition: background 0.2s;
}

.sidebar ul li a:hover {
    background-color: #34495e;
}

.icon {
    width: 32px;
    height: 32px;
    filter: brightness(0) invert(1);
    flex-shrink: 0;
    transition: transform 0.2s;
}

.label {
    margin-left: 1rem;
    white-space: nowrap;
    opacity: 1;
    transition: opacity 0.2s, margin 0.2s;
}

.sidebar.collapsed .label {
    opacity: 0;
    margin-left: -9999px;
}
</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');

    toggleBtn.addEventListener('click', function () {
        sidebar.classList.toggle('collapsed');
    });
});
</script>
