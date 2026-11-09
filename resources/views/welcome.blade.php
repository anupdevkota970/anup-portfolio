<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="{{ $profile->name ?? 'Anup Devkota' }} — {{ $profile->tagline ?? 'Full Stack Developer' }}. Crafting beautiful digital experiences.">
    <title>{{ $profile->name ?? 'Anup Devkota' }} · {{ $profile->tagline ?? 'Full Stack Developer' }}</title>

    <!-- Prevent theme flash -->
    <script>
        document.documentElement.setAttribute('data-theme', localStorage.getItem('theme') || 'dark');
        document.documentElement.lang = localStorage.getItem('lang') || 'en';
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Space+Grotesk:wght@400;500;600;700;800&family=Noto+Sans+Devanagari:wght@400;500;600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f0e17] text-white overflow-x-hidden" style="background-color: var(--bg-body); color: var(--text-main);">

<!-- Preloader -->
<div id="preloader">
    <div class="text-center">
        <div class="loader-text">AD</div>
        <div class="mt-4 w-32 h-0.5 mx-auto rounded-full overflow-hidden" style="background: rgba(255,255,255,0.1);">
            <div class="h-full rounded-full" style="background: linear-gradient(90deg, #6c63ff, #ff6584); animation: marquee 1s ease-in-out infinite;"></div>
        </div>
    </div>
</div>

<!-- Scroll progress bar -->
<div class="fixed top-0 left-0 h-0.5 z-[60] transition-all duration-100" id="scroll-progress"
     style="width: 0%; background: linear-gradient(90deg, #6c63ff, #ff6584);"></div>

<!-- Particle Background -->
<canvas id="particles-canvas"></canvas>

<!-- ─── NAVBAR ──────────────────────────────────────────────────────────────── -->
<nav id="navbar" class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <a href="#home" class="flex items-center gap-2 group">
            <div class="w-9 h-9 rounded-xl flex items-center justify-center text-white font-bold text-lg magnetic"
                 style="background: linear-gradient(135deg, #6c63ff, #ff6584);">A</div>
            <span class="font-display font-bold text-xl transition-colors" style="color: var(--text-main)">{{ $profile->name ?? 'Anup' }}<span style="color:#6c63ff">.</span></span>
        </a>

        <ul class="hidden md:flex items-center gap-8">
            <li><a href="#home" data-i18n="nav.home"     class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">Home</a></li>
            <li><a href="#about" data-i18n="nav.about"    class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">About</a></li>
            <li><a href="#skills" data-i18n="nav.skills"  class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">Skills</a></li>
            <li><a href="#projects" data-i18n="nav.projects" class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">Projects</a></li>
            <li><a href="#testimonials" data-i18n="nav.reviews" class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">Reviews</a></li>
            <li><a href="#contact" data-i18n="nav.contact" class="nav-link text-sm font-medium transition-colors" style="color: var(--text-gray-400)">Contact</a></li>
        </ul>

        <div class="hidden md:flex items-center gap-3">
            @if($profile->is_available)
            <span class="flex items-center gap-2 text-xs text-green-400">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span data-i18n="nav.available">Available</span>
            </span>
            @endif
            <!-- Language Toggle -->
            <button id="lang-toggle" class="lang-toggle" aria-label="Toggle language" title="Switch language">
                <span id="lang-toggle-text" class="text-xs font-bold">NP</span>
            </button>
            <!-- Theme Toggle -->
            <button id="theme-toggle" class="theme-toggle" aria-label="Toggle theme" title="Toggle dark/light">
                <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </button>
            <a href="#contact" data-i18n="nav.hire_me" class="btn-primary magnetic">Hire Me</a>
        </div>

        <!-- Mobile toggles -->
        <div class="flex items-center gap-2 md:hidden">
            <button id="lang-toggle-mobile" class="lang-toggle" style="width:34px;height:34px;" aria-label="Toggle language">
                <span id="lang-toggle-text-mobile" class="text-xs font-bold">NP</span>
            </button>
            <button id="theme-toggle-mobile" class="theme-toggle" style="width:34px;height:34px;" aria-label="Toggle theme">
                <svg class="moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/></svg>
                <svg class="sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width:16px;height:16px;"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
            </button>
            <button id="menu-btn" class="flex flex-col gap-1.5 p-2" aria-label="Toggle menu">
                <span class="w-6 h-0.5 rounded-full" style="background: var(--text-main)"></span>
                <span class="w-6 h-0.5 rounded-full" style="background: var(--text-main)"></span>
                <span class="w-4 h-0.5 rounded-full" style="background: var(--text-main)"></span>
            </button>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden border-t" style="border-color: var(--border-soft);">
        <ul class="flex flex-col gap-1 px-6 py-4">
            <li><a href="#home" data-i18n="nav.home"      class="block py-2 transition-colors" style="color: var(--text-gray-400)">Home</a></li>
            <li><a href="#about" data-i18n="nav.about"     class="block py-2 transition-colors" style="color: var(--text-gray-400)">About</a></li>
            <li><a href="#skills" data-i18n="nav.skills"   class="block py-2 transition-colors" style="color: var(--text-gray-400)">Skills</a></li>
            <li><a href="#projects" data-i18n="nav.projects" class="block py-2 transition-colors" style="color: var(--text-gray-400)">Projects</a></li>
            <li><a href="#testimonials" data-i18n="nav.reviews" class="block py-2 transition-colors" style="color: var(--text-gray-400)">Reviews</a></li>
            <li><a href="#contact" data-i18n="nav.contact"  class="block py-2 transition-colors" style="color: var(--text-gray-400)">Contact</a></li>
            <li><a href="#contact" data-i18n="nav.hire_me" class="btn-primary text-sm inline-block text-center mt-3">Hire Me</a></li>
        </ul>
    </div>
