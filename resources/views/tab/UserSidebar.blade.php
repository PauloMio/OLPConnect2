<!-- Sidebar -->
<div id="sidebar" class="sidebar">
    <button id="toggleSidebar" class="toggle-btn" aria-label="Toggle Sidebar">☰</button>

    @if(isset($account))
        <div class="profile">
            <p><strong>Account:</strong> {{ $account->firstname }} {{ $account->lastname }}</p>
            <form method="POST" action="{{ route('account.logout') }}" style="margin-top: 10px;">
                @csrf
                <button type="submit" class="logout-btn">Logout</button>
            </form>
        </div>
    @endif

    <ul class="menu">
        <li>
            <a href="{{ route('user.ebooks') }}">
                <img src="{{ asset('icons/Books.png') }}" class="icon" alt="eBooks">
                <span class="label">eBooks</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.favorites') }}">
                <img src="{{ asset('icons/favorite.png') }}" class="icon" alt="Favorites">
                <span class="label">Favorites</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.research') }}">
                <img src="{{ asset('icons/research.png') }}" class="icon" alt="Research">
                <span class="label">Research</span>
            </a>
        </li>
    </ul>
</div>

<!-- Style -->
<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 240px;
    background-color: #2c3e50;
    color: white;
    display: flex;
    flex-direction: column;
    transition: width 0.3s ease;
    z-index: 1000;
    overflow-y: auto;
}

.sidebar.collapsed {
    width: 70px;
}

.toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 26px;
    padding: 1rem;
    cursor: pointer;
    text-align: left;
}

.profile {
    padding: 1rem;
    border-bottom: 1px solid #34495e;
}

.sidebar.collapsed .profile {
    display: none;
}

.logout-btn {
    width: 100%;
    background-color: #dc3545;
    border: none;
    padding: 8px 0;
    border-radius: 4px;
    color: white;
    cursor: pointer;
    transition: background-color 0.2s;
}

.logout-btn:hover {
    background-color: #b02a37;
}

.menu {
    list-style: none;
    padding: 0;
    margin: 0;
    flex-grow: 1;
}

.menu li {
    margin: 0;
}

.menu a {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    text-decoration: none;
    color: white;
    transition: background 0.2s ease;
}

.menu a:hover {
    background-color: #34495e;
}

.icon {
    width: 24px;
    height: 24px;
    filter: brightness(0) invert(1);
    flex-shrink: 0;
}

.label {
    margin-left: 1rem;
    white-space: nowrap;
    transition: opacity 0.2s ease, margin 0.2s ease;
    opacity: 1;
}

.sidebar.collapsed .label {
    opacity: 0;
    margin-left: -9999px;
}
</style>

<!-- Script -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');
        updateMainContentMargin();
    });

    function updateMainContentMargin() {
        const mainContent = document.getElementById('main-content');
        const sidebarWidth = sidebar.offsetWidth;
        if (mainContent) {
            mainContent.style.marginLeft = sidebarWidth + 'px';
        }
    }

    // Set initial main content margin
    updateMainContentMargin();
});
</script>
