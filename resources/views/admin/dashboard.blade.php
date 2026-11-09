
@extends('layouts.admin')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Your portfolio at a glance.')

@section('content')

@php
    $statCards = [
        ['label'=>'Projects','value'=>$stats['projects'] ?? 0,'icon'=>'🚀','color'=>'#8b7cff','glow'=>'139,124,255','href'=>route('admin.projects.index'),'desc'=>'Portfolio projects'],
        ['label'=>'Skills','value'=>$stats['skills'] ?? 0,'icon'=>'⚡','color'=>'#b794ff','glow'=>'183,148,255','href'=>route('admin.skills.index'),'desc'=>'Technical skills'],
        ['label'=>'Testimonials','value'=>$stats['testimonials'] ?? 0,'icon'=>'💬','color'=>'#34d399','glow'=>'52,211,153','href'=>route('admin.testimonials.index'),'desc'=>'Client feedback'],
        ['label'=>'Photos','value'=>$stats['photos'] ?? 0,'icon'=>'📸','color'=>'#fbbf24','glow'=>'251,191,36','href'=>route('admin.photos.index'),'desc'=>'Gallery collection'],
        ['label'=>'Messages','value'=>$stats['messages'] ?? 0,'icon'=>'📧','color'=>'#38bdf8','glow'=>'56,189,248','href'=>route('admin.messages.index'),'desc'=>'Total received'],
        ['label'=>'Unread','value'=>$stats['unread_messages'] ?? 0,'icon'=>'🔔','color'=>'#fb7185','glow'=>'251,113,133','href'=>route('admin.messages.index'),'desc'=>'Needs attention'],
    ];

    $actions = [
        ['label'=>'Add New Project','desc'=>'Showcase your work','href'=>route('admin.projects.create'),'icon'=>'🚀','color'=>'#8b7cff'],
        ['label'=>'Add New Skill','desc'=>'Update your expertise','href'=>route('admin.skills.create'),'icon'=>'⚡','color'=>'#b794ff'],
        ['label'=>'Upload Photos','desc'=>'Grow your gallery','href'=>route('admin.photos.index'),'icon'=>'📸','color'=>'#fbbf24'],
        ['label'=>'Add Testimonial','desc'=>'Feature client feedback','href'=>route('admin.testimonials.create'),'icon'=>'💬','color'=>'#34d399'],
        ['label'=>'Edit Profile','desc'=>'Update your information','href'=>route('admin.profile.edit'),'icon'=>'👤','color'=>'#38bdf8'],
        ['label'=>'View Messages','desc'=>'Read visitor enquiries','href'=>route('admin.messages.index'),'icon'=>'📨','color'=>'#fb7185'],
    ];

    $activeProjects = \App\Models\Project::where('is_active', true)->count();
    $featuredProjects = \App\Models\Project::where('is_featured', true)->count();
    $activeSkills = \App\Models\Skill::where('is_active', true)->count();

    $totalProjects = $stats['projects'] ?? 0;
    $totalSkills = $stats['skills'] ?? 0;

    $overviewItems = [
        [
            'label'=>'Active Projects',
            'count'=>$activeProjects,
            'total'=>$totalProjects,
            'progress'=>$totalProjects ? min(100,round($activeProjects/$totalProjects*100)) : 0,
            'color'=>'#8b7cff'
        ],
        [
            'label'=>'Featured Projects',
            'count'=>$featuredProjects,
            'total'=>$totalProjects,
            'progress'=>$totalProjects ? min(100,round($featuredProjects/$totalProjects*100)) : 0,
            'color'=>'#fb7185'
        ],
        [
            'label'=>'Active Skills',
            'count'=>$activeSkills,
            'total'=>$totalSkills,
            'progress'=>$totalSkills ? min(100,round($activeSkills/$totalSkills*100)) : 0,
            'color'=>'#34d399'
        ],
    ];
@endphp

