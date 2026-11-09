import './bootstrap';

// ─── Translations ═════════════════════════════════════════════════════════════
const translations = {
    en: {
        'nav.home': 'Home', 'nav.about': 'About', 'nav.skills': 'Skills', 'nav.projects': 'Projects',
        'nav.reviews': 'Reviews', 'nav.contact': 'Contact', 'nav.hire_me': 'Hire Me',
        'nav.available': 'Available for work', 'nav.follow': 'Follow me', 'nav.scroll': 'Scroll',
        'hero.greeting': 'Hi, I\'m',
        'hero.bio': 'I craft beautiful, high-performance web applications that solve real problems. Passionate about clean code, intuitive design, and scalable architecture.',
        'hero.view_work': 'View My Work', 'hero.get_touch': 'Get In Touch',
        'stats.exp': 'Years Experience', 'stats.projects': 'Projects Completed',
        'stats.clients': 'Happy Clients', 'stats.commits': 'GitHub Commits',
        'about.label': 'Get to know me', 'about.title_a': 'About', 'about.title_b': 'Me',
        'about.heading': 'Crafting digital experiences', 'about.heading_accent': 'that matter',
        'about.download': 'Download CV', 'about.talk': 'Let\'s Talk',
        'about.age': 'Age', 'about.location': 'Location', 'about.email': 'Email', 'about.degree': 'Degree',
        'skills.label': 'What I work with', 'skills.title_a': 'My', 'skills.title_b': 'Skills',
        'skills.proficiency': 'Technical Proficiency', 'skills.stack': 'Tech Stack',
        'projects.label': 'What I\'ve built', 'projects.title_a': 'Featured', 'projects.title_b': 'Projects',
        'projects.github': 'View All on GitHub', 'projects.demo': 'Live Demo', 'projects.source': 'Source',
        'testimonials.label': 'What people say', 'testimonials.title_a': 'Client', 'testimonials.title_b': 'Testimonials',
        'contact.label': 'Let\'s connect', 'contact.title_a': 'Get In', 'contact.title_b': 'Touch',
        'contact.desc': 'Have a project in mind or just want to say hello? I\'d love to hear from you. I typically respond within 24 hours.',
        'contact.name': 'Your Name', 'contact.email': 'Your Email', 'contact.subject': 'Subject',
        'contact.message': 'Your Message', 'contact.send': 'Send Message',
        'contact.email_l': 'Email', 'contact.phone': 'Phone', 'contact.phone_l': 'Phone',
        'contact.location_l': 'Location', 'contact.freelance': 'Freelance', 'contact.find': 'Find me on',
        'contact.available': 'Available now', 'contact.not_available': 'Not available',
    },
    np: {
        'nav.home': 'गृह', 'nav.about': 'बारे', 'nav.skills': 'सीप', 'nav.projects': 'परियोजना',
        'nav.reviews': 'समीक्षा', 'nav.contact': 'सम्पर्क', 'nav.hire_me': 'मलाई भर्नुहोस्',
        'nav.available': 'कामको लागि उपलब्ध', 'nav.follow': 'फलो गर्नुहोस्', 'nav.scroll': 'स्क्रोल',
        'hero.greeting': 'नमस्ते, म',
        'hero.bio': 'म वास्तविक समस्याहरू समाधान गर्ने सुन्दर, उच्च-प्रदर्शन वेब अनुप्रयोगहरू बनाउँछु। सफा कोड, सहज डिजाइन, र स्केलेबल आर्किटेक्चरमा रुचि राख्छु।',
        'hero.view_work': 'मेरो काम हेर्नुहोस्', 'hero.get_touch': 'सम्पर्क गर्नुहोस्',
        'stats.exp': 'वर्ष अनुभव', 'stats.projects': 'पूरा भएका परियोजना',
        'stats.clients': 'खुशी ग्राहक', 'stats.commits': 'गिटहब कमिट',
        'about.label': 'मलाई चिन्नुहोस्', 'about.title_a': 'मेरो', 'about.title_b': 'बारे',
        'about.heading': 'सार्थक डिजिटल अनुभव', 'about.heading_accent': 'बनाउँदै',
        'about.download': 'सिभी डाउनलोड', 'about.talk': 'कुरा गरौं',
        'about.age': 'उमेर', 'about.location': 'ठाउँ', 'about.email': 'इमेल', 'about.degree': 'डिग्री',
        'skills.label': 'म के सँग काम गर्छु', 'skills.title_a': 'मेरा', 'skills.title_b': 'सीप',
        'skills.proficiency': 'प्राविधिक दक्षता', 'skills.stack': 'प्रविधि स्ट्याक',
        'projects.label': 'मैले बनाएका', 'projects.title_a': 'विशेष', 'projects.title_b': 'परियोजना',
        'projects.github': 'गिटहबमा हेर्नुहोस्', 'projects.demo': 'लाइभ डेमो', 'projects.source': 'स्रोत',
        'testimonials.label': 'मानिसहरूको भनाइ', 'testimonials.title_a': 'ग्राहक', 'testimonials.title_b': 'समीक्षा',
        'contact.label': 'जोडिनुहोस्', 'contact.title_a': 'सम्पर्क', 'contact.title_b': 'गर्नुहोस्',
        'contact.desc': 'कुनै परियोजना छ कि वा नमस्ते भन्न चाहनुहुन्छ? म तपाईंबाट सुन्न चाहन्छु। सामान्यतया २४ घण्टाभित्र जवाफ दिन्छु।',
        'contact.name': 'तपाईंको नाम', 'contact.email': 'तपाईंको इमेल', 'contact.subject': 'विषय',
        'contact.message': 'तपाईंको सन्देश', 'contact.send': 'सन्देश पठाउनुहोस्',
        'contact.email_l': 'इमेल', 'contact.phone': 'फोन', 'contact.phone_l': 'फोन',
        'contact.location_l': 'ठाउँ', 'contact.freelance': 'फ्रिल्यान्स', 'contact.find': 'मलाई भेट्नुहोस्',
        'contact.available': 'अहिले उपलब्ध', 'contact.not_available': 'उपलब्ध छैन',
    }
};

