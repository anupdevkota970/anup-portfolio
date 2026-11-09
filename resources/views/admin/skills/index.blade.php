@extends('layouts.admin')
@section('title', 'Skills')
@section('page-title', 'Skills')
@section('page-subtitle', 'Manage your technical skills and tech stack.')

@section('content')
<div class="py-4">
    <div class="flex items-center justify-between mb-5">
        <p class="text-sm text-gray-500">{{ $skills->count() }} total skills</p>
        <a href="{{ route('admin.skills.create') }}" class="btn-admin-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Skill
        </a>
    </div>

    @php $grouped = $skills->groupBy('category'); @endphp

    @foreach(['technical' => 'Technical Skills (Progress Bars)', 'stack' => 'Tech Stack (Badges)'] as $cat => $label)
    @if(isset($grouped[$cat]) && $grouped[$cat]->count())
    <div class="mb-6">
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 px-1">{{ $label }}</h3>
        <div class="admin-card overflow-hidden">
            <table class="w-full text-sm">
                <thead>
                    <tr style="border-bottom: 1px solid rgba(255,255,255,0.07);">
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Skill</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Level</th>
                        <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($grouped[$cat] as $skill)
                    <tr class="table-row">
                        <td class="px-5 py-3.5">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-base"
                                     style="background: {{ $skill->bg_color ?? $skill->color.'22' }}; border: 1px solid {{ $skill->border_color ?? $skill->color.'44' }};">
                                    {{ $skill->icon }}
                                </div>
                                <div>
                                    <div class="font-medium text-white">{{ $skill->name }}</div>
                                    <div class="text-xs" style="color: {{ $skill->color }}">{{ $skill->color }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-5 py-3.5">
                            @if($cat === 'technical')
                            <div class="flex items-center gap-3">
                                <div class="flex-1 h-1.5 bg-white/5 rounded-full overflow-hidden max-w-24">
                                    <div class="h-full rounded-full" style="width: {{ $skill->level }}%; background: {{ $skill->color }};"></div>
                                </div>
                                <span class="text-xs font-semibold" style="color: {{ $skill->color }}">{{ $skill->level }}%</span>
                            </div>
                            @else
                            <span class="text-xs text-gray-500">—</span>
                            @endif
                        </td>
                        <td class="px-5 py-3.5">
                            <span class="badge {{ $skill->is_active ? 'badge-green' : 'badge-red' }}">
                                {{ $skill->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="px-5 py-3.5">
                            <div class="flex items-center justify-end gap-2">
                                <a href="{{ route('admin.skills.edit', $skill) }}" class="btn-admin-secondary">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('admin.skills.destroy', $skill) }}" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-admin-danger" data-confirm="Delete '{{ $skill->name }}'?">
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endsection
