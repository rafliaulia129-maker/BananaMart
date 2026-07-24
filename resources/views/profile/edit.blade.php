@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10">
    @if (session('status') === 'profile-updated')
        <div class="mb-6 rounded-lg border border-green-300 bg-green-100 px-4 py-3 text-green-800">
            Profil berhasil diperbarui.
        </div>
    @endif

    <div class="bg-white shadow rounded-2xl p-6 mb-8">
        <h1 class="text-2xl font-bold mb-6 text-[#7D6608]">Profile Saya</h1>

        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('PATCH')

            <div class="mb-4">
                <label for="name" class="block mb-1 font-medium">Nama</label>
                <input
                    id="name"
                    type="text"
                    name="name"
                    value="{{ old('name', $user->name) }}"
                    class="w-full rounded-lg border px-4 py-2"
                    required
                >
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block mb-1 font-medium">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email', $user->email) }}"
                    class="w-full rounded-lg border px-4 py-2"
                    required
                >
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                class="rounded-lg bg-yellow-500 px-5 py-2 font-semibold text-white hover:bg-yellow-600"
            >
                Simpan Perubahan
            </button>
        </form>
    </div>

    <div class="bg-white shadow rounded-2xl p-6">
        <h2 class="mb-4 text-xl font-bold text-red-600">Hapus Akun</h2>

        <form method="POST" action="{{ route('profile.destroy') }}">
            @csrf
            @method('DELETE')

            <div class="mb-4">
                <label for="password" class="block mb-1 font-medium">Konfirmasi Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    class="w-full rounded-lg border px-4 py-2"
                    required
                >
                @error('password', 'userDeletion')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <button
                type="submit"
                onclick="return confirm('Yakin ingin menghapus akun?')"
                class="rounded-lg bg-red-500 px-5 py-2 font-semibold text-white hover:bg-red-600"
            >
                Hapus Akun
            </button>
        </form>
    </div>
</div>
@endsection