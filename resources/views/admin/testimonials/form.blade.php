@extends('layouts.admin')
@section('title', $testimonial->exists ? 'Edit Testimonial' : 'New Testimonial')
@section('page-title', $testimonial->exists ? 'Edit Testimonial' : 'New Testimonial')

@section('content')
<div class="py-4 max-w-xl">
    <form method="POST" action="{{ $testimonial->exists ? route('admin.testimonials.update', $testimonial) : route('admin.testimonials.store') }}">
        @csrf
        @if($testimonial->exists) @method('PUT') @endif

        <div class="admin-card p-6 space-y-5">

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Client Name *</label>
                    <input type="text" name="name" value="{{ old('name', $testimonial->name) }}" required class="form-input" placeholder="Sarah Johnson">
                </div>
                <div>
                    <label class="form-label">Role / Company *</label>
                    <input type="text" name="role" value="{{ old('role', $testimonial->role) }}" required class="form-input" placeholder="CEO at TechStart">
                </div>
            </div>

            <div>
                <label class="form-label">Testimonial Content *</label>
                <textarea name="content" rows="4" required class="form-input" placeholder="What the client said...">{{ old('content', $testimonial->content) }}</textarea>
            </div>

            <div class="grid sm:grid-cols-3 gap-5">
                <div>
                    <label class="form-label">Avatar Initials</label>
                    <input type="text" name="avatar_initials" maxlength="4"
                           value="{{ old('avatar_initials', $testimonial->avatar_initials ?? strtoupper(substr($testimonial->name ?? '', 0, 2))) }}"
                           class="form-input" placeholder="SJ">
                </div>
                <div>
                    <label class="form-label">Avatar Color</label>
                    <div class="flex items-center gap-2">
                        <input type="color" name="avatar_color" value="{{ old('avatar_color', $testimonial->avatar_color ?? '#6c63ff') }}"
                               class="w-10 h-10 rounded-lg cursor-pointer border-0 p-0 bg-transparent">
                        <input type="text" value="{{ old('avatar_color', $testimonial->avatar_color ?? '#6c63ff') }}"
                               class="form-input flex-1" placeholder="#6c63ff"
                               oninput="document.querySelector('[name=avatar_color]').value=this.value">
                    </div>
                </div>
                <div>
                    <label class="form-label">Stars (1-5)</label>
                    <select name="stars" class="form-input">
                        @for($i = 5; $i >= 1; $i--)
                        <option value="{{ $i }}" {{ old('stars', $testimonial->stars ?? 5) == $i ? 'selected' : '' }}>{{ str_repeat('⭐', $i) }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5">
                <div>
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="{{ old('sort_order', $testimonial->sort_order ?? 0) }}" class="form-input" min="0">
                </div>
                <div class="flex items-end pb-1">
                    <label class="flex items-center gap-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $testimonial->is_active ?? true) ? 'checked' : '' }}
                               class="w-4 h-4 rounded accent-[#6c63ff]">
                        <span class="text-sm text-gray-300">Active (visible)</span>
                    </label>
                </div>
            </div>

        </div>

        <div class="flex items-center gap-3 mt-5">
            <button type="submit" class="btn-admin-primary">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                {{ $testimonial->exists ? 'Update' : 'Create' }}
            </button>
            <a href="{{ route('admin.testimonials.index') }}" class="btn-admin-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection
