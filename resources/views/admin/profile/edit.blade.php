@extends('layouts.admin')
@section('title', 'Edit Profile')
@section('page-title', 'Your Profile')
@section('page-subtitle', 'This information is displayed on the public portfolio.')

@section('content')
<div class="py-4">
    <form method="POST" action="{{ route('admin.profile.update') }}" enctype="multipart/form-data">
        @csrf

        <div class="grid lg:grid-cols-3 gap-6">

            <!-- Avatar Column -->
            <div class="space-y-4">
                <div class="admin-card p-6 text-center">
                    <h3 class="font-display text-sm font-semibold text-white mb-4">Profile Photo</h3>
                    <div class="w-32 h-32 mx-auto rounded-2xl overflow-hidden mb-4 relative group cursor-pointer"
                         style="background: linear-gradient(135deg, #6c63ff, #ff6584);"
                         onclick="document.getElementById('avatar-input').click()">
                        @if($profile->avatar)
                        <img src="{{ $profile->avatarUrl() }}" alt="Avatar" class="w-full h-full object-cover">
                        @else
                        <div class="w-full h-full flex items-center justify-center text-white font-display font-bold text-4xl">
                            {{ strtoupper(substr($profile->name ?? 'A', 0, 2)) }}
                        </div>
                        @endif
                        <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-xs text-white font-medium">
                            Change Photo
                        </div>
                    </div>
                    <input type="file" id="avatar-input" name="avatar" accept="image/*" class="hidden"
                           onchange="previewAvatar(this)">
                    <p class="text-xs text-gray-500">JPG, PNG, WebP up to 2MB</p>
                </div>

                <div class="admin-card p-6">
                    <h3 class="font-display text-sm font-semibold text-white mb-4">CV / Resume</h3>
                    @if($profile->cv_file)
                    <div class="flex items-center gap-2 p-3 rounded-xl mb-3" style="background: rgba(52,211,153,0.1); border: 1px solid rgba(52,211,153,0.2);">
                        <span class="text-green-400 text-lg">📄</span>
                        <span class="text-xs text-green-400 font-medium">CV uploaded</span>
                        <a href="{{ asset('storage/'.$profile->cv_file) }}" target="_blank" class="text-xs text-[#6c63ff] ml-auto hover:underline">View</a>
                    </div>
                    @endif
                    <input type="file" name="cv_file" accept=".pdf" class="form-input text-xs py-2 cursor-pointer">
                    <p class="text-xs text-gray-500 mt-1">PDF only, max 5MB</p>
                </div>

                <div class="admin-card p-6">
                    <h3 class="font-display text-sm font-semibold text-white mb-3">Availability</h3>
                    <label class="flex items-center gap-3 cursor-pointer">
                        <div class="relative">
                            <input type="checkbox" name="is_available" value="1" {{ $profile->is_available ? 'checked' : '' }}
                                   id="available-toggle" class="sr-only">
                            <div id="toggle-bg" class="w-11 h-6 rounded-full transition-colors duration-200 {{ $profile->is_available ? 'bg-green-500' : 'bg-gray-600' }}"></div>
                            <div id="toggle-dot" class="absolute top-0.5 left-0.5 w-5 h-5 bg-white rounded-full shadow transition-transform duration-200 {{ $profile->is_available ? 'translate-x-5' : '' }}"></div>
                        </div>
                        <span class="text-sm text-gray-300">Available for work</span>
                    </label>
                </div>
            </div>

            <!-- Main Form -->
            <div class="lg:col-span-2 space-y-4">
                <div class="admin-card p-6 space-y-5">
                    <h3 class="font-display text-sm font-semibold text-white flex items-center gap-2">
                        <span class="w-1.5 h-4 rounded-full inline-block" style="background: #6c63ff;"></span>
                        Basic Info
                    </h3>

                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Full Name *</label>
                            <input type="text" name="name" value="{{ old('name', $profile->name) }}" required class="form-input" placeholder="Anup Devkota">
                        </div>
                        <div>
                            <label class="form-label">Tagline</label>
                            <input type="text" name="tagline" value="{{ old('tagline', $profile->tagline) }}" class="form-input" placeholder="Full Stack Developer">
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Short Bio (hero section)</label>
                        <textarea name="bio_short" rows="2" class="form-input" placeholder="One-liner about yourself...">{{ old('bio_short', $profile->bio_short) }}</textarea>
                    </div>

                    <div>
                        <label class="form-label">Full Bio (about section)</label>
                        <textarea name="bio_long" rows="4" class="form-input" placeholder="Detailed description for the about section...">{{ old('bio_long', $profile->bio_long) }}</textarea>
                    </div>
                </div>

                <div class="admin-card p-6 space-y-5">
                    <h3 class="font-display text-sm font-semibold text-white flex items-center gap-2">
                        <span class="w-1.5 h-4 rounded-full inline-block" style="background: #ff6584;"></span>
                        Contact Details
                    </h3>
                    <div class="grid sm:grid-cols-2 gap-5">
                        <div>
                            <label class="form-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $profile->email) }}" class="form-input" placeholder="anup@devkota.dev">
                        </div>
                        <div>
                            <label class="form-label">Phone</label>
                            <input type="text" name="phone" value="{{ old('phone', $profile->phone) }}" class="form-input" placeholder="+977 98...">
                        </div>
                        <div>
                            <label class="form-label">Location</label>
                            <input type="text" name="location" value="{{ old('location', $profile->location) }}" class="form-input" placeholder="Kathmandu, Nepal">
                        </div>
                        <div>
                            <label class="form-label">Age</label>
                            <input type="text" name="age" value="{{ old('age', $profile->age) }}" class="form-input" placeholder="24">
                        </div>
                        <div>
                            <label class="form-label">Degree</label>
                            <input type="text" name="degree" value="{{ old('degree', $profile->degree) }}" class="form-input" placeholder="B.Sc. CS">
                        </div>
                    </div>
                </div>

                <div class="admin-card p-6 space-y-5">
                    <h3 class="font-display text-sm font-semibold text-white flex items-center gap-2">
                        <span class="w-1.5 h-4 rounded-full inline-block" style="background: #34d399;"></span>
                        Social Links
                    </h3>
                    <div class="space-y-4">
                        <div>
                            <label class="form-label">GitHub URL</label>
                            <input type="url" name="github_url" value="{{ old('github_url', $profile->github_url) }}" class="form-input" placeholder="https://github.com/...">
                        </div>
                        <div>
                            <label class="form-label">LinkedIn URL</label>
                            <input type="url" name="linkedin_url" value="{{ old('linkedin_url', $profile->linkedin_url) }}" class="form-input" placeholder="https://linkedin.com/in/...">
                        </div>
                        <div>
                            <label class="form-label">Twitter / X URL</label>
                            <input type="url" name="twitter_url" value="{{ old('twitter_url', $profile->twitter_url) }}" class="form-input" placeholder="https://x.com/...">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-3">
                    <button type="submit" class="btn-admin-primary">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                        Save Profile
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
function previewAvatar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const container = input.closest('.admin-card').querySelector('[style*="linear-gradient"]');
            container.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover rounded-2xl">
                <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-xs text-white font-medium rounded-2xl">Change Photo</div>`;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// Toggle switch
const toggle = document.getElementById('available-toggle');
const bg = document.getElementById('toggle-bg');
const dot = document.getElementById('toggle-dot');
toggle.addEventListener('change', () => {
    if (toggle.checked) {
        bg.className = bg.className.replace('bg-gray-600', 'bg-green-500');
        dot.classList.add('translate-x-5');
    } else {
        bg.className = bg.className.replace('bg-green-500', 'bg-gray-600');
        dot.classList.remove('translate-x-5');
    }
});
</script>
@endsection