</nav>

<!-- ─── HERO ─────────────────────────────────────────────────────────────────── -->
<section id="home" class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">
    <div class="parallax absolute top-1/4 -left-40 w-96 h-96 rounded-full opacity-25 blur-3xl" data-speed="0.2"
         style="background: radial-gradient(circle, #6c63ff, transparent)"></div>
    <div class="parallax absolute bottom-1/4 -right-40 w-96 h-96 rounded-full opacity-25 blur-3xl" data-speed="-0.2"
         style="background: radial-gradient(circle, #ff6584, transparent); animation-delay: 2s;"></div>
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[600px] rounded-full opacity-5 blur-3xl"
         style="background: radial-gradient(circle, #6c63ff, #ff6584, transparent)"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
        <div class="section-fade">
            <div class="inline-flex items-center gap-2 glass rounded-full px-4 py-2 mb-6">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-xs font-medium" style="color: var(--text-gray-400)" data-i18n="nav.available">Available for work</span>
            </div>

            <h1 class="font-display text-5xl md:text-6xl lg:text-7xl font-bold leading-tight mb-4">
                <span data-i18n="hero.greeting">Hi, I'm</span><br>
                <span class="gradient-text text-glow">{{ $profile->name ?? 'Anup Devkota' }}</span>
            </h1>

            @php
            $phrases = array_filter([
                $profile->tagline ?? 'Full Stack Developer',
                'Laravel Enthusiast', 'UI/UX Designer', 'Problem Solver', 'Open Source Contributor',
            ]);
            @endphp
            <div class="flex items-center gap-2 mb-6 text-xl md:text-2xl font-medium h-9" style="color: var(--text-gray-400)">
                <span id="typing-text" class="text-[#6c63ff] font-semibold" data-phrases='{{ json_encode(array_values($phrases)) }}'></span>
                <span class="typing-cursor"></span>
            </div>

            <p class="text-lg leading-relaxed mb-10 max-w-lg" style="color: var(--text-gray-400)" data-i18n="hero.bio">{{ $profile->bio_short ?? 'I craft beautiful, high-performance web applications that solve real problems. Passionate about clean code, intuitive design, and scalable architecture.' }}</p>

            <div class="flex flex-wrap gap-4">
                <a href="#projects" class="btn-primary magnetic">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0l-7 7m7-7l-7-7"/></svg>
                    <span data-i18n="hero.view_work">View My Work</span>
                </a>
                <a href="#contact" class="btn-outline magnetic">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                    <span data-i18n="hero.get_touch">Get In Touch</span>
                </a>
            </div>

            <div class="flex items-center gap-4 mt-10">
                <span class="text-xs uppercase tracking-widest" style="color: var(--text-gray-500)" data-i18n="nav.follow">Follow me</span>
                <div class="h-px flex-1 max-w-12" style="background: var(--border-soft)"></div>
                @if($profile->github_url)
                <a href="{{ $profile->github_url }}" target="_blank" aria-label="GitHub" class="w-10 h-10 glass rounded-full flex items-center justify-center transition-all duration-300 hover:-translate-y-1 magnetic" style="color: var(--text-gray-400)">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                </a>
                @endif
                @if($profile->linkedin_url)
                <a href="{{ $profile->linkedin_url }}" target="_blank" aria-label="LinkedIn" class="w-10 h-10 glass rounded-full flex items-center justify-center transition-all duration-300 hover:-translate-y-1 magnetic" style="color: var(--text-gray-400)">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                </a>
                @endif
                @if($profile->twitter_url)
                <a href="{{ $profile->twitter_url }}" target="_blank" aria-label="Twitter" class="w-10 h-10 glass rounded-full flex items-center justify-center transition-all duration-300 hover:-translate-y-1 magnetic" style="color: var(--text-gray-400)">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                </a>
                @endif
            </div>
        </div>

        <!-- Right: Avatar / Visual -->
        <div class="section-fade flex justify-center lg:justify-end" style="transition-delay: 0.2s;">
            <div class="relative">
                <div class="absolute inset-0 rounded-full gradient-ring opacity-30"
                     style="width: 380px; height: 380px; margin: -15px; padding: 2px; -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0); -webkit-mask-composite: xor; mask-composite: exclude;"></div>
                <div class="absolute inset-0 rounded-full border border-dashed border-[#ff6584]/20"
                     style="width: 440px; height: 440px; animation: spin-slow 30s linear infinite reverse; margin: -45px;"></div>

                <div class="relative w-80 h-80 blob flex items-center justify-center glow"
                     style="background: linear-gradient(135deg, #6c63ff22, #ff658422);">
                    <div class="w-72 h-72 blob overflow-hidden"
                         style="background: linear-gradient(135deg, #6c63ff, #a78bfa, #ff6584);">
                        @if($profilePhoto && $profilePhoto->path)
                        <img src="{{ $profilePhoto->url() }}" alt="{{ $profile->name ?? 'Avatar' }}"
                             class="w-full h-full object-cover">
                        @elseif($profile->avatar)
                        <img src="{{ $profile->avatarUrl() }}" alt="{{ $profile->name ?? 'Avatar' }}"
                             class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-white font-display font-bold" style="font-size: 6rem;">{{ strtoupper(substr($profile->name ?? 'AD', 0, 2)) }}</div>
                        @endif
                    </div>
                </div>

                @php
                $floatingBadges = $stackSkills->take(4);
                $positions = ['-top-4 -left-8', 'top-12 -right-10', '-bottom-4 -right-6', 'bottom-16 -left-10'];
                @endphp
                @foreach($floatingBadges as $index => $badge)
                <div class="absolute {{ $positions[$index] ?? '-top-4 -left-8' }} glass rounded-xl px-3 py-2 animate-float shadow-lg {{ $index % 2 === 1 ? 'animate-float-delayed' : '' }}" style="{{ $index === 3 ? 'animation-delay:3s;' : '' }}">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold"
                             style="background: {{ $badge->bg_color ?? $badge->color.'22' }}; border: 1px solid {{ $badge->border_color ?? $badge->color.'44' }};">
                            {{ $badge->icon }}
                        </div>
                        <span class="text-xs font-semibold" style="color: var(--text-main)">{{ $badge->name }}</span>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 opacity-60">
        <span class="text-xs uppercase tracking-widest" style="color: var(--text-gray-500)" data-i18n="nav.scroll">Scroll</span>
        <div class="w-6 h-10 glass rounded-full flex items-start justify-center p-1.5">
            <div class="w-1 h-2 bg-[#6c63ff] rounded-full" style="animation: float 1.5s ease-in-out infinite;"></div>
        </div>
    </div>
