@extends('layout.app')
@section('content')

<div class="d-flex justify-content-center align-items-center min-vh-50 mt-5">
    <div class="card w-50 ">
        <div class="card-body">
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label">{{ __('Email') }}</label>
                    <input id="email" class="form-control" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="form-label">{{ __('Password') }}</label>
                    <input id="password" class="form-control" type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                        <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <!-- Log in -->
                <x-primary-button class="btn btn-primary " style="width: 100%">
                    {{ __('Log in') }}
                </x-primary-button>

                {{-- <div class="flex items-center justify-end mt-4">
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif --}}

                   
                  {{-- <div class="row">
                    <div class="col-lg-3">
                        <a href="{{route('register')}}" class="text-white" style="text-decoration: none; width: 100%;"> 
                            <x-primary-button class="ml-2 btn btn-primary mr-2">
                          {{ __('Sign Up') }}</a>  
                        </x-primary-button>
                    </div>
                  </div>  --}}

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