function applyLang(lang) {
    document.querySelectorAll('[data-i18n]').forEach(el => {
        const key = el.dataset.i18n;
        if (translations[lang] && translations[lang][key]) {
            el.textContent = translations[lang][key];
        }
    });
    document.documentElement.lang = lang;
    localStorage.setItem('lang', lang);
    const btn = document.getElementById('lang-toggle-text');
    if (btn) btn.textContent = lang === 'en' ? 'NP' : 'EN';
}

function initLang() {
    const saved = localStorage.getItem('lang') || 'en';
    applyLang(saved);
    const btn = document.getElementById('lang-toggle');
    if (btn) btn.addEventListener('click', () => {
        const current = localStorage.getItem('lang') || 'en';
        applyLang(current === 'en' ? 'np' : 'en');
    });
}

// ─── Theme Toggle ═════════════════════════════════════════════════════════════
function initTheme() {
    const saved = localStorage.getItem('theme') || 'dark';
    document.documentElement.setAttribute('data-theme', saved);
    const btn = document.getElementById('theme-toggle');
    if (btn) btn.addEventListener('click', () => {
        const current = document.documentElement.getAttribute('data-theme');
        const next = current === 'dark' ? 'light' : 'dark';
        document.documentElement.setAttribute('data-theme', next);
        localStorage.setItem('theme', next);
    });
}

// ─── Preloader ════════════════════════════════════════════════════════════════
function initPreloader() {
    window.addEventListener('load', () => {
        setTimeout(() => {
            const pre = document.getElementById('preloader');
            if (pre) pre.classList.add('loaded');
        }, 500);
    });
}

