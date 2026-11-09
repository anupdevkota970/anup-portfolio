@extends('layouts.admin')
@section('title', $skill->exists ? 'Edit Skill' : 'New Skill')
@section('page-title', $skill->exists ? 'Edit Skill' : 'New Skill')
@section('page-subtitle', 'Configure skill details.')

@section('content')
<div class="py-4 max-w-xl">
    <form method="POST" action="{{ $skill->exists ? route('admin.skills.update', $skill) : route('admin.skills.store') }}">
        @csrf
        @if($skill->exists) @method('PUT') @endif

        <div class="admin-card p-6 space-y-5">

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Skill Name *</label>
                    <input type="text" name="name" value="{{ old('name', $skill->name) }}" required class="form-input" placeholder="Laravel">
                </div>
                <div>
                    <label class="form-label">Category *</label>
                    <select name="category" class="form-input">
                        <option value="technical" {{ old('category', $skill->category) === 'technical' ? 'selected' : '' }}>Technical (Progress Bar)</option>
                        <option value="stack" {{ old('category', $skill->category) === 'stack' ? 'selected' : '' }}>Tech Stack (Badge)</option>
                    </select>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Proficiency Level (0-100)</label>
                    <div class="flex items-center gap-3">
                        <input type="range" name="level" id="level-range"
                               value="{{ old('level', $skill->level ?? 80) }}" min="0" max="100"
                               class="flex-1 accent-[#6c63ff]"
                               oninput="document.getElementById('level-display').textContent=this.value+'%'">
                        <span id="level-display" class="text-sm font-bold text-[#6c63ff] w-10">{{ old('level', $skill->level ?? 80) }}%</span>
                    </div>
                </div>
                <div>
                    <label class="form-label">Icon (emoji)</label>
                    <input type="text" name="icon" value="{{ old('icon', $skill->icon) }}" class="form-input" placeholder="🔴">
                </div>
            </div>

            <div>
                <label class="form-label">Accent Color *</label>
                <div class="flex items-center gap-3">
                    <input type="color" name="color" value="{{ old('color', $skill->color ?? '#6c63ff') }}"
                           class="w-10 h-10 rounded-lg cursor-pointer border-0 p-0 bg-transparent">
                    <input type="text" value="{{ old('color', $skill->color ?? '#6c63ff') }}" class="form-input flex-1"
                           placeholder="#6c63ff"
                           oninput="document.querySelector('[name=color]').value=this.value">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Badge Background (optional)</label>
                    <input type="text" name="bg_color" value="{{ old('bg_color', $skill->bg_color) }}" class="form-input" placeholder="#6c63ff15">
                </div>
                <div>
                    <label class="form-label">Badge Border (optional)</label>
                    <input type="text" name="border_color" value="{{ old('border_color', $skill->border_color) }}" class="form-input" placeholder="#6c63ff40">
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $skill->sort_order ?? 0) }}" class="form-input" min="0">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $skill->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-[#6c63ff]">
                        <span class="text-sm text-gray-300">Active (visible)</span>
                    </label>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="btn-admin-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ $skill->exists ? 'Update Skill' : 'Create Skill' }}
            </button>
            <a href="{{ route('admin.skills.index') }}" class="btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
