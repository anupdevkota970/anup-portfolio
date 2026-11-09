@extends('layouts.admin')
@section('title', 'Projects')
@section('page-title', 'Projects')
@section('page-subtitle', 'Manage your portfolio projects.')

@section('content')
<div class="py-4">
    <div class="flex items-center justify-between mb-5">
        <p class="text-sm text-gray-500">{{ $projects->count() }} total projects</p>
        <a href="{{ route('admin.projects.create') }}" class="btn-admin-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            New Project
        </a>
    </div>

    <div class="admin-card overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.07);">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Project</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Tags</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Featured</th>
                    <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($projects as $project)
                <tr class="table-row">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-xl flex items-center justify-center text-xl flex-shrink-0"
                                 style="background: {{ $project->color }}22; border: 1px solid {{ $project->color }}44;">
                                {{ $project->icon }}
                            </div>
                            <div>
                                <div class="font-medium text-white">{{ $project->title }}</div>
                                <div class="text-xs text-gray-500 mt-0.5 max-w-xs truncate">{{ $project->description }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell">
                        <div class="flex flex-wrap gap-1">
                            @foreach(($project->tags ?? []) as $tag)
                            <span class="badge badge-purple">{{ $tag }}</span>
                            @endforeach
                        </div>
                    </td>
                    <td class="px-5 py-4">
                        <form method="POST" action="{{ route('admin.projects.toggle', $project) }}">
                            @csrf
                            <button type="submit"
                                    class="badge {{ $project->is_active ? 'badge-green' : 'badge-red' }} cursor-pointer hover:opacity-80 transition-opacity">
                                {{ $project->is_active ? 'Active' : 'Inactive' }}
                            </button>
                        </form>
                    </td>
                    <td class="px-5 py-4">
                        <span class="badge {{ $project->is_featured ? 'badge-yellow' : '' }}" style="{{ !$project->is_featured ? 'background:rgba(255,255,255,0.05);color:rgba(255,255,255,0.3);border:1px solid rgba(255,255,255,0.1);' : '' }}">
                            {{ $project->is_featured ? '⭐ Featured' : 'Normal' }}
                        </span>
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn-admin-secondary">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                Edit
                            </a>
                            <form method="POST" action="{{ route('admin.projects.destroy', $project) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-admin-danger"
                                        data-confirm="Delete '{{ $project->title }}'? This cannot be undone.">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center text-gray-500">
                        No projects yet. <a href="{{ route('admin.projects.create') }}" class="text-[#6c63ff] hover:underline">Add one!</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
