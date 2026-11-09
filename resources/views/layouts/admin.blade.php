<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') · Anup Portfolio</title>
    <script>document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'dark');</script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Space+Grotesk:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: var(--bg-admin); color: var(--text-main); transition: background-color 0.3s, color 0.3s; }
        h1,h2,h3,.font-display { font-family: 'Space Grotesk', sans-serif; }

        .sidebar-link { display: flex; align-items: center; gap: 0.75rem; padding: 0.625rem 1rem; border-radius: 12px; font-size: 0.875rem; font-weight: 500; color: var(--text-gray-400); transition: all 0.2s; text-decoration: none; }
        .sidebar-link:hover { background: rgba(108,99,255,0.12); color: var(--text-main); }
        .sidebar-link.active { background: rgba(108,99,255,0.2); color: var(--text-main); }
        .sidebar-link.active svg { color: #6c63ff; }

        .admin-card { background: var(--bg-card); border: 1px solid var(--border-soft); border-radius: 16px; }

        .form-input { width: 100%; background: var(--input-bg); border: 1px solid var(--input-border); border-radius: 10px; padding: 0.625rem 0.875rem; color: var(--text-main); font-size: 0.875rem; transition: border-color 0.2s; outline: none; }
        .form-input:focus { border-color: #6c63ff; }
        .form-input::placeholder { color: var(--placeholder); }

        .form-label { display: block; font-size: 0.75rem; font-weight: 600; color: var(--text-gray-500); text-transform: uppercase; letter-spacing: 0.05em; margin-bottom: 0.375rem; }

        .btn-admin-primary { background: linear-gradient(135deg, #6c63ff, #574fd6); color: white; padding: 0.5rem 1.25rem; border-radius: 8px; font-size: 0.875rem; font-weight: 600; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.5rem; border: none; cursor: pointer; text-decoration: none; }
        .btn-admin-primary:hover { transform: translateY(-1px); box-shadow: 0 8px 20px rgba(108,99,255,0.4); }

        .btn-admin-danger { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.3); padding: 0.4rem 0.875rem; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.375rem; cursor: pointer; }
        .btn-admin-danger:hover { background: rgba(239,68,68,0.25); }

        .btn-admin-secondary { background: var(--bg-card); color: var(--text-gray-400); border: 1px solid var(--border-soft); padding: 0.4rem 0.875rem; border-radius: 8px; font-size: 0.8125rem; font-weight: 500; transition: all 0.2s; display: inline-flex; align-items: center; gap: 0.375rem; cursor: pointer; text-decoration: none; }
        .btn-admin-secondary:hover { background: var(--input-bg); color: var(--text-main); }

        .badge { display: inline-flex; align-items: center; padding: 0.2rem 0.6rem; border-radius: 999px; font-size: 0.7rem; font-weight: 600; letter-spacing: 0.025em; }
        .badge-green { background: rgba(52,211,153,0.15); color: #34d399; border: 1px solid rgba(52,211,153,0.3); }
        .badge-red { background: rgba(239,68,68,0.15); color: #f87171; border: 1px solid rgba(239,68,68,0.3); }
        .badge-yellow { background: rgba(251,191,36,0.15); color: #fbbf24; border: 1px solid rgba(251,191,36,0.3); }
        .badge-purple { background: rgba(108,99,255,0.15); color: #a78bfa; border: 1px solid rgba(108,99,255,0.3); }

        .table-row { border-bottom: 1px solid var(--border-soft); transition: background 0.15s; }
        .table-row:hover { background: var(--input-bg); }

        select.form-input option { background: var(--bg-admin); color: var(--text-main); }
        textarea.form-input { resize: vertical; }

        .admin-theme-toggle { width: 36px; height: 36px; border-radius: 10px; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s; border: 1px solid var(--border-soft); background: var(--bg-card); color: var(--text-gray-400); }
        .admin-theme-toggle:hover { border-color: rgba(108,99,255,0.5); color: #6c63ff; }
        [data-theme="light"] .admin-theme-toggle .sun-icon { display: none; }
        [data-theme="dark"] .admin-theme-toggle .moon-icon, :root .admin-theme-toggle .moon-icon { display: none; }
        [data-theme="light"] .admin-theme-toggle .moon-icon { display: block; }
    </style>
</head>
<body class="min-h-screen" style="background: var(--bg-admin); color: var(--text-main);">

<div class="flex min-h-screen">

    <!-- ─── Sidebar ────────────────────────────────────────────────────────── -->
    <aside id="admin-sidebar"
           class="fixed top-0 left-0 h-full w-64 z-40 flex flex-col py-6 px-4 transition-transform duration-300"
           style="background: var(--bg-admin-sidebar); border-right: 1px solid var(--border-soft);">

        <!-- Logo -->
        <div class="flex items-center gap-3 px-2 mb-8">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-lg"
                 style="background: linear-gradient(135deg, #6c63ff, #ff6584);">A</div>
            <div>
                <div class="font-display font-bold text-base" style="color: var(--text-main)">AdminPanel</div>
                <div class="text-xs" style="color: var(--text-gray-500)">Portfolio Manager</div>
            </div>
        </div>

        <!-- Nav -->
        <nav class="flex-1 space-y-1 overflow-y-auto">
            <div class="text-[10px] font-bold uppercase tracking-widest px-4 mb-2" style="color: var(--text-gray-600)">Main</div>
            <a href="{{ route('admin.dashboard') }}"
               class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <div class="text-[10px] font-bold uppercase tracking-widest px-4 mb-2 mt-5" style="color: var(--text-gray-600)">Portfolio</div>
            <a href="{{ route('admin.profile.edit') }}"
               class="sidebar-link {{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profile
            </a>
            <a href="{{ route('admin.photos.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.photos*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                Photos
            </a>
            <a href="{{ route('admin.projects.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                Projects
            </a>
            <a href="{{ route('admin.skills.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 3v2m6-2v2M9 19v2m6-2v2M5 9H3m2 6H3m18-6h-2m2 6h-2M7 19h10a2 2 0 002-2V7a2 2 0 00-2-2H7a2 2 0 00-2 2v10a2 2 0 002 2zM9 9h6v6H9V9z"/></svg>
                Skills
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/></svg>
                Testimonials
            </a>

            <div class="text-[10px] font-bold uppercase tracking-widest px-4 mb-2 mt-5" style="color: var(--text-gray-600)">Inbox</div>
            <a href="{{ route('admin.messages.index') }}"
               class="sidebar-link {{ request()->routeIs('admin.messages*') ? 'active' : '' }}">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                Messages
                @php $unread = \App\Models\ContactMessage::unread()->count(); @endphp
                @if($unread > 0)
                <span class="ml-auto text-xs font-bold px-1.5 py-0.5 rounded-full bg-[#6c63ff] text-white">{{ $unread }}</span>
                @endif
            </a>
        </nav>

        <!-- User + Logout -->
        <div class="mt-auto pt-4" style="border-top: 1px solid var(--border-soft);">
            <div class="flex items-center gap-3 px-2 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-xs font-bold text-white"
                     style="background: linear-gradient(135deg, #6c63ff, #ff6584);">
                    {{ strtoupper(substr(auth()->user()->name, 0, 2)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium truncate" style="color: var(--text-main)">{{ auth()->user()->name }}</div>
                    <div class="text-xs truncate" style="color: var(--text-gray-500)">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="sidebar-link w-full text-left" style="color: #f87171;">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                    Sign Out
                </button>
            </form>
        </div>
    </aside>

    <!-- ─── Main Content ────────────────────────────────────────────────────── -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">

        <!-- Top Bar -->
        <header class="sticky top-0 z-30 px-6 py-4 flex items-center justify-between"
                style="background: var(--bg-glass-strong); backdrop-filter: blur(20px); border-bottom: 1px solid var(--border-soft);">
            <div>
                <h1 class="font-display text-lg font-bold" style="color: var(--text-main)">@yield('page-title', 'Dashboard')</h1>
                <p class="text-xs" style="color: var(--text-gray-500)">@yield('page-subtitle', 'Welcome back!')</p>
            </div>
            <div class="flex items-center gap-3">
                <!-- Theme Toggle -->
                <button onclick="toggleAdminTheme()" class="admin-theme-toggle" aria-label="Toggle theme">
                    <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                    <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:18px;height:18px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                </button>
                <a href="{{ route('home') }}" target="_blank" class="btn-admin-secondary text-xs">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/></svg>
                    View Site
                </a>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-4">
            @if(session('success'))
            <div class="flex items-center gap-3 p-4 rounded-xl mb-4 text-sm font-medium"
                 style="background: rgba(52,211,153,0.12); border: 1px solid rgba(52,211,153,0.3); color: #34d399;">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                {{ session('success') }}
            </div>
            @endif
            @if(session('error'))
            <div class="flex items-center gap-3 p-4 rounded-xl mb-4 text-sm font-medium"
                 style="background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: #f87171;">
                <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                {{ session('error') }}
            </div>
            @endif
            @if($errors->any())
            <div class="p-4 rounded-xl mb-4 text-sm"
                 style="background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: #f87171;">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>

        <!-- Page Content -->
        <main class="flex-1 px-6 pb-8">
            @yield('content')
        </main>
    </div>
</div>

<script>
function toggleAdminTheme() {
    const current = document.documentElement.getAttribute('data-theme');
    const next = current === 'dark' ? 'light' : 'dark';
    document.documentElement.setAttribute('data-theme', next);
    localStorage.setItem('theme', next);
}

document.querySelectorAll('[data-confirm]').forEach(el => {
    el.addEventListener('click', (e) => {
        if (!confirm(el.dataset.confirm || 'Are you sure?')) e.preventDefault();
    });
});
</script>

</body>
</html>