</section>

<!-- ─── MARQUEE STRIP ─────────────────────────────────────────────────────────── -->
<div class="relative z-10 py-6 border-y overflow-hidden" style="border-color: var(--border-soft);">
    <div class="marquee">
        <div class="marquee-content">
            @foreach($stackSkills as $skill)
            <div class="flex items-center gap-2 px-6 py-2 rounded-full whitespace-nowrap"
                 style="background: {{ $skill->bg_color ?? $skill->color.'15' }}; border: 1px solid {{ $skill->border_color ?? $skill->color.'40' }};">
                <span class="text-lg">{{ $skill->icon }}</span>
                <span class="text-sm font-semibold" style="color: {{ $skill->color }}">{{ $skill->name }}</span>
            </div>
            @endforeach
            @foreach($stackSkills as $skill)
            <div class="flex items-center gap-2 px-6 py-2 rounded-full whitespace-nowrap"
                 style="background: {{ $skill->bg_color ?? $skill->color.'15' }}; border: 1px solid {{ $skill->border_color ?? $skill->color.'40' }};">
                <span class="text-lg">{{ $skill->icon }}</span>
                <span class="text-sm font-semibold" style="color: {{ $skill->color }}">{{ $skill->name }}</span>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ─── STATS ─────────────────────────────────────────────────────────────────── -->