<div class="dash space-y-6 sm:space-y-8">

    {{-- Welcome banner --}}
    <section class="dash-hero relative overflow-hidden rounded-3xl p-5 sm:p-7 lg:p-9">
        <div class="hero-orb orb-one"></div>
        <div class="hero-orb orb-two"></div>

        <div class="relative z-10 flex flex-col sm:flex-row sm:items-center justify-between gap-5">
            <div>
                <div class="inline-flex items-center gap-2 rounded-full border border-white/10 bg-white/5 px-3 py-1.5 text-xs text-gray-300 mb-4">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                    Admin Control Center
                </div>

                <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold tracking-tight text-white">
                    Welcome back<span class="text-violet-400">.</span>
                </h2>

                <p class="mt-2 text-sm text-gray-400 max-w-xl">
                    Manage your projects, showcase your skills and stay on top of visitor messages.
                </p>
            </div>

            <a href="{{ url('/') }}" target="_blank" rel="noopener noreferrer"
               class="hero-button inline-flex items-center justify-center gap-2 rounded-xl px-5 py-3 text-sm font-semibold text-white">
                View Live Website ↗
            </a>
        </div>
    </section>

    {{-- Statistics --}}
    <section>
        <div class="flex items-center justify-between gap-3 mb-4">
            <div>
                <h3 class="text-base sm:text-lg font-semibold text-white">Portfolio Statistics</h3>
                <p class="text-xs sm:text-sm text-gray-500 mt-1">Your current content overview</p>
            </div>
            <span class="live-tag">LIVE DATA</span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 2xl:grid-cols-6 gap-4">
            @foreach($statCards as $i => $card)
                <a href="{{ $card['href'] }}" class="stat-card group"
                   style="--accent:{{ $card['color'] }};--glow:{{ $card['glow'] }};--delay:{{ $i * 60 }}ms">

                    <div class="stat-glow"></div>

                    <div class="relative z-10 flex items-start justify-between">
                        <div class="stat-icon">{{ $card['icon'] }}</div>
                        <span class="stat-arrow">↗</span>
                    </div>

                    <div class="relative z-10 mt-6">
                        <div class="stat-number" data-count="{{ (int)$card['value'] }}">
                            {{ number_format((int)$card['value']) }}
                        </div>
                        <div class="mt-2 text-sm font-semibold text-gray-200">
                            {{ $card['label'] }}
                        </div>
                        <div class="mt-1 text-xs text-gray-500">{{ $card['desc'] }}</div>
                    </div>

                    <div class="stat-line"></div>
                </a>
            @endforeach
        </div>
    </section>

    {{-- Actions and messages --}}
    <div class="grid grid-cols-1 lg:grid-cols-5 gap-5 lg:gap-6">

        <section class="dash-panel rounded-2xl p-5 sm:p-6 lg:col-span-2">
            <div class="mb-5">
                <h3 class="text-base font-semibold text-white">Quick Actions</h3>
                <p class="text-xs text-gray-500 mt-1">Shortcuts to common tasks</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                @foreach($actions as $action)
                    <a href="{{ $action['href'] }}" class="action-link group"
                       style="--action-color:{{ $action['color'] }}">
                        <span class="action-icon">{{ $action['icon'] }}</span>
                        <span class="min-w-0 flex-1">
                            <span class="block text-sm font-medium text-gray-200 group-hover:text-white">
                                {{ $action['label'] }}
                            </span>
                            <span class="block text-xs text-gray-500 mt-1">{{ $action['desc'] }}</span>
                        </span>
                        <span class="action-arrow">›</span>
                    </a>
                @endforeach
            </div>
        </section>

        <section class="dash-panel rounded-2xl p-5 sm:p-6 lg:col-span-3 min-w-0">
            <div class="flex items-center justify-between gap-3 mb-5">
                <div>
                    <h3 class="text-base font-semibold text-white">Recent Messages</h3>
                    <p class="text-xs text-gray-500 mt-1">Latest visitor enquiries</p>
                </div>
                <a href="{{ route('admin.messages.index') }}" class="view-link">
                    View all →
                </a>
            </div>

            @if($recentMessages->count())
                <div class="space-y-1">
                    @foreach($recentMessages as $msg)
                        <a href="{{ route('admin.messages.show', $msg) }}"
                           class="message-link group flex items-start gap-3 rounded-xl p-3">

                            <div class="message-avatar">
                                {{ strtoupper(substr($msg->name ?? 'U',0,2)) }}
                            </div>

                            <div class="flex-1 min-w-0">
                                <div class="flex flex-wrap items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-200 group-hover:text-white truncate">
                                        {{ $msg->name }}
                                    </span>
                                    @if(!$msg->is_read)
                                        <span class="unread-tag">
                                            <span class="w-1.5 h-1.5 rounded-full bg-violet-400"></span>
                                            New
                                        </span>
                                    @endif
                                </div>
                                <p class="text-xs sm:text-sm text-gray-500 mt-1 truncate">
                                    {{ $msg->subject ?: $msg->message }}
                                </p>
                                <p class="text-xs text-gray-600 mt-1.5">
                                    {{ $msg->created_at?->diffForHumans() }}
                                </p>
                            </div>
                            <span class="message-arrow">›</span>
                        </a>
                    @endforeach
                </div>
            @else
                <div class="empty-state">
                    <div class="text-3xl mb-3">📭</div>
                    <p class="text-sm font-medium text-gray-300">No messages yet</p>
                    <p class="text-xs text-gray-500 mt-1">New enquiries will appear here.</p>
                </div>
            @endif
        </section>
    </div>

    {{-- Portfolio overview --}}
    <section class="dash-panel rounded-2xl p-5 sm:p-6">
        <div class="mb-6">
            <h3 class="text-base font-semibold text-white">Portfolio Overview</h3>
            <p class="text-xs text-gray-500 mt-1">Content status at a glance</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 md:gap-8">
            @foreach($overviewItems as $item)
                <div style="--progress-color:{{ $item['color'] }}">
                    <div class="flex items-start justify-between gap-3 mb-3">
                        <div>
                            <p class="text-sm font-medium text-gray-300">{{ $item['label'] }}</p>
                            <p class="text-xs text-gray-500 mt-1">
                                {{ $item['count'] }} of {{ $item['total'] }} items
                            </p>
                        </div>
                        <span class="text-sm font-bold text-white">{{ $item['progress'] }}%</span>
                    </div>

                    <div class="progress-track">
                        <div class="progress-fill"
                             data-progress="{{ $item['progress'] }}"
                             style="width:0%"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <footer class="flex flex-col sm:flex-row items-center justify-between gap-2 px-1 pb-2 text-xs text-gray-600">
        <span>Portfolio Administration</span>
        <span>Manage your work. Track your progress.</span>
    </footer>
