<div id="sidebar" class="sidebar collapsed">
    <button id="toggleSidebar" class="toggle-btn" aria-label="Toggle Sidebar">☰</button>

    <div class="profile">
        <p>Logged in as: <strong>{{ Auth::user()->username }}</strong></p>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>
    </div>

    <ul class="menu">
        <li>
            <a href="{{ route('admin.dashboard') }}">
                <img src="{{ asset('storage/icons/dashboard.png') }}" class="icon" alt="">
                <span class="label">Dashboard</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.ebook.list') }}">
                <img src="{{ asset('storage/icons/Books.png') }}" class="icon" alt="">
                <span class="label">eBook Setup</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.accounts') }}">
                <img src="{{ asset('storage/icons/admin_setup.png') }}" class="icon" alt="">
                <span class="label">Admin Accounts</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.useraccounts.index') }}">
                <img src="{{ asset('storage/icons/user_setup.png') }}" class="icon" alt="">
                <span class="label">User Accounts</span>
            </a>
        </li>

        <li class="dropdown">
        <a href="javascript:void(0);" class="dropdown-toggle">
            <img src="{{ asset('storage/icons/Setup.png') }}" class="icon" alt="">
            <span class="label">Setup</span>
        </a>
        <ul class="submenu">
                <li><a href="{{ route('admin.ebook_categories.index') }}">eBook Category</a></li>
                <li><a href="{{ route('admin.ebook_locations.index') }}">eBook Location</a></li>
                <li><a href="{{ route('admin.program_user.index') }}">User Program</a></li>
                <li><a href="{{ route('announcements.index') }}">Announcement</a></li>
            </ul>
        </li>
    </ul>
</div>

<style>
/* Sidebar Core */
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
    overflow-y: auto;
}

.sidebar.collapsed {
    width: 80px;
}

/* Toggle Button */
.toggle-btn {
    background: none;
    border: none;
    color: white;
    font-size: 28px;
    cursor: pointer;
    padding: 1rem;
    text-align: left;
}

/* Profile Section */
.profile {
    padding: 1rem;
    color: white;
    border-bottom: none;
}

.sidebar.collapsed .profile {
    display: none;
}

/* Logout Button */
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

/* Menu */
.menu {
    list-style: none;
    padding: 0;
    margin: 0;
    overflow-y: auto; /* Optional but useful for large menus */
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

/* Icons */
.icon {
    width: 28px;
    height: 28px;
    filter: brightness(0) invert(1);
    flex-shrink: 0;
}

/* Labels */
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

/* Dropdown Styles */
.dropdown .submenu {
    display: none;
    flex-direction: column;
    padding-left: 2.5rem;
    background-color: #34495e;
    transition: all 0.3s ease;
}

.dropdown .submenu li a {
    padding: 0.5rem 1rem;
    color: #ecf0f1;
    font-size: 14px;
}

.dropdown.open .submenu {
    display: flex;
}

.dropdown-toggle::after {
    content: '▼';
    margin-left: auto;
    font-size: 12px;
    color: white;
}

.sidebar.collapsed .dropdown .submenu {
    display: none !important;
}

.sidebar.collapsed .dropdown.open .submenu {
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

        // When collapsed, close all open dropdowns
        if (sidebar.classList.contains('collapsed')) {
            document.querySelectorAll('.dropdown.open').forEach(dropdown => {
                dropdown.classList.remove('open');
            });
        }
    });

    dropdownToggles.forEach(toggle => {
        toggle.addEventListener('click', (e) => {
            const dropdown = toggle.closest('.dropdown');

            // Prevent toggle if sidebar is collapsed
            if (!sidebar.classList.contains('collapsed')) {
                dropdown.classList.toggle('open');
            }
        });
    });
});
</script>