<div id="stats" class="relative z-10 py-16">
    <div class="max-w-7xl mx-auto px-6">
        @php
        $stats = [
            ['value' => '3',  'suffix' => '+',  'i18n' => 'stats.exp'],
            ['value' => $projects->count(), 'suffix' => '+', 'i18n' => 'stats.projects'],
            ['value' => '30', 'suffix' => '+',  'i18n' => 'stats.clients'],
            ['value' => '10', 'suffix' => 'K+', 'i18n' => 'stats.commits'],
        ];
        @endphp
        <div class="reveal-stagger grid grid-cols-2 md:grid-cols-4 gap-6 section-fade">
            @foreach($stats as $stat)
            <div class="glass rounded-2xl p-6 text-center tilt-card hover:glow transition-all duration-300">
                <div class="font-display text-4xl font-bold gradient-text mb-1">
                    <span data-count="{{ $stat['value'] }}" data-suffix="{{ $stat['suffix'] }}">0</span>
                </div>
                <div class="text-sm" style="color: var(--text-gray-400)" data-i18n="{{ $stat['i18n'] }}">{{ $stat['label'] ?? '' }}</div>
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- ─── ABOUT ─────────────────────────────────────────────────────────────────── -->
<section id="about" class="relative z-10 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 section-fade">
            <span class="inline-block text-[#6c63ff] text-sm font-semibold uppercase tracking-widest mb-3" data-i18n="about.label">Get to know me</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-main)">
                <span data-i18n="about.title_a">About</span> <span class="gradient-text" data-i18n="about.title_b">Me</span>
            </h2>
            <div class="w-16 h-1 mx-auto rounded-full" style="background: linear-gradient(135deg, #6c63ff, #ff6584)"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div class="section-fade">
                <div class="relative">
                    <div class="glass rounded-3xl p-1 glow">
                        <div class="rounded-[22px] overflow-hidden" style="background: linear-gradient(135deg, #6c63ff22, #ff658422); min-height: 400px;">
                            <div class="font-mono text-sm p-8 w-full">
                                <div class="mb-2" style="color: var(--text-gray-500)">// about.js</div>
                                <div class="text-[#6c63ff]">const <span style="color: var(--text-main)">developer</span> <span style="color: var(--text-gray-400)">= {</span></div>
                                <div class="pl-4" style="color: var(--text-gray-400)">
                                    <div class="my-1"><span class="text-[#ff6584]">name</span>: <span class="text-green-400">"{{ $profile->name ?? 'Anup Devkota' }}"</span>,</div>
                                    <div class="my-1"><span class="text-[#ff6584]">location</span>: <span class="text-green-400">"{{ $profile->location ?? 'Nepal' }}"</span>,</div>
                                    <div class="my-1"><span class="text-[#ff6584]">role</span>: <span class="text-green-400">"{{ $profile->tagline ?? 'Full Stack Developer' }}"</span>,</div>
                                    @if($profile->degree)<div class="my-1"><span class="text-[#ff6584]">education</span>: <span class="text-green-400">"{{ $profile->degree }}"</span>,</div>@endif
                                    <div class="my-1"><span class="text-[#ff6584]">experience</span>: <span class="text-yellow-400">3</span><span style="color: var(--text-gray-400)">+ years,</span></div>
                                    <div class="my-1"><span class="text-[#ff6584]">available</span>: <span class="text-green-400">{{ $profile->is_available ? 'true' : 'false' }}</span></div>
                                </div>
                                <div style="color: var(--text-gray-400)">};</div>
                                <div class="mt-4" style="color: var(--text-gray-500)">// <span class="text-[#6c63ff]">Let's build something amazing!</span></div>
                            </div>
                        </div>
                    </div>
                    <div class="absolute -top-4 -right-4 w-20 h-20 rounded-2xl opacity-20 blur-xl" style="background: #6c63ff;"></div>
                    <div class="absolute -bottom-4 -left-4 w-20 h-20 rounded-2xl opacity-20 blur-xl" style="background: #ff6584;"></div>
                </div>
            </div>

            <div class="section-fade" style="transition-delay: 0.2s;">
                <h3 class="font-display text-3xl font-bold mb-6" style="color: var(--text-main)">
                    <span data-i18n="about.heading">Crafting digital experiences</span> <span class="gradient-text" data-i18n="about.heading_accent">that matter</span>
                </h3>
                <p class="leading-relaxed mb-6" style="color: var(--text-gray-400)">{{ $profile->bio_long ?? 'I\'m a passionate Full Stack Developer based in Nepal with over 3 years of experience building modern web applications.' }}</p>

                <div class="grid grid-cols-2 gap-4 mb-8">
                    @php
                    $info = [];
                    if ($profile->age)      $info[] = ['icon' => '🎂', 'label' => 'about.age', 'value' => $profile->age . ' Years'];
                    if ($profile->location) $info[] = ['icon' => '📍', 'label' => 'about.location', 'value' => $profile->location];
                    if ($profile->email)    $info[] = ['icon' => '📧', 'label' => 'about.email', 'value' => $profile->email];
                    if ($profile->degree)   $info[] = ['icon' => '🎓', 'label' => 'about.degree', 'value' => $profile->degree];
                    @endphp
                    @foreach($info as $item)
                    <div class="flex items-center gap-3">
                        <span class="text-xl">{{ $item['icon'] }}</span>
                        <div>
                            <div class="text-xs uppercase tracking-wide" style="color: var(--text-gray-500)" data-i18n="{{ $item['label'] }}">{{ $item['label'] }}</div>
                            <div class="text-sm font-medium" style="color: var(--text-main)">{{ $item['value'] }}</div>
                        </div>
                    </div>
                    @endforeach
                </div>

                <div class="flex flex-wrap gap-4">
                    @if($profile->cv_file)
                    <a href="{{ asset('storage/'.$profile->cv_file) }}" target="_blank" class="btn-primary magnetic">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span data-i18n="about.download">Download CV</span>
                    </a>
                    @else
                    <a href="#" class="btn-primary magnetic">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        <span data-i18n="about.download">Download CV</span>
                    </a>
                    @endif
                    <a href="#contact" class="btn-outline magnetic"><span data-i18n="about.talk">Let's Talk</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── SKILLS ────────────────────────────────────────────────────────────────── -->
