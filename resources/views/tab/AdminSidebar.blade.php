<div class="sidebar">
    <div class="profile">
        <p>Logged in as: <strong>{{ Auth::user()->username }}</strong></p>
        <form action="{{ route('logout') }}" method="POST" style="margin-top: 10px;">
            @csrf
            <button type="submit" style="background-color: #dc3545; color: white; border: none; padding: 5px 10px; border-radius: 4px; cursor: pointer;">
                Logout
            </button>
        </form>
    </div>
    <ul>
        <li>
            <a href="{{ route('admin.ebook.list') }}">Update eBook</a>
        </li>
        <li>
            <a href="{{ route('admin.accounts') }}">Admin Accounts</a>
        </li>
        <li>
            <a href="{{ route('admin.dashboard') }}">eBook Dashboard</a>
        </li>
    </ul>
</div>