// ─── Particles ════════════════════════════════════════════════════════════════
function initParticles() {
    const canvas = document.getElementById('particles-canvas');
    if (!canvas) return;
    const ctx = canvas.getContext('2d');
    let w, h, particles = [];
    function resize() { w = canvas.width = window.innerWidth; h = canvas.height = window.innerHeight; }
    resize();
    for (let i = 0; i < 70; i++) {
        particles.push({
            x: Math.random() * w, y: Math.random() * h,
            radius: Math.random() * 2.5 + 0.5,
            speedX: (Math.random() - 0.5) * 0.5, speedY: (Math.random() - 0.5) * 0.5,
            opacity: Math.random() * 0.6 + 0.15,
            color: Math.random() > 0.5 ? '108, 99, 255' : '255, 101, 132',
        });
    }
    let mouse = { x: -1000, y: -1000 };
    window.addEventListener('mousemove', e => { mouse.x = e.clientX; mouse.y = e.clientY; });
    function draw() {
        ctx.clearRect(0, 0, w, h);
        for (let i = 0; i < particles.length; i++) {
            for (let j = i + 1; j < particles.length; j++) {
                const dx = particles[i].x - particles[j].x, dy = particles[i].y - particles[j].y;
                const dist = Math.sqrt(dx * dx + dy * dy);
                if (dist < 130) {
                    ctx.beginPath();
                    ctx.strokeStyle = `rgba(108, 99, 255, ${0.1 * (1 - dist / 130)})`;
                    ctx.lineWidth = 0.6;
                    ctx.moveTo(particles[i].x, particles[i].y);
                    ctx.lineTo(particles[j].x, particles[j].y);
                    ctx.stroke();
                }
            }
            const mdx = particles[i].x - mouse.x, mdy = particles[i].y - mouse.y;
            const mdist = Math.sqrt(mdx * mdx + mdy * mdy);
            if (mdist < 150) {
                ctx.beginPath();
                ctx.strokeStyle = `rgba(255, 101, 132, ${0.15 * (1 - mdist / 150)})`;
                ctx.moveTo(particles[i].x, particles[i].y);
                ctx.lineTo(mouse.x, mouse.y);
                ctx.stroke();
            }
        }
        particles.forEach(p => {
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
            ctx.fillStyle = `rgba(${p.color}, ${p.opacity})`;
            ctx.fill();
            p.x += p.speedX; p.y += p.speedY;
            if (p.x < 0 || p.x > w) p.speedX *= -1;
            if (p.y < 0 || p.y > h) p.speedY *= -1;
        });
        requestAnimationFrame(draw);
    }
    draw();
    window.addEventListener('resize', resize);
}

// ─── Typing Effect ═════════════════════════════════════════════════════════════
function initTyping() {
    const el = document.getElementById('typing-text');
    if (!el) return;
    const phrases = el.dataset.phrases ? JSON.parse(el.dataset.phrases) : ['Full Stack Developer'];
    let pi = 0, ci = 0, deleting = false;
    function type() {
        const cur = phrases[pi];
        el.textContent = deleting ? cur.slice(0, ci - 1) : cur.slice(0, ci + 1);
        ci += deleting ? -1 : 1;
        if (!deleting && ci === cur.length) { deleting = true; return setTimeout(type, 1800); }
        if (deleting && ci === 0) { deleting = false; pi = (pi + 1) % phrases.length; }
        setTimeout(type, deleting ? 50 : 100);
    }
    type();
}

// ─── Scroll Animations ════════════════════════════════════════════════════════
function initScrollAnimations() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => { if (e.isIntersecting) e.target.classList.add('visible'); });
    }, { threshold: 0.1 });
    document.querySelectorAll('.section-fade, .reveal-stagger').forEach(el => observer.observe(el));
}

// ─── Skill Bars ═══════════════════════════════════════════════════════════════
function initSkillBars() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) e.target.querySelectorAll('[data-width]').forEach(bar => { bar.style.width = bar.dataset.width; });
        });
    }, { threshold: 0.3 });
    const s = document.getElementById('skills');
    if (s) observer.observe(s);
}

// ─── Active Nav ═══════════════════════════════════════════════════════════════
function initActiveNav() {
    const sections = document.querySelectorAll('section[id]');
    const navLinks = document.querySelectorAll('.nav-link');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                navLinks.forEach(l => {
                    l.classList.remove('active');
                    if (l.getAttribute('href') === `#${e.target.id}`) l.classList.add('active');
                });
            }
        });
    }, { threshold: 0.5 });
    sections.forEach(s => observer.observe(s));
}

// ─── Navbar scroll behavior (hide on scroll down, show on scroll up) ══════════
function initNavbarScroll() {
    const nav = document.getElementById('navbar');
    if (!nav) return;
    let lastScroll = 0;
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            requestAnimationFrame(() => {
                const currentScroll = window.pageYOffset;
                if (currentScroll <= 80) {
                    nav.style.transform = 'translateY(0)';
                    nav.classList.remove('glass-strong');
                    nav.style.padding = '';
                } else {
                    if (currentScroll > lastScroll && currentScroll > 150) {
                        // Scrolling down — hide
                        nav.style.transform = 'translateY(-100%)';
                    } else if (currentScroll < lastScroll) {
                        // Scrolling up — show
                        nav.style.transform = 'translateY(0)';
                        nav.classList.add('glass-strong');
                        nav.style.padding = '0.5rem 0';
                    }
                }
                lastScroll = currentScroll;
                ticking = false;
            });
            ticking = true;
        }
    });
}