<section id="skills" class="relative z-10 py-24">
    <div class="absolute inset-0 opacity-5" style="background: radial-gradient(ellipse at center, #6c63ff, transparent 70%)"></div>
    <div class="max-w-7xl mx-auto px-6 relative">
        <div class="text-center mb-16 section-fade">
            <span class="inline-block text-[#6c63ff] text-sm font-semibold uppercase tracking-widest mb-3" data-i18n="skills.label">What I work with</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-main)">
                <span data-i18n="skills.title_a">My</span> <span class="gradient-text" data-i18n="skills.title_b">Skills</span>
            </h2>
            <div class="w-16 h-1 mx-auto rounded-full" style="background: linear-gradient(135deg, #6c63ff, #ff6584)"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-12">
            <div class="section-fade">
                <h3 class="font-display text-xl font-semibold mb-8" style="color: var(--text-gray-300)" data-i18n="skills.proficiency">Technical Proficiency</h3>
                <div class="space-y-5">
                    @foreach($technical as $skill)
                    <div>
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-sm font-medium flex items-center gap-2" style="color: var(--text-gray-300)">{{ $skill->icon }} {{ $skill->name }}</span>
                            <span class="text-sm font-bold" style="color: {{ $skill->color }}">{{ $skill->level }}%</span>
                        </div>
                        <div class="h-2 rounded-full overflow-hidden" style="background: var(--bg-card)">
                            <div class="h-full skill-bar rounded-full" style="width: 0%; background: linear-gradient(90deg, {{ $skill->color }}, {{ $skill->color }}99);"
                                 data-width="{{ $skill->level }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="section-fade" style="transition-delay: 0.2s;">
                <h3 class="font-display text-xl font-semibold mb-8" style="color: var(--text-gray-300)" data-i18n="skills.stack">Tech Stack</h3>
                <div class="grid grid-cols-3 gap-3">
                    @foreach($stackSkills as $tech)
                    <div class="rounded-xl p-3 flex items-center gap-2 cursor-default transition-all duration-300 hover:-translate-y-1 hover:shadow-lg tilt-card"
                         style="background: {{ $tech->bg_color ?? $tech->color.'15' }}; border: 1px solid {{ $tech->border_color ?? $tech->color.'40' }};">
                        <span class="text-lg">{{ $tech->icon }}</span>
                        <span class="text-xs font-semibold" style="color: {{ $tech->color }}">{{ $tech->name }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── PROJECTS ──────────────────────────────────────────────────────────────── -->
<section id="projects" class="relative z-10 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 section-fade">
            <span class="inline-block text-[#6c63ff] text-sm font-semibold uppercase tracking-widest mb-3" data-i18n="projects.label">What I've built</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-main)">
                <span data-i18n="projects.title_a">Featured</span> <span class="gradient-text" data-i18n="projects.title_b">Projects</span>
            </h2>
            <div class="w-16 h-1 mx-auto rounded-full" style="background: linear-gradient(135deg, #6c63ff, #ff6584)"></div>
        </div>

        @if($projects->count())
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($projects as $project)
            <div class="glass rounded-2xl overflow-hidden card-hover tilt-card section-fade group" style="transition-delay: {{ ($loop->index % 3) * 0.1 }}s;">
                <div class="p-6 pb-4">
                    <div class="flex items-start justify-between mb-4">
                        <div class="w-14 h-14 rounded-2xl flex items-center justify-center text-3xl"
                             style="background: {{ $project->color }}22; border: 1px solid {{ $project->color }}44;">{{ $project->icon }}</div>
                        @if($project->is_featured)
                        <span class="text-xs font-semibold px-2 py-1 rounded-full" style="background: {{ $project->color }}22; color: {{ $project->color }}; border: 1px solid {{ $project->color }}44;">⭐ Featured</span>
                        @endif
                    </div>
                    <h3 class="font-display text-lg font-bold mb-2 group-hover:text-[#6c63ff] transition-colors" style="color: var(--text-main)">{{ $project->title }}</h3>
                    <p class="text-sm leading-relaxed" style="color: var(--text-gray-400)">{{ $project->description }}</p>
                </div>
                @if($project->tags)
                <div class="px-6 pb-4">
                    <div class="flex flex-wrap gap-2">
                        @foreach($project->tags as $tag)
                        <span class="text-xs px-2 py-1 rounded-full" style="color: var(--text-gray-400); background: var(--bg-card); border: 1px solid var(--border-soft);">{{ $tag }}</span>
                        @endforeach
                    </div>
                </div>
                @endif
                <div class="px-6 pb-6 flex items-center gap-3">
                    @if($project->demo_url)
                    <a href="{{ $project->demo_url }}" target="_blank" class="flex items-center gap-1.5 text-sm font-medium transition-colors hover:opacity-80" style="color: {{ $project->color }}" data-i18n="projects.demo">Live Demo</a>
                    @endif
                    @if($project->code_url)
                    <a href="{{ $project->code_url }}" target="_blank" class="flex items-center gap-1.5 text-sm font-medium transition-colors hover:opacity-80" style="color: var(--text-gray-400)" data-i18n="projects.source">Source</a>
                    @endif
                </div>
                <div class="h-0.5 w-full opacity-0 group-hover:opacity-100 transition-opacity" style="background: linear-gradient(90deg, {{ $project->color }}, transparent)"></div>
            </div>
            @endforeach
        </div>
        @else
        <div class="text-center py-20" style="color: var(--text-gray-500)">No projects yet.</div>
        @endif

        @if($profile->github_url)
        <div class="text-center mt-12 section-fade">
            <a href="{{ $profile->github_url }}" target="_blank" class="btn-outline inline-flex items-center gap-2 magnetic">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                <span data-i18n="projects.github">View All on GitHub</span>
            </a>
        </div>
        @endif
    </div>
</section>

<!-- ─── TESTIMONIALS ───────────────────────────────────────────────────────────── -->
@if($testimonials->count())
<section id="testimonials" class="relative z-10 py-24">
    <div class="absolute inset-0 opacity-5" style="background: radial-gradient(ellipse at center, #ff6584, transparent 70%)"></div>
    <div class="max-w-7xl mx-auto px-6 relative">
        <div class="text-center mb-16 section-fade">
            <span class="inline-block text-[#ff6584] text-sm font-semibold uppercase tracking-widest mb-3" data-i18n="testimonials.label">What people say</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-main)">
                <span data-i18n="testimonials.title_a">Client</span> <span class="gradient-text" data-i18n="testimonials.title_b">Testimonials</span>
            </h2>
            <div class="w-16 h-1 mx-auto rounded-full" style="background: linear-gradient(135deg, #6c63ff, #ff6584)"></div>
        </div>
        <div class="grid md:grid-cols-3 gap-6">
            @foreach($testimonials as $t)
            <div class="glass rounded-2xl p-6 card-hover section-fade" style="transition-delay: {{ $loop->index * 0.15 }}s;">
                <div class="flex gap-1 mb-4">
                    @for($i = 0; $i < $t->stars; $i++)
                    <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                    @endfor
                </div>
                <p class="text-sm leading-relaxed mb-6 italic" style="color: var(--text-gray-400)">"{{ $t->content }}"</p>
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                         style="background: linear-gradient(135deg, {{ $t->avatar_color }}, {{ $t->avatar_color }}99);">{{ $t->avatar_initials ?? strtoupper(substr($t->name, 0, 2)) }}</div>
                    <div>
                        <div class="font-semibold text-sm" style="color: var(--text-main)">{{ $t->name }}</div>
                        <div class="text-xs" style="color: var(--text-gray-500)">{{ $t->role }}</div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- ─── CONTACT ───────────────────────────────────────────────────────────────── -->