</div>

<style>
    .dash { animation: dash-enter .5s ease-out both; }

    .dash-hero {
        background:
            radial-gradient(ellipse at 85% 20%,rgba(139,124,255,.17),transparent 45%),
            linear-gradient(120deg,#17162b,#111322 60%,#171827);
        border: 1px solid rgba(255,255,255,.08);
        box-shadow: 0 18px 50px rgba(0,0,0,.14);
    }

    .hero-orb {
        position:absolute;
        width:200px;
        height:200px;
        border-radius:50%;
        filter:blur(65px);
        opacity:.2;
        pointer-events:none;
        animation:orb-float 9s ease-in-out infinite alternate;
    }

    .orb-one { background:#6c63ff;right:5%;top:-140px; }
    .orb-two { background:#ec4899;right:30%;bottom:-190px;animation-delay:-4s; }

    .hero-button {
        background:linear-gradient(110deg,#7465f5,#8b5cf6);
        box-shadow:0 5px 22px rgba(124,92,246,.22);
        transition:transform .25s,box-shadow .25s;
    }

    .hero-button:hover {
        transform:translateY(-3px);
        box-shadow:0 10px 30px rgba(124,92,246,.35);
    }

    .live-tag {
        color:#6ee7b7;
        background:rgba(52,211,153,.06);
        border:1px solid rgba(52,211,153,.2);
        padding:6px 9px;
        border-radius:8px;
        font-size:10px;
        letter-spacing:.1em;
    }

    .stat-card {
        position:relative;
        isolation:isolate;
        min-width:0;
        overflow:hidden;
        padding:20px;
        border:1px solid rgba(255,255,255,.075);
        border-radius:18px;
        background:linear-gradient(145deg,rgba(28,30,48,.96),rgba(18,20,33,.98));
        animation:dash-enter .55s ease-out both;
        animation-delay:var(--delay,0ms);
        transition:transform .28s,border-color .28s,box-shadow .28s;
    }

    .stat-card:hover {
        transform:translateY(-5px);
        border-color:rgba(var(--glow),.4);
        box-shadow:0 16px 35px rgba(0,0,0,.2),0 0 25px rgba(var(--glow),.07);
    }

    .stat-glow {
        position:absolute;
        right:-60px;
        top:-65px;
        width:130px;
        height:130px;
        border-radius:50%;
        background:rgba(var(--glow),.12);
        filter:blur(25px);
        transition:transform .4s;
    }

    .stat-card:hover .stat-glow { transform:scale(1.5); }

    .stat-icon {
        width:46px;
        height:46px;
        display:grid;
        place-items:center;
        border-radius:13px;
        background:rgba(var(--glow),.1);
        border:1px solid rgba(var(--glow),.15);
        font-size:23px;
        transition:transform .3s;
    }

    .stat-card:hover .stat-icon { transform:rotate(-7deg) scale(1.08); }

    .stat-arrow {
        color:#70758b;
        transition:transform .2s,color .2s;
    }

    .stat-card:hover .stat-arrow {
        color:white;
        transform:translate(2px,-2px);
    }

    .stat-number {
        color:white;
        font-size:clamp(28px,2.2vw,36px);
        font-weight:800;
        line-height:1.15;
        letter-spacing:-.04em;
        font-variant-numeric:tabular-nums;
    }

    .stat-line {
        position:absolute;
        bottom:0;
        left:12%;
        width:0;
        height:2px;
        background:var(--accent);
        box-shadow:0 0 12px var(--accent);
        transition:width .35s;
    }

    .stat-card:hover .stat-line { width:76%; }

    .dash-panel {
        min-width:0;
        background:linear-gradient(145deg,rgba(24,26,41,.96),rgba(17,19,31,.98));
        border:1px solid rgba(255,255,255,.07);
        box-shadow:0 8px 30px rgba(0,0,0,.09);
        transition:border-color .25s;
    }

    .dash-panel:hover { border-color:rgba(255,255,255,.12); }

    .action-link {
        display:flex;
        align-items:center;
        gap:12px;
        min-width:0;
        padding:11px;
        border:1px solid transparent;
        border-radius:12px;
        transition:background .22s,border-color .22s,transform .22s;
    }

    .action-link:hover {
        background:rgba(255,255,255,.035);
        border-color:rgba(255,255,255,.075);
        transform:translateX(3px);
    }

    .action-icon {
        display:grid;
        place-items:center;
        width:40px;
        height:40px;
        flex-shrink:0;
        border-radius:11px;
        background:color-mix(in srgb,var(--action-color) 11%,transparent);
        border:1px solid color-mix(in srgb,var(--action-color) 15%,transparent);
        font-size:21px;
        transition:transform .25s;
    }

    .action-link:hover .action-icon { transform:scale(1.07); }

    .action-arrow {
        margin-left:auto;
        color:#626980;
        transition:transform .2s,color .2s;
    }

    .action-link:hover .action-arrow {
        color:var(--action-color);
        transform:translateX(3px);
    }

    .view-link {
        flex-shrink:0;
        color:#a99bff;
        font-size:12px;
        font-weight:600;
    }

    .view-link:hover { color:#d6ceff; }

    .message-link {
        border:1px solid transparent;
        transition:background .22s,border-color .22s;
    }

    .message-link:hover {
        background:rgba(255,255,255,.035);
        border-color:rgba(255,255,255,.06);
    }

    .message-avatar {
        width:40px;
        height:40px;
        display:grid;
        place-items:center;
        flex-shrink:0;
        border-radius:12px;
        color:white;
        font-size:13px;
        font-weight:800;
        background:linear-gradient(135deg,#6557df,#bb68bd);
    }

    .unread-tag {
        display:inline-flex;
        align-items:center;
        gap:5px;
        padding:3px 7px;
        border-radius:999px;
        background:rgba(139,124,255,.1);
        color:#c4b5fd;
        font-size:10px;
        font-weight:600;
    }

    .message-arrow {
        color:#626980;
        transition:transform .2s,color .2s;
    }

    .message-link:hover .message-arrow {
        color:#a99bff;
        transform:translateX(3px);
    }

    .empty-state {
        display:flex;
        flex-direction:column;
        align-items:center;
        justify-content:center;
        padding:48px 16px;
        text-align:center;
        border:1px dashed rgba(255,255,255,.1);
        border-radius:12px;
        background:rgba(255,255,255,.015);
    }

    .progress-track {
        height:8px;
        overflow:hidden;
        border-radius:999px;
        background:rgba(255,255,255,.065);
    }

    .progress-fill {
        height:100%;
        border-radius:999px;
        background:linear-gradient(90deg,var(--progress-color),color-mix(in srgb,var(--progress-color) 65%,white));
        box-shadow:0 0 12px color-mix(in srgb,var(--progress-color) 35%,transparent);
        transition:width 1.1s cubic-bezier(.2,.8,.2,1);
    }

    @keyframes dash-enter {
        from { opacity:0;transform:translateY(12px); }
        to { opacity:1;transform:translateY(0); }
    }

    @keyframes orb-float {
        from { transform:translate3d(0,0,0); }
        to { transform:translate3d(-22px,18px,0); }
    }

    @media(max-width:640px) {
        .dash-hero { border-radius:20px; }
        .stat-card { padding:16px; }
        .stat-card:hover { transform:translateY(-2px); }
    }

    @media(prefers-reduced-motion:reduce) {
        .dash,.stat-card,.hero-orb { animation:none!important; }
        .dash * { scroll-behavior:auto!important;transition:none!important; }
    }
</style>

<script>
(function () {
    function initDashboard() {
        const root = document.querySelector('.dash');
        if (!root || root.dataset.initialized) return;
        root.dataset.initialized = 'true';

        const reduceMotion = window.matchMedia(
            '(prefers-reduced-motion: reduce)'
        ).matches;

        root.querySelectorAll('.stat-number').forEach(function (el) {
            const target = Number(el.dataset.count || 0);

            if (reduceMotion || target === 0) {
                el.textContent = target.toLocaleString();
                return;
            }

            const start = performance.now();
            const duration = 900;

            function animate(now) {
                const progress = Math.min((now - start) / duration, 1);
                const eased = 1 - Math.pow(1 - progress, 4);

                el.textContent = Math.round(target * eased).toLocaleString();

                if (progress < 1) requestAnimationFrame(animate);
            }

            requestAnimationFrame(animate);
        });

        root.querySelectorAll('.progress-fill').forEach(function (el) {
            const value = Math.max(
                0,
                Math.min(100, Number(el.dataset.progress || 0))
            );

            if (reduceMotion) {
                el.style.width = value + '%';
            } else {
                requestAnimationFrame(function () {
                    el.style.width = value + '%';
                });
            }
        });
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initDashboard, { once: true });
    } else {
        initDashboard();
    }
})();
</script>

@endsection
