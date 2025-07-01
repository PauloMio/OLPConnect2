<!-- Sidebar Component -->
<div id="sidebar" class="sidebar">
    <button id="toggleSidebar" class="toggle-btn" aria-label="Toggle Sidebar">☰</button>

    <div class="profile">
        <p>Logged in as: <strong>{{ Auth::user()->username }}</strong></p>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <ul class="menu">
        <li><a href="{{ route('admin.dashboard') }}">
            <img src="{{ asset('storage/icons/dashboard.png') }}" class="icon" alt="">
            <span class="label">Dashboard</span>
        </a></li>

        <li><a href="{{ route('admin.ebook.list') }}">
            <img src="{{ asset('storage/icons/Books.png') }}" class="icon" alt="">
            <span class="label">eBook Setup</span>
        </a></li>

        <li><a href="{{ route('admin.accounts') }}">
            <img src="{{ asset('storage/icons/admin_setup.png') }}" class="icon" alt="">
            <span class="label">Admin Accounts</span>
        </a></li>

        <li><a href="{{ route('admin.useraccounts.index') }}">
            <img src="{{ asset('storage/icons/user_setup.png') }}" class="icon" alt="">
            <span class="label">User Accounts</span>
        </a></li>

        <li><a href="{{ route('admin.research.index') }}">
            <img src="{{ asset('storage/icons/research.png') }}" class="icon" alt="">
            <span class="label">Research</span>
        </a></li>

        <li><a href="{{ route('guest.logs') }}">
            <img src="{{ asset('storage/icons/log.png') }}" class="icon" alt="">
            <span class="label">Guest Log</span>
        </a></li>

        <!-- Dropdown -->
        <li class="dropdown">
            <a href="javascript:void(0);" class="dropdown-toggle">
                <img src="{{ asset('storage/icons/Setup.png') }}" class="icon" alt="">
                <span class="label">Setup</span>
            </a>
            <ul class="submenu">
                <li><a href="{{ route('admin.ebook_categories.index') }}">eBook Category</a></li>
                <li><a href="{{ route('admin.ebook_locations.index') }}">eBook Location</a></li>
                <li><a href="{{ route('admin.program_user.index') }}">User Program</a></li>
                <li><a href="{{ route('admin.department.index') }}">Department</a></li>
                <li><a href="{{ route('announcements.index') }}">Announcement</a></li>
                <li><a href="{{ route('admin.research-category.index') }}">Research Category</a></li>
            </ul>
        </li>
    </ul>
</div>

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

/* Toggle Button */
.toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 26px;
    padding: 1rem;
    cursor: pointer;
    text-align: left;
}

/* Profile */
.profile {
    padding: 1rem;
    border-bottom: 1px solid #34495e;
}

.sidebar.collapsed .profile {
    display: none;
}

/* Logout Button */
.logout-btn {
    width: 100%;
    background-color: #dc3545;
    border: none;
    padding: 8px 0;
    border-radius: 4px;
    color: white;
    cursor: pointer;
}

.logout-btn:hover {
    background-color: #b02a37;
}

/* Menu Items */
.menu {
    list-style: none;
    padding: 0;
    margin: 0;
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
}

.sidebar.collapsed .label {
    opacity: 0;
    margin-left: -9999px;
}

/* Dropdown */
.dropdown .submenu {
    display: none;
    flex-direction: column;
    background-color: #34495e;
    padding-left: 2rem;
}

.dropdown.open .submenu {
    display: flex;
}

.dropdown-toggle::after {
    content: '▼';
    margin-left: auto;
    font-size: 12px;
}

.sidebar.collapsed .dropdown .submenu {
    display: none !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggleSidebar');
    const dropdownToggles = document.querySelectorAll('.dropdown-toggle');

    toggleBtn.addEventListener('click', () => {
        sidebar.classList.toggle('collapsed');

        if (sidebar.classList.contains('collapsed')) {
            document.querySelectorAll('.dropdown.open').forEach(d => d.classList.remove('open'));
        }
    });

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', () => {
            const parent = toggle.closest('.dropdown');
            if (!sidebar.classList.contains('collapsed')) {
                parent.classList.toggle('open');
            }
        });
    });
});
</script>
