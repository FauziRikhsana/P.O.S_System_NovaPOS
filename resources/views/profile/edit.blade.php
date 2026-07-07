@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <div class="bg-white rounded-xl shadow p-6">
        <h1 class="text-2xl font-bold text-gray-800">Profil</h1>
        <p class="text-sm text-gray-500 mt-2">Kelola informasi akun Anda sebagai admin atau kasir.</p>
    </div>

    <div class="grid gap-6 lg:grid-cols-[1fr_420px]">
        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow p-6">
                @include('profile.partials.update-profile-information-form')
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-xl shadow p-6">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