<section id="contact" class="relative z-10 py-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16 section-fade">
            <span class="inline-block text-[#6c63ff] text-sm font-semibold uppercase tracking-widest mb-3" data-i18n="contact.label">Let's connect</span>
            <h2 class="font-display text-4xl md:text-5xl font-bold mb-4" style="color: var(--text-main)">
                <span data-i18n="contact.title_a">Get In</span> <span class="gradient-text" data-i18n="contact.title_b">Touch</span>
            </h2>
            <div class="w-16 h-1 mx-auto rounded-full" style="background: linear-gradient(135deg, #6c63ff, #ff6584)"></div>
            <p class="mt-6 max-w-xl mx-auto" style="color: var(--text-gray-400)" data-i18n="contact.desc">Have a project in mind or just want to say hello? I'd love to hear from you. I typically respond within 24 hours.</p>
        </div>

        @if(session('contact_success'))
        <div class="max-w-5xl mx-auto mb-6 flex items-center gap-3 p-4 rounded-xl text-sm font-medium"
             style="background: rgba(52,211,153,0.12); border: 1px solid rgba(52,211,153,0.3); color: #34d399;">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('contact_success') }}
        </div>
        @endif

        <div class="grid lg:grid-cols-5 gap-10 max-w-5xl mx-auto">
            <div class="lg:col-span-2 section-fade space-y-5">
                @php
                $contactInfo = [];
                if ($profile->email)    $contactInfo[] = ['icon' => '📧', 'label' => 'contact.email_l', 'value' => $profile->email, 'href' => 'mailto:'.$profile->email];
                if ($profile->phone)    $contactInfo[] = ['icon' => '📱', 'label' => 'contact.phone_l', 'value' => $profile->phone, 'href' => 'tel:'.$profile->phone];
                if ($profile->location) $contactInfo[] = ['icon' => '📍', 'label' => 'contact.location_l', 'value' => $profile->location, 'href' => '#'];
                $contactInfo[] = ['icon' => '💼', 'label' => 'contact.freelance', 'value' => $profile->is_available ? 'contact.available' : 'contact.not_available', 'href' => '#', 'is_i18n' => true];
                @endphp
                @foreach($contactInfo as $info)
                <a href="{{ $info['href'] }}" class="glass rounded-2xl p-4 flex items-center gap-4 hover:border-[#6c63ff]/40 transition-all duration-300 hover:-translate-x-1 block" style="border-color: transparent;">
                    <div class="w-12 h-12 rounded-xl flex items-center justify-center text-2xl flex-shrink-0" style="background: rgba(108, 99, 255, 0.1); border: 1px solid rgba(108, 99, 255, 0.2);">{{ $info['icon'] }}</div>
                    <div>
                        <div class="text-xs uppercase tracking-wide" style="color: var(--text-gray-500)" data-i18n="{{ $info['label'] }}">{{ $info['label'] }}</div>
                        @if(isset($info['is_i18n']))
                        <div class="text-sm font-medium" style="color: var(--text-main)" data-i18n="{{ $info['value'] }}">{{ $info['value'] }}</div>
                        @else
                        <div class="text-sm font-medium" style="color: var(--text-main)">{{ $info['value'] }}</div>
                        @endif
                    </div>
                </a>
                @endforeach

                <div class="glass rounded-2xl p-4">
                    <div class="text-xs uppercase tracking-wide mb-3" style="color: var(--text-gray-500)" data-i18n="contact.find">Find me on</div>
                    <div class="flex gap-3">
                        @if($profile->github_url)
                        <a href="{{ $profile->github_url }}" target="_blank" aria-label="GitHub" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="color: var(--text-gray-400); background: var(--bg-card); border: 1px solid var(--border-soft);">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0C5.37 0 0 5.37 0 12c0 5.31 3.435 9.795 8.205 11.385.6.105.825-.255.825-.57 0-.285-.015-1.23-.015-2.235-3.015.555-3.795-.735-4.035-1.41-.135-.345-.72-1.41-1.23-1.695-.42-.225-1.02-.78-.015-.795.945-.015 1.62.87 1.845 1.23 1.08 1.815 2.805 1.305 3.495.99.105-.78.42-1.305.765-1.605-2.67-.3-5.46-1.335-5.46-5.925 0-1.305.465-2.385 1.23-3.225-.12-.3-.54-1.53.12-3.18 0 0 1.005-.315 3.3 1.23.96-.27 1.98-.405 3-.405s2.04.135 3 .405c2.295-1.56 3.3-1.23 3.3-1.23.66 1.65.24 2.88.12 3.18.765.84 1.23 1.905 1.23 3.225 0 4.605-2.805 5.625-5.475 5.925.435.375.81 1.095.81 2.22 0 1.605-.015 2.895-.015 3.3 0 .315.225.69.825.57A12.02 12.02 0 0024 12c0-6.63-5.37-12-12-12z"/></svg>
                        </a>
                        @endif
                        @if($profile->linkedin_url)
                        <a href="{{ $profile->linkedin_url }}" target="_blank" aria-label="LinkedIn" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="color: var(--text-gray-400); background: var(--bg-card); border: 1px solid var(--border-soft);">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 01-2.063-2.065 2.064 2.064 0 112.063 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/></svg>
                        </a>
                        @endif
                        @if($profile->twitter_url)
                        <a href="{{ $profile->twitter_url }}" target="_blank" aria-label="Twitter" class="w-10 h-10 rounded-xl flex items-center justify-center transition-all duration-300 hover:-translate-y-1" style="color: var(--text-gray-400); background: var(--bg-card); border: 1px solid var(--border-soft);">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-4.714-6.231-5.401 6.231H2.744l7.73-8.835L1.254 2.25H8.08l4.253 5.622zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="lg:col-span-3 section-fade" style="transition-delay: 0.2s;">
                <div class="glass rounded-2xl p-8">
                    <form action="{{ route('contact.send') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="grid sm:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-xs uppercase tracking-wide mb-2" style="color: var(--text-gray-400)" for="name" data-i18n="contact.name">Your Name</label>
                                <input type="text" id="name" name="name" placeholder="John Doe" required
                                       class="w-full rounded-xl px-4 py-3 text-sm focus:outline-none transition-all duration-200"
                                       style="background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main);"
                                       onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='var(--input-border)'">
                            </div>
                            <div>
                                <label class="block text-xs uppercase tracking-wide mb-2" style="color: var(--text-gray-400)" for="email" data-i18n="contact.email">Your Email</label>
                                <input type="email" id="email" name="email" placeholder="john@example.com" required
                                       class="w-full rounded-xl px-4 py-3 text-sm focus:outline-none transition-all duration-200"
                                       style="background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main);"
                                       onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='var(--input-border)'">
                            </div>
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wide mb-2" style="color: var(--text-gray-400)" for="subject" data-i18n="contact.subject">Subject</label>
                            <input type="text" id="subject" name="subject" placeholder="Project Inquiry"
                                   class="w-full rounded-xl px-4 py-3 text-sm focus:outline-none transition-all duration-200"
                                   style="background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main);"
                                   onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='var(--input-border)'">
                        </div>
                        <div>
                            <label class="block text-xs uppercase tracking-wide mb-2" style="color: var(--text-gray-400)" for="message" data-i18n="contact.message">Your Message</label>
                            <textarea id="message" name="message" rows="5" placeholder="Tell me about your project..." required
                                      class="w-full rounded-xl px-4 py-3 text-sm focus:outline-none transition-all duration-200 resize-none"
                                      style="background: var(--input-bg); border: 1px solid var(--input-border); color: var(--text-main);"
                                      onfocus="this.style.borderColor='#6c63ff'" onblur="this.style.borderColor='var(--input-border)'"></textarea>
                        </div>
                        <button type="submit" class="w-full btn-primary justify-center py-3.5 magnetic">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                            <span data-i18n="contact.send">Send Message</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ─── FOOTER ────────────────────────────────────────────────────────────────── -->
