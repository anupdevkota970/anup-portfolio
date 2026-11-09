@extends('layouts.admin')
@section('title', 'Testimonials')
@section('page-title', 'Testimonials')
@section('page-subtitle', 'Manage what clients say about you.')

@section('content')
<div class="py-4">
    <div class="flex items-center justify-between mb-5">
        <p class="text-sm text-gray-500">{{ $testimonials->count() }} testimonials</p>
        <a href="{{ route('admin.testimonials.create') }}" class="btn-admin-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Testimonial
        </a>
    </div>

    <div class="grid md:grid-cols-2 xl:grid-cols-3 gap-4">
        @forelse($testimonials as $t)
        <div class="admin-card p-5 flex flex-col gap-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full flex items-center justify-center text-sm font-bold text-white flex-shrink-0"
                         style="background: linear-gradient(135deg, {{ $t->avatar_color }}, {{ $t->avatar_color }}99);">
                        {{ $t->avatar_initials ?? strtoupper(substr($t->name, 0, 2)) }}
                    </div>
                    <div>
                        <div class="text-sm font-semibold text-white">{{ $t->name }}</div>
                        <div class="text-xs text-gray-500">{{ $t->role }}</div>
                    </div>
                </div>
                <span class="badge {{ $t->is_active ? 'badge-green' : 'badge-red' }}">{{ $t->is_active ? 'Active' : 'Hidden' }}</span>
            </div>

            <div class="flex gap-0.5">
                @for($i = 0; $i < $t->stars; $i++)
                <svg class="w-3.5 h-3.5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                @endfor
            </div>

            <p class="text-xs text-gray-400 leading-relaxed italic line-clamp-3">"{{ $t->content }}"</p>

            <div class="flex items-center gap-2 mt-auto pt-2" style="border-top: 1px solid rgba(255,255,255,0.06);">
                <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn-admin-secondary flex-1 justify-center text-xs">
                    Edit
                </a>
                <form method="POST" action="{{ route('admin.testimonials.destroy', $t) }}">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn-admin-danger" data-confirm="Delete this testimonial?">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="admin-card p-12 text-center text-gray-500 md:col-span-2 xl:col-span-3">
            No testimonials yet. <a href="{{ route('admin.testimonials.create') }}" class="text-[#6c63ff] hover:underline">Add one!</a>
        </div>
        @endforelse
    </div>
</div>
@endsection
