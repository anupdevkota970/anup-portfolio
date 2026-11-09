<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\Project;
use App\Models\Skill;
use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin user
        User::updateOrCreate(
            ['email' => 'admin@anup.dev'],
            [
                'name'     => 'Anup Devkota',
                'password' => Hash::make('admin123'),
                'is_admin' => true,
            ]
        );

        // Profile
        Profile::updateOrCreate(
            ['id' => 1],
            [
                'name'         => 'Anup Devkota',
                'tagline'      => 'Full Stack Developer',
                'bio_short'    => 'Passionate Full Stack Developer crafting beautiful digital experiences.',
                'bio_long'     => 'I\'m a passionate Full Stack Developer based in Nepal with 3+ years of experience building modern web applications. I specialize in Laravel, Vue.js, and React, with a strong eye for clean, accessible design.',
                'email'        => 'anup@devkota.dev',
                'phone'        => '+977 98XXXXXXXX',
                'location'     => 'Kathmandu, Nepal',
                'age'          => '24',
                'degree'       => 'B.Sc. CS',
                'github_url'   => 'https://github.com',
                'linkedin_url' => 'https://linkedin.com',
                'twitter_url'  => 'https://twitter.com',
                'is_available' => true,
            ]
        );

        // Skills
        $skills = [
            ['name' => 'Laravel / PHP', 'category' => 'technical', 'level' => 92, 'color' => '#ff2d20', 'icon' => '🔴', 'sort_order' => 1],
            ['name' => 'Vue.js / React', 'category' => 'technical', 'level' => 85, 'color' => '#61dafb', 'icon' => '⚛️', 'sort_order' => 2],
            ['name' => 'Tailwind CSS', 'category' => 'technical', 'level' => 90, 'color' => '#06b6d4', 'icon' => '🌊', 'sort_order' => 3],
            ['name' => 'MySQL / PostgreSQL', 'category' => 'technical', 'level' => 80, 'color' => '#4479a1', 'icon' => '🗄️', 'sort_order' => 4],
            ['name' => 'TypeScript', 'category' => 'technical', 'level' => 75, 'color' => '#3178c6', 'icon' => '🔷', 'sort_order' => 5],
            ['name' => 'Docker / DevOps', 'category' => 'technical', 'level' => 65, 'color' => '#2496ed', 'icon' => '🐳', 'sort_order' => 6],
            ['name' => 'Laravel',    'category' => 'stack', 'level' => 92, 'color' => '#ff6b6b', 'icon' => '🔴', 'bg_color' => '#ff2d2015', 'border_color' => '#ff2d2040', 'sort_order' => 1],
            ['name' => 'Vue.js',     'category' => 'stack', 'level' => 85, 'color' => '#42b883', 'icon' => '💚', 'bg_color' => '#42b88315', 'border_color' => '#42b88340', 'sort_order' => 2],
            ['name' => 'React',      'category' => 'stack', 'level' => 80, 'color' => '#61dafb', 'icon' => '⚛️', 'bg_color' => '#61dafb15', 'border_color' => '#61dafb40', 'sort_order' => 3],
            ['name' => 'Tailwind',   'category' => 'stack', 'level' => 90, 'color' => '#06b6d4', 'icon' => '🌊', 'bg_color' => '#06b6d415', 'border_color' => '#06b6d440', 'sort_order' => 4],
            ['name' => 'TypeScript', 'category' => 'stack', 'level' => 75, 'color' => '#3178c6', 'icon' => '🔷', 'bg_color' => '#3178c615', 'border_color' => '#3178c640', 'sort_order' => 5],
            ['name' => 'MySQL',      'category' => 'stack', 'level' => 80, 'color' => '#4479a1', 'icon' => '🗄️', 'bg_color' => '#4479a115', 'border_color' => '#4479a140', 'sort_order' => 6],
            ['name' => 'Redis',      'category' => 'stack', 'level' => 70, 'color' => '#dc382c', 'icon' => '🔴', 'bg_color' => '#dc382c15', 'border_color' => '#dc382c40', 'sort_order' => 7],
            ['name' => 'Docker',     'category' => 'stack', 'level' => 65, 'color' => '#2496ed', 'icon' => '🐳', 'bg_color' => '#2496ed15', 'border_color' => '#2496ed40', 'sort_order' => 8],
            ['name' => 'Git',        'category' => 'stack', 'level' => 88, 'color' => '#f05020', 'icon' => '📦', 'bg_color' => '#f0502015', 'border_color' => '#f0502040', 'sort_order' => 9],
            ['name' => 'Livewire',   'category' => 'stack', 'level' => 82, 'color' => '#a78bfa', 'icon' => '⚡', 'bg_color' => '#6c63ff15', 'border_color' => '#6c63ff40', 'sort_order' => 10],
        ];

        foreach ($skills as $skill) {
            Skill::firstOrCreate(['name' => $skill['name'], 'category' => $skill['category']], $skill);
        }

        // Projects
        $projects = [
            ['title' => 'E-Commerce Platform', 'description' => 'A full-featured multi-vendor marketplace built with Laravel, Livewire, and Stripe. Real-time inventory tracking and advanced analytics.', 'icon' => '🛒', 'color' => '#6c63ff', 'tags' => ['Laravel', 'Livewire', 'MySQL', 'Stripe'], 'is_featured' => true, 'sort_order' => 1],
            ['title' => 'Task Management SaaS', 'description' => 'Collaborative project management tool with real-time updates, Kanban boards, team workspaces, and time tracking.', 'icon' => '📋', 'color' => '#ff6584', 'tags' => ['Vue.js', 'Laravel', 'WebSockets', 'Redis'], 'is_featured' => true, 'sort_order' => 2],
            ['title' => 'AI Content Generator', 'description' => 'Integrate OpenAI GPT-4 to generate blog posts, social media captions, and marketing copy with a beautiful editor.', 'icon' => '🤖', 'color' => '#a78bfa', 'tags' => ['React', 'OpenAI', 'Node.js', 'TailwindCSS'], 'sort_order' => 3],
            ['title' => 'Real Estate Portal', 'description' => 'Property listing platform with advanced search, map integration, mortgage calculator, and agent dashboard.', 'icon' => '🏠', 'color' => '#34d399', 'tags' => ['Laravel', 'Vue.js', 'Google Maps', 'MySQL'], 'sort_order' => 4],
            ['title' => 'Learning Management System', 'description' => 'Complete LMS with video courses, quizzes, certificates, progress tracking, and Zoom integration.', 'icon' => '🎓', 'color' => '#f59e0b', 'tags' => ['Laravel', 'Livewire', 'FFmpeg', 'S3'], 'sort_order' => 5],
            ['title' => 'Social Media Analytics', 'description' => 'Dashboard aggregating data from multiple social platforms with beautiful charts and automated reporting.', 'icon' => '📊', 'color' => '#06b6d4', 'tags' => ['React', 'Chart.js', 'Python', 'FastAPI'], 'sort_order' => 6],
        ];

        foreach ($projects as $project) {
            Project::firstOrCreate(['title' => $project['title']], $project + ['is_active' => true]);
        }

        // Testimonials
        $testimonials = [
            ['name' => 'Sarah Johnson', 'role' => 'CEO at TechStart', 'avatar_initials' => 'SJ', 'avatar_color' => '#6c63ff', 'content' => 'Anup delivered our e-commerce platform ahead of schedule with exceptional quality. His attention to detail made the entire process seamless. Highly recommended!', 'stars' => 5, 'sort_order' => 1],
            ['name' => 'Marcus Chen', 'role' => 'CTO at DataFlow', 'avatar_initials' => 'MC', 'avatar_color' => '#ff6584', 'content' => 'Outstanding technical skills paired with a deep understanding of business needs. Anup built our analytics dashboard from scratch — it\'s now the backbone of our operations.', 'stars' => 5, 'sort_order' => 2],
            ['name' => 'Priya Sharma', 'role' => 'Founder at EduTech', 'avatar_initials' => 'PS', 'avatar_color' => '#34d399', 'content' => 'Working with Anup was a pleasure. He transformed our rough idea into a beautiful, functional LMS. His Laravel expertise is top-notch.', 'stars' => 5, 'sort_order' => 3],
        ];

        foreach ($testimonials as $t) {
            Testimonial::firstOrCreate(['name' => $t['name']], $t + ['is_active' => true]);
        }
    }
}
