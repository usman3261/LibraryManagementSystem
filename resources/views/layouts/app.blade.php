<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LMS | Dashboard</title>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <style>
        .sidebar { background: #2c3e50; min-height: 100vh; color: white; position: fixed; width: 240px; }
        .sidebar .nav-link { color: #bdc3c7; padding: 15px 25px; border-bottom: 1px solid #34495e; transition: 0.3s; }
        .sidebar .nav-link:hover { background: #34495e; color: white; }
        .sidebar .nav-link.active { background: #1a252f; color: #3498db; border-left: 4px solid #3498db; }
        .main-content { margin-left: 240px; padding: 40px; width: calc(100% - 240px); background: #f8f9fa; min-height: 100vh; }
    </style>
</head>
<body>
    <div class="d-flex">
        <nav class="sidebar shadow">
            <div class="p-4 border-bottom border-secondary text-center">
                <h4 class="mb-0 fw-bold text-white">LMS PORTAL</h4>
                <small class="text-muted">{{ Auth::user()->roles->first()->name ?? 'Member' }}</small>
            </div>
            
            <div class="nav flex-column">
                <a href="{{ route('dashboard') }}" class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard Hub</a>

                @if(Auth::user()->roles->contains('name', 'Librarian'))
                    <a href="{{ route('bookShow') }}" class="nav-link {{ request()->routeIs('bookShow') ? 'active' : '' }}">Manage Inventory</a>
                    <a href="{{ route('userShow') }}" class="nav-link {{ request()->routeIs('userShow') ? 'active' : '' }}">Manage Students</a>
                    <a href="{{ route('borrowIndex') }}" class="nav-link {{ request()->routeIs('borrowIndex') ? 'active' : '' }}">Issue Records</a>
                    <a href="{{ route('pendingRequests') }}" class="nav-link {{ request()->routeIs('pendingRequests') ? 'active' : '' }}">
                        Pending Requests 
                        <span class="badge bg-danger ms-2">Action</span>
                    </a>
                @endif

                @if(Auth::user()->roles->contains('name', 'Student'))
                    <a href="{{ route('studentBookShow') }}" class="nav-link {{ request()->routeIs('studentBookShow') ? 'active' : '' }}">Available Books</a>
                    <a href="{{ route('studentHistory') }}" class="nav-link {{ request()->routeIs('studentHistory') ? 'active' : '' }}">My Borrowing History</a>
                @endif

                <a href="{{ route('logout') }}" class="nav-link text-danger mt-4 border-top border-secondary">Logout</a>
            </div>
        </nav>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>