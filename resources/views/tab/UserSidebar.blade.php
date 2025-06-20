<div id="sidebar" class="sidebar collapsed">
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
                <img src="{{ asset('storage/icons/Books.png') }}" class="icon" alt="">
                <span class="label">eBooks</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.favorites') }}">
                <img src="{{ asset('storage/icons/favorite.png') }}" class="icon" alt="">
                <span class="label">Favorites</span>
            </a>
        </li>
        <li>
            <a href="{{ route('user.research') }}">
                <img src="{{ asset('storage/icons/research.png') }}" class="icon" alt="">
                <span class="label">Research</span>
            </a>
        </li>
    </ul>
</div>

<style>
.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    height: 100vh;
    width: 220px;
    background-color: #2c3e50;
    display: flex;
    flex-direction: column;
    transition: all 0.3s ease;
    z-index: 1000;
    overflow: hidden;
}

.sidebar.collapsed {
    width: 80px;
}

.toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 28px;
    cursor: pointer;
    padding: 1rem;
    text-align: left;
}

.profile {
    padding: 1rem;
    color: white;
    border-bottom: none;
}

.sidebar.collapsed .profile {
    display: none;
}

.logout-btn {
    background-color: #dc3545;
    color: white;
    border: none;
    padding: 6px 12px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    width: 100%;
    transition: background 0.2s;
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
    margin: 0.5rem 0;
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
    width: 28px;
    height: 28px;
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
        const sidebarWidth = document.getElementById('sidebar').offsetWidth;
        if (mainContent) {
            mainContent.style.marginLeft = sidebarWidth + 'px';
        }
    }

});
</script>