<footer class="relative z-10 border-t" style="border-color: var(--border-soft);">
    <div class="max-w-7xl mx-auto px-6 py-10">
        <div class="flex flex-col md:flex-row items-center justify-between gap-6">
            <a href="#home" class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-white font-bold" style="background: linear-gradient(135deg, #6c63ff, #ff6584);">A</div>
                <span class="font-display font-bold" style="color: var(--text-main)">{{ $profile->name ?? 'Anup' }}<span style="color:#6c63ff">.</span></span>
            </a>
            <ul class="flex items-center gap-6 text-sm" style="color: var(--text-gray-500)">
                <li><a href="#home" data-i18n="nav.home"      class="hover:text-[#6c63ff] transition-colors">Home</a></li>
                <li><a href="#about" data-i18n="nav.about"     class="hover:text-[#6c63ff] transition-colors">About</a></li>
                <li><a href="#projects" data-i18n="nav.projects" class="hover:text-[#6c63ff] transition-colors">Projects</a></li>
                <li><a href="#contact" data-i18n="nav.contact"  class="hover:text-[#6c63ff] transition-colors">Contact</a></li>
            </ul>
            <p class="text-xs" style="color: var(--text-gray-600)">&copy; {{ date('Y') }} {{ $profile->name ?? 'Anup Devkota' }}. Crafted with <span style="color:#ff6584">❤</span> & Laravel.</p>
        </div>
    </div>
</footer>

<!-- Back to top -->
<button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
        class="fixed bottom-8 right-8 z-50 w-12 h-12 rounded-full flex items-center justify-center text-white shadow-lg transition-all duration-300 hover:-translate-y-1 hover:shadow-[0_10px_30px_rgba(108,99,255,0.4)] magnetic"
        style="background: linear-gradient(135deg, #6c63ff, #574fd6);" aria-label="Back to top">
    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
</button>

<script>
// Wire up mobile toggle buttons to same handlers
document.getElementById('lang-toggle-mobile')?.addEventListener('click', () => document.getElementById('lang-toggle')?.click());
document.getElementById('theme-toggle-mobile')?.addEventListener('click', () => document.getElementById('theme-toggle')?.click());

// Sync lang toggle text on mobile
const langBtn = document.getElementById('lang-toggle');
const langBtnMobile = document.getElementById('lang-toggle-text-mobile');
if (langBtn) {
    const observer = new MutationObserver(() => {
        const text = document.getElementById('lang-toggle-text')?.textContent;
        if (text && langBtnMobile) langBtnMobile.textContent = text;
    });
    observer.observe(document.getElementById('lang-toggle-text'), { childList: true });
}
</script>

</body>
</html>
