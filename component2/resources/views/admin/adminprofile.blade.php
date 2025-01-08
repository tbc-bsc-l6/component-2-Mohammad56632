@extends('admin.dashboard')
@section('content')
<div class="container">
    <!-- Profile Information Section -->
    <section>
        <header class="mb-4">
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Profile Information') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __("Update your account's profile information and email address.") }}
            </p>
        </header>

        <form id="send-verification" method="post" action="{{ route('verification.send') }}">
            @csrf
        </form>

<!-- Success Message -->
@if (session('status') === 'profile-updated')
    <div class="alert alert-success" role="alert">
        {{ __('Profile updated successfully!') }}
    </div>
@endif

<!-- Error Messages (validation errors) -->
@foreach ($errors->all() as $error)
    <div class="alert alert-danger" role="alert">
        {{ $error }}
    </div>
@endforeach

<form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('patch')

    <div class="mb-3">
        <label for="name" class="form-label">{{ __('Name') }}</label>
        <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
        @error('name')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">{{ __('Email') }}</label>
        <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username" />
        @error('email')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Phone field -->
    <div class="mb-3">
        <label for="phone" class="form-label">{{ __('Phone') }}</label>
        <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}" />
        @error('phone')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Profile Picture field -->
    <div class="mb-3">
        <label for="profile" class="form-label">{{ __('Profile Picture') }}</label>
        <input type="file" id="profile" name="profile" class="form-control" />
        @error('profile')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Gender field -->
    <div class="mb-3">
        <label for="gender" class="form-label">{{ __('Gender') }}</label>
        <select id="gender" name="gender" class="form-control">
            <option value="male" {{ old('gender', $user->gender) == 'male' ? 'selected' : '' }}>{{ __('Male') }}</option>
            <option value="female" {{ old('gender', $user->gender) == 'female' ? 'selected' : '' }}>{{ __('Female') }}</option>
            <option value="other" {{ old('gender', $user->gender) == 'other' ? 'selected' : '' }}>{{ __('Other') }}</option>
        </select>
        @error('gender')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Date of Birth field -->
    <div class="mb-3">
        <label for="dob" class="form-label">{{ __('Date of Birth') }}</label>
        <input type="date" id="dob" name="dob" class="form-control" value="{{ old('dob', $user->dob) }}" />
        @error('dob')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <!-- Role field -->
    <div class="mb-3">
        <label for="role" class="form-label">{{ __('Role') }}</label>
        <select id="role" name="role" class="form-control" {{ Auth::user()->role != 2 ? 'disabled' : '' }}>
            <option value="1" {{ old('role', $user->role) == 1 ? 'selected' : '' }}>{{ __('User') }}</option>
            <option value="2" {{ old('role', $user->role) == 2 ? 'selected' : '' }}>{{ __('Admin') }}</option>
        </select>
        @error('role')
            <div class="text-danger mt-2">{{ $message }}</div>
        @enderror
    </div>

    <div class="d-flex justify-content-start gap-4">
        <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
    </div>
</form>

    </section>

    

    <!-- Delete Account Section -->
    <section class="space-y-6 mt-5">
        <header>
            <h2 class="text-lg font-medium text-gray-900">
                {{ __('Delete Account') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600">
                {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
            </p>
        </header>

        <button
            class="btn btn-danger"
            x-data=""
            x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        >
            {{ __('Delete Account') }}
        </button>

        <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
            <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
                @csrf
                @method('delete')

                <h2 class="text-lg font-medium text-gray-900">
                    {{ __('Are you sure you want to delete your account?') }}
                </h2>

                <p class="mt-1 text-sm text-gray-600">
                    {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm you would like to permanently delete your account.') }}
                </p>

                <div class="mt-6">
                    <label for="password" class="form-label sr-only">{{ __('Password') }}</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('Password') }}" />
                    @error('password')
                        <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mt-6 d-flex justify-content-end">
                    <x-secondary-button x-on:click="$dispatch('close')">
                        {{ __('Cancel') }}
                    </x-secondary-button>

                    <button type="submit" class="btn btn-danger ms-3">
                        {{ __('Delete Account') }}
                    </button>
                </div>
            </form>
        </x-modal>
    </section>
</div>
@endsection