// ─── Mobile Menu ═══════════════════════════════════════════════════════════════
function initMobileMenu() {
    const btn = document.getElementById('menu-btn');
    const menu = document.getElementById('mobile-menu');
    if (!btn || !menu) return;
    btn.addEventListener('click', () => {
        menu.classList.toggle('hidden');
        menu.style.animation = menu.classList.contains('hidden') ? '' : 'slide-up 0.3s ease';
    });
    menu.querySelectorAll('a').forEach(l => l.addEventListener('click', () => menu.classList.add('hidden')));
}

// ─── Counters ═════════════════════════════════════════════════════════════════
function initCounters() {
    const observer = new IntersectionObserver(entries => {
        entries.forEach(e => {
            if (e.isIntersecting) {
                e.target.querySelectorAll('[data-count]').forEach(el => {
                    const target = parseInt(el.dataset.count);
                    const dur = 2000, step = target / (dur / 16);
                    let cur = 0;
                    const timer = setInterval(() => {
                        cur += step;
                        if (cur >= target) { cur = target; clearInterval(timer); }
                        el.textContent = Math.floor(cur) + (el.dataset.suffix || '');
                    }, 16);
                });
                observer.unobserve(e.target);
            }
        });
    }, { threshold: 0.5 });
    const s = document.getElementById('stats');
    if (s) observer.observe(s);
}

// ─── 3D Tilt ══════════════════════════════════════════════════════════════════
function initTilt() {
    document.querySelectorAll('.tilt-card').forEach(card => {
        card.addEventListener('mousemove', e => {
            const r = card.getBoundingClientRect();
            const x = e.clientX - r.left, y = e.clientY - r.top;
            const cx = r.width / 2, cy = r.height / 2;
            card.style.transform = `perspective(1000px) rotateX(${((y - cy) / cy) * -8}deg) rotateY(${((x - cx) / cx) * 8}deg) translateZ(10px)`;
        });
        card.addEventListener('mouseleave', () => {
            card.style.transform = 'perspective(1000px) rotateX(0) rotateY(0) translateZ(0)';
        });
    });
}

// ─── Smooth Scroll ═══════════════════════════════════════════════════════════
function initSmoothScroll() {
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            e.preventDefault();
            const t = document.querySelector(a.getAttribute('href'));
            if (t) t.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });
}

// ─── Parallax ═════════════════════════════════════════════════════════════════
function initParallax() {
    const elements = document.querySelectorAll('.parallax');
    window.addEventListener('scroll', () => {
        const scrolled = window.pageYOffset;
        elements.forEach(el => {
            const speed = parseFloat(el.dataset.speed || 0.3);
            el.style.transform = `translateY(${scrolled * speed}px)`;
        });
    });
}

// ─── Magnetic ═════════════════════════════════════════════════════════════════
function initMagnetic() {
    document.querySelectorAll('.magnetic').forEach(el => {
        el.addEventListener('mousemove', e => {
            const r = el.getBoundingClientRect();
            const x = e.clientX - r.left - r.width / 2, y = e.clientY - r.top - r.height / 2;
            el.style.transform = `translate(${x * 0.2}px, ${y * 0.2}px)`;
        });
        el.addEventListener('mouseleave', () => { el.style.transform = 'translate(0, 0)'; });
    });
}

// ─── Scroll Progress ══════════════════════════════════════════════════════════
function initScrollProgress() {
    const bar = document.getElementById('scroll-progress');
    if (!bar) return;
    window.addEventListener('scroll', () => {
        const max = document.documentElement.scrollHeight - window.innerHeight;
        bar.style.width = (window.pageYOffset / max) * 100 + '%';
    });
}

// ─── Init ═════════════════════════════════════════════════════════════════════
document.addEventListener('DOMContentLoaded', () => {
    initTheme();
    initLang();
    initPreloader();
    initParticles();
    initTyping();
    initScrollAnimations();
    initSkillBars();
    initActiveNav();
    initNavbarScroll();
    initMobileMenu();
    initCounters();
    initTilt();
    initSmoothScroll();
    initParallax();
    initMagnetic();
    initScrollProgress();
});
