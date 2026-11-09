@extends('layouts.admin')
@section('title', 'Message from ' . $message->name)
@section('page-title', 'View Message')
@section('page-subtitle', 'From ' . $message->name . ' · ' . $message->created_at->format('M d, Y H:i'))

@section('content')
<div class="py-4 max-w-2xl">
    <div class="admin-card p-6 space-y-5">
        <div class="grid sm:grid-cols-2 gap-5">
            <div>
                <div class="form-label">From</div>
                <div class="text-white font-medium">{{ $message->name }}</div>
            </div>
            <div>
                <div class="form-label">Email</div>
                <a href="mailto:{{ $message->email }}" class="text-[#6c63ff] hover:underline">{{ $message->email }}</a>
            </div>
            <div>
                <div class="form-label">Subject</div>
                <div class="text-gray-300">{{ $message->subject ?? '—' }}</div>
            </div>
            <div>
                <div class="form-label">Received</div>
                <div class="text-gray-300">{{ $message->created_at->format('M d, Y \a\t H:i') }}</div>
            </div>
        </div>

        <div style="border-top: 1px solid rgba(255,255,255,0.06);" class="pt-5">
            <div class="form-label mb-3">Message</div>
            <div class="text-gray-300 leading-relaxed whitespace-pre-wrap rounded-xl p-4"
                 style="background: rgba(255,255,255,0.03); border: 1px solid rgba(255,255,255,0.07);">{{ $message->message }}</div>
        </div>
    </div>

    <div class="flex items-center gap-3 mt-5">
        <a href="mailto:{{ $message->email }}?subject=Re: {{ $message->subject }}" class="btn-admin-primary">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
            Reply via Email
        </a>
        <a href="{{ route('admin.messages.index') }}" class="btn-admin-secondary">← Back</a>
        <form method="POST" action="{{ route('admin.messages.destroy', $message) }}" class="ml-auto">
            @csrf @method('DELETE')
            <button type="submit" class="btn-admin-danger" data-confirm="Delete this message?">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                Delete
            </button>
        </form>
    </div>
</div>
@endsection
