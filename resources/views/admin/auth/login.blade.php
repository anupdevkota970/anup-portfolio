<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Login · Anup Portfolio</title>
    <script>document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'dark');</script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body { font-family: 'Inter', sans-serif; background: var(--bg-body); color: var(--text-main); }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center relative overflow-hidden">

<!-- Theme toggle -->
<button onclick="const c=document.documentElement.getAttribute('data-theme');const n=c==='dark'?'light':'dark';document.documentElement.setAttribute('data-theme',n);localStorage.setItem('theme',n);"
        class="theme-toggle fixed top-6 right-6 z-10" aria-label="Toggle theme">
    <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
    <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
</button>

<canvas id="particles-canvas"></canvas>

<!-- Gradient orbs -->
<div class="absolute top-1/4 -left-40 w-80 h-80 rounded-full blur-3xl opacity-20 animate-pulse-slow"
     style="background: radial-gradient(circle, #6c63ff, transparent)"></div>
<div class="absolute bottom-1/4 -right-40 w-80 h-80 rounded-full blur-3xl opacity-20 animate-pulse-slow"
     style="background: radial-gradient(circle, #ff6584, transparent); animation-delay:2s;"></div>

<div class="relative z-10 w-full max-w-md px-6">
    <!-- Card -->
    <div class="glass rounded-3xl p-8 glow">
        <!-- Header -->
        <div class="text-center mb-8">
            <div class="w-16 h-16 rounded-2xl flex items-center justify-center text-white font-bold text-2xl mx-auto mb-4"
                 style="background: linear-gradient(135deg, #6c63ff, #ff6584);">A</div>
            <h1 class="font-display text-2xl font-bold text-white mb-1">Welcome back</h1>
            <p class="text-gray-400 text-sm">Sign in to your admin panel</p>
        </div>

        <!-- Flash errors -->
        @if(session('error'))
        <div class="flex items-center gap-2 p-3 rounded-xl mb-5 text-sm"
             style="background: rgba(239,68,68,0.12); border: 1px solid rgba(239,68,68,0.3); color: #f87171;">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
            {{ session('error') }}
        </div>
        @endif

        <form method="POST" action="{{ route('admin.login.post') }}" class="space-y-5">
            @csrf

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autofocus
                       placeholder="admin@anup.dev"
                       class="w-full rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none transition-all duration-200"
                       style="background: rgba(255,255,255,0.06); border: 1px solid {{ $errors->has('email') ? 'rgba(239,68,68,0.6)' : 'rgba(255,255,255,0.1)' }};"
                       onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                @error('email')
                <p class="mt-1.5 text-xs text-red-400">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="block text-xs font-semibold text-gray-400 uppercase tracking-widest mb-2" for="password">Password</label>
                <div class="relative">
                    <input type="password" id="password" name="password" required
                           placeholder="••••••••"
                           class="w-full rounded-xl px-4 py-3 text-sm text-white placeholder-gray-600 focus:outline-none transition-all duration-200 pr-12"
                           style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);"
                           onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='rgba(255,255,255,0.1)'">
                    <button type="button" onclick="togglePassword()"
                            class="absolute right-3 top-1/2 -translate-y-1/2 text-gray-500 hover:text-gray-300 transition-colors">
                        <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </button>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" id="remember" name="remember" class="w-4 h-4 rounded accent-[#6c63ff]">
                <label for="remember" class="text-sm text-gray-400 cursor-pointer select-none">Remember me</label>
            </div>

            <button type="submit" class="w-full btn-primary py-3.5 flex items-center justify-center gap-2 text-sm font-semibold">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/></svg>
                Sign In to Admin
            </button>
        </form>

        <p class="text-center mt-6 text-xs text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-gray-400 transition-colors">← Back to portfolio</a>
        </p>
    </div>

    <p class="text-center mt-4 text-xs text-gray-700">Default: admin@anup.dev / admin123</p>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    input.type = input.type === 'password' ? 'text' : 'password';
}
</script>
</body>
</html>
