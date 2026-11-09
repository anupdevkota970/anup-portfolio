@extends('layouts.admin')
@section('title', 'Photos')
@section('page-title', 'Photos & Media')
@section('page-subtitle', 'Manage your profile photos and gallery images.')

@section('content')
<div class="py-4 space-y-6">

    <!-- Upload Card -->
    <div class="admin-card p-6">
        <h3 class="font-display text-sm font-semibold text-white mb-4 flex items-center gap-2">
            <span class="w-1.5 h-4 rounded-full inline-block" style="background: #6c63ff;"></span>
            Upload Photos
        </h3>
        <form method="POST" action="{{ route('admin.photos.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="grid sm:grid-cols-3 gap-4 mb-4">
                <div class="sm:col-span-1">
                    <label class="form-label">Photo Type *</label>
                    <select name="type" class="form-input">
                        <option value="profile">Profile Photo (shown in Hero)</option>
                        <option value="about">About Section</option>
                        <option value="gallery">Gallery</option>
                    </select>
                </div>
                <div class="sm:col-span-1">
                    <label class="form-label">Title (optional)</label>
                    <input type="text" name="title" class="form-input" placeholder="My Profile Photo">
                </div>
                <div class="sm:col-span-1">
                    <label class="form-label">Sort Order</label>
                    <input type="number" name="sort_order" value="0" class="form-input" min="0">
                </div>
            </div>

            <!-- Dropzone -->
            <div id="drop-zone"
                 class="border-2 border-dashed border-white/10 rounded-2xl p-8 text-center cursor-pointer hover:border-[#6c63ff]/50 transition-colors"
                 onclick="document.getElementById('file-input').click()">
                <div class="text-4xl mb-3">📸</div>
                <p class="text-sm font-medium text-gray-300 mb-1">Click or drag & drop images here</p>
                <p class="text-xs text-gray-500">JPG, PNG, WebP, GIF up to 4MB each. Multiple files allowed.</p>
                <div id="file-preview" class="mt-4 flex flex-wrap gap-2 justify-center"></div>
                <input type="file" id="file-input" name="photos[]" multiple accept="image/*" class="hidden">
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-admin-primary">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                    Upload Photos
                </button>
            </div>
        </form>
    </div>

    <!-- Photos Grid -->
    @php $grouped = $photos->groupBy('type'); @endphp
    @foreach(['profile' => '👤 Profile Photos', 'about' => '📄 About Section', 'gallery' => '🖼️ Gallery'] as $type => $label)
    @if(isset($grouped[$type]) && $grouped[$type]->count())
    <div>
        <h3 class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-3 px-1">{{ $label }}</h3>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-5 gap-4">
            @foreach($grouped[$type] as $photo)
            <div class="admin-card overflow-hidden group">
                <div class="aspect-square overflow-hidden bg-white/5 relative">
                    <img src="{{ $photo->url() }}" alt="{{ $photo->title }}"
                         class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                    <div class="absolute inset-0 bg-black/60 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                        <form method="POST" action="{{ route('admin.photos.destroy', $photo) }}">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn-admin-danger text-xs" data-confirm="Delete this photo?">
                                🗑 Delete
                            </button>
                        </form>
                    </div>
                </div>
                <div class="p-3">
                    <form method="POST" action="{{ route('admin.photos.update', $photo) }}" class="space-y-2">
                        @csrf @method('PUT')
                        <input type="text" name="title" value="{{ $photo->title }}" class="form-input text-xs py-1.5" placeholder="Title">
                        <select name="type" class="form-input text-xs py-1.5">
                            <option value="profile" {{ $photo->type === 'profile' ? 'selected' : '' }}>Profile</option>
                            <option value="about"   {{ $photo->type === 'about'   ? 'selected' : '' }}>About</option>
                            <option value="gallery" {{ $photo->type === 'gallery' ? 'selected' : '' }}>Gallery</option>
                        </select>
                        <div class="flex items-center justify-between">
                            <label class="flex items-center gap-1.5 text-xs text-gray-400 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" {{ $photo->is_active ? 'checked' : '' }} class="accent-[#6c63ff]">
                                Active
                            </label>
                            <button type="submit" class="text-xs text-[#6c63ff] hover:underline">Save</button>
                        </div>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @endforeach

    @if($photos->count() === 0)
    <div class="admin-card p-12 text-center text-gray-500">
        No photos uploaded yet.
    </div>
    @endif
</div>

<script>
const dropZone = document.getElementById('drop-zone');
const fileInput = document.getElementById('file-input');
const preview  = document.getElementById('file-preview');

fileInput.addEventListener('change', () => {
    preview.innerHTML = '';
    [...fileInput.files].forEach(file => {
        const reader = new FileReader();
        reader.onload = e => {
            const img = document.createElement('img');
            img.src = e.target.result;
            img.className = 'w-16 h-16 object-cover rounded-lg border border-white/10';
            preview.appendChild(img);
        };
        reader.readAsDataURL(file);
    });
});

['dragover', 'dragenter'].forEach(e => {
    dropZone.addEventListener(e, ev => { ev.preventDefault(); dropZone.style.borderColor = '#6c63ff'; });
});
dropZone.addEventListener('dragleave', () => { dropZone.style.borderColor = ''; });
dropZone.addEventListener('drop', ev => {
    ev.preventDefault();
    dropZone.style.borderColor = '';
    const dt = new DataTransfer();
    [...ev.dataTransfer.files].forEach(f => dt.items.add(f));
    fileInput.files = dt.files;
    fileInput.dispatchEvent(new Event('change'));
});
</script>
@endsection
