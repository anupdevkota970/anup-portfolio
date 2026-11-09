@extends('layouts.admin')
@section('title', 'Messages')
@section('page-title', 'Contact Messages')
@section('page-subtitle', 'Messages received from your portfolio contact form.')

@section('content')
<div class="py-4">
    <div class="admin-card overflow-hidden">
        <table class="w-full text-sm">
            <thead>
                <tr style="border-bottom: 1px solid rgba(255,255,255,0.07);">
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Sender</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden md:table-cell">Subject</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                    <th class="text-left px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider hidden lg:table-cell">Date</th>
                    <th class="text-right px-5 py-3.5 text-xs font-semibold text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($messages as $msg)
                <tr class="table-row {{ !$msg->is_read ? 'bg-[#6c63ff]/5' : '' }}">
                    <td class="px-5 py-4">
                        <div class="flex items-center gap-3">
                            @if(!$msg->is_read)
                            <div class="w-1.5 h-1.5 rounded-full bg-[#6c63ff] flex-shrink-0"></div>
                            @else
                            <div class="w-1.5 h-1.5 rounded-full flex-shrink-0"></div>
                            @endif
                            <div>
                                <div class="font-medium text-white">{{ $msg->name }}</div>
                                <div class="text-xs text-gray-500">{{ $msg->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-5 py-4 hidden md:table-cell">
                        <span class="text-gray-300 truncate max-w-xs block">{{ $msg->subject ?? 'No subject' }}</span>
                    </td>
                    <td class="px-5 py-4">
                        <span class="badge {{ $msg->is_read ? 'badge-green' : 'badge-purple' }}">
                            {{ $msg->is_read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td class="px-5 py-4 hidden lg:table-cell text-xs text-gray-500">
                        {{ $msg->created_at->format('M d, Y H:i') }}
                    </td>
                    <td class="px-5 py-4">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.messages.show', $msg) }}" class="btn-admin-secondary">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                Read
                            </a>
                            <form method="POST" action="{{ route('admin.messages.destroy', $msg) }}" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-admin-danger" data-confirm="Delete this message from {{ $msg->name }}?">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="px-5 py-12 text-center text-gray-500">No messages yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
        <div class="px-5 py-3" style="border-top: 1px solid rgba(255,255,255,0.06);">
            {{ $messages->links() }}
        </div>
    </div>
</div>
@endsection
