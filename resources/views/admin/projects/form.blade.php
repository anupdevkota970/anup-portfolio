@extends('layouts.admin')
@section('title', $project->exists ? 'Edit Project' : 'New Project')
@section('page-title', $project->exists ? 'Edit Project' : 'New Project')
@section('page-subtitle', $project->exists ? 'Update project details.' : 'Add a new project to your portfolio.')

@section('content')
<div class="py-4 max-w-2xl">
    <form method="POST" action="{{ $project->exists ? route('admin.projects.update', $project) : route('admin.projects.store') }}">
        @csrf
        @if($project->exists) @method('PUT') @endif

        <div class="admin-card p-6 space-y-5">

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Project Title *</label>
                    <input type="text" name="title" value="{{ old('title', $project->title) }}" required class="form-input" placeholder="E-Commerce Platform">
                </div>
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $project->icon ?? '🚀') }}" class="form-input" placeholder="🚀">
                </div>
            </div>

            <div>
                <label class="form-label">Description *</label>
                <textarea name="description" rows="3" required class="form-input" placeholder="Describe the project...">{{ old('description', $project->description) }}</textarea>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Accent Color *</label>
                    <div class="flex items-center gap-3">
                        <input type="color" name="color" value="{{ old('color', $project->color ?? '#6c63ff') }}"
                               class="w-10 h-10 rounded-lg cursor-pointer border-0 p-0 bg-transparent">
                        <input type="text" id="color-text" value="{{ old('color', $project->color ?? '#6c63ff') }}"
                               class="form-input flex-1" placeholder="#6c63ff"
                               oninput="document.querySelector('[name=color]').value=this.value">
                    </div>
                </div>
                <div>
                    <label class="form-label">Tags (comma-separated)</label>
                    <input type="text" name="tags"
                           value="{{ old('tags', is_array($project->tags) ? implode(', ', $project->tags) : $project->tags) }}"
                           class="form-input" placeholder="Laravel, Vue.js, MySQL">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Demo URL</label>
                    <input type="url" name="demo_url" value="{{ old('demo_url', $project->demo_url) }}" class="form-input" placeholder="https://demo.example.com">
                </div>
                <div>
                    <label class="form-label">Source Code URL</label>
                    <input type="url" name="code_url" value="{{ old('code_url', $project->code_url) }}" class="form-input" placeholder="https://github.com/...">
                </div>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $project->sort_order ?? 0) }}" class="form-input" min="0">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project->is_featured) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-[#6c63ff]">
                        <span class="text-sm text-gray-300">Featured project</span>
                    </label>
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $project->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-[#6c63ff]">
                        <span class="text-sm text-gray-300">Active (visible)</span>
                    </label>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="btn-admin-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ $project->exists ? 'Update Project' : 'Create Project' }}
            </button>
            <a href="{{ route('admin.projects.index') }}" class="btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
