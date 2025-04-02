<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        body {
            padding: 0px;
            margin: 0px;
        }

        .sidebar-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
        }

        .sidebar-item.active {
            background-color: rgba(255, 255, 255, 0.2);
        }

        .nav-item-text {
            display: none;
            margin-left: 0.5rem;
        }

        .nav-item:hover .nav-item-text {
            display: inline;
        }

        .nav-item {
            transition: transform 0.3s ease, opacity 0.3s ease;
        }

        .nav-item:hover {
            transform: scale(1.1);
        }
    </style>
</head>

<body class="bg-gray-100 flex">
    <!-- Sidebar -->
    <aside id="sidebar" class="w-64 bg-gray-900 text-white h-screen fixed shadow-lg transition-transform transform md:translate-x-0 -translate-x-full md:w-64">
        <div class="p-5 text-2xl font-bold flex items-center gap-2 border-b border-gray-700">
            <i data-lucide="settings"></i>
            <span id="sidebar-logo" class="transition-opacity duration-300"><a href="{{ route('admin.dashboard') }}">Admin Panel</a></span>
        </div>

        <nav class="mt-4">
            <ul>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/dashboard') ? 'active' : '' }}">
                    <i data-lucide="home"></i>
                    <a href="{{ route('admin.dashboard') }}" class="block">Dashboard</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/users*') ? 'active' : '' }}">
                    <i data-lucide="users"></i>
                    <a href="{{ route('users.index') }}" class="block">Manage Users</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/books*') ? 'active' : '' }}">
                    <i data-lucide="book"></i>
                    <a href="{{ route ('bukus.index') }}" class="block">Manage Books</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i data-lucide="layers"></i>
                    <a href="{{ route ('kategoris.index') }}" class="block">Manage Categories</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/borrows*') ? 'active' : '' }}">
                    <i data-lucide="bookmark"></i>
                    <a href="{{ route ('pinjams.index') }}" class="block">Manage Borrows</a>
                </li>
                <li class="px-6 py-3 flex items-center gap-3 sidebar-item {{ request()->is('admin/returns*') ? 'active' : '' }}">
                    <i data-lucide="refresh-ccw"></i>
                    <a href="{{ route ('pengembalians.index') }}" class="block">Manage Returns</a>
                </li>
            </ul>
        </nav>
        <div class="absolute bottom-4 left-4 text-gray-400">
            <span>Login as: <br> <strong>Admin {{ Auth::user()->nama}}</strong></span>
        </div>
    </aside>
    <!-- end sidebar -->

    <!-- Start Navbar -->
    <div id="main-content" class="flex-1 transition-all duration-300 ml-64">
        <nav class="bg-gray-900 text-white shadow-md p-4 flex flex-wrap justify-between items-center">
            <div class="flex items-center">
                <button id="toggleSidebar" class="text-white mr-4">
                    <i data-lucide="menu" class="w-6 h-6"></i>
                </button>
                <div id="admin-title" class="flex items-center text-gray-400 font-sans hidden">
                    <i data-lucide="settings" class="text-white"></i>
                    <span class="ml-2 mr-80 text-white font-bold">Admin Panel</span>
                </div>
                <div id="navbar-icons" class="flex justify-center ml-80 flex-1 hidden">
                    <div class="flex items-center space-x-6 mx-auto">
                        <a href="{{ route('admin.dashboard') }}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="home" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Dashboard</span>
                        </a>
                        <a href="{{ route('users.index') }}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="users" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Users</span>
                        </a>
                        <a href="{{ route('bukus.index')}}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="book" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Books</span>
                        </a>
                        <a href="{{ route ('kategoris.index') }}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="layers" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Categories</span>
                        </a>
                        <a href="{{ route ('pinjams.index') }}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="bookmark" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Borrows</span>
                        </a>
                        <a href="{{ route ('pengembalians.index') }}" class="text-white nav-item flex items-center relative">
                            <i data-lucide="refresh-ccw" class="nav-icon transition-transform duration-300"></i>
                            <span class="nav-item-text ml-2 opacity-0 transform translate-x-2 transition-all duration-300">Returns</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="flex items-center">
                <h1 class="mr-4 text-gray-400 font-sans">Perpustakaan Demo v0.4</h1>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 px-4 py-2 rounded-md hover:bg-red-600">
                        <i data-lucide="log-out"></i>
                    </button>
                </form>
            </div>
        </nav>

        <main id="main-content" class="p-4 flex-1 transition-all duration-300 md:ml-64 ml-0">
            @yield ('content')
        </main>

        <footer class="py-4 bg-gray-200 mt-auto w-full">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between text-sm text-gray-600">
                    <div>&copy; 2025 Admin Panel</div>
                    <div>
                        <a href="#" class="text-gray-600 hover:text-gray-800">Privacy Policy</a>
                        <span class="mx-2">·</span>
                        <a href="#" class="text-gray-600 hover:text-gray-800">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!-- end Navbar -->
</body>

</html>
<script>
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');
    const logo = document.getElementById('sidebar-logo');
    const adminTitle = document.getElementById('admin-title');
    const navbarIcons = document.getElementById('navbar-icons');

    if (localStorage.getItem('sidebarCollapsed') === 'true') {
        sidebar.style.transform = 'translateX(-100%)';
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-0');
        logo.style.opacity = '0';
        adminTitle.classList.remove('hidden');
        navbarIcons.classList.remove('hidden');
    }

    document.getElementById('toggleSidebar').addEventListener('click', function() {
        if (sidebar.style.transform === 'translateX(0%)') {
            sidebar.style.transform = 'translateX(-100%)';
            mainContent.classList.remove('ml-64');
            mainContent.classList.add('ml-0');
            logo.style.opacity = '0';
            adminTitle.classList.remove('hidden');
            navbarIcons.classList.remove('hidden');
            localStorage.setItem('sidebarCollapsed', 'true');
        } else {
            sidebar.style.transform = 'translateX(0%)';
            mainContent.classList.remove('ml-0');
            mainContent.classList.add('ml-64');
            logo.style.opacity = '1';
            adminTitle.classList.add('hidden');
            navbarIcons.classList.add('hidden');
            localStorage.setItem('sidebarCollapsed', 'false');
        }
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            sidebar.style.transform = 'translateX(0%)';
            mainContent.classList.add('md:ml-64');
        } else {
            if (localStorage.getItem('sidebarCollapsed') !== 'true') {
                sidebar.style.transform = 'translateX(-100%)';
                mainContent.classList.remove('ml-64');
            }
        }
    });

    document.querySelectorAll('.nav-item').forEach(item => {
        item.addEventListener('mouseenter', () => {
            let span = item.querySelector('.nav-item-text');
            let icon = item.querySelector('.nav-icon');

            // Tampilkan teks dengan transisi halus
            span.classList.remove('opacity-0', 'translate-x-2');
            span.classList.add('opacity-100', 'translate-x-0');

            // Geser ikon sedikit ke kiri secara smooth
            icon.classList.add('transform', '-translate-x-1');
        });

        item.addEventListener('mouseleave', () => {
            let span = item.querySelector('.nav-item-text');
            let icon = item.querySelector('.nav-icon');

            // Sembunyikan teks dengan transisi halus
            span.classList.remove('opacity-100', 'translate-x-0');
            span.classList.add('opacity-0', 'translate-x-2');

            // Kembalikan ikon ke posisi awal
            icon.classList.remove('transform', '-translate-x-1');
        });
    });
</script>