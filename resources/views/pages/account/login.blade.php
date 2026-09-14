@extends('layouts.app', ['title' => 'Log In', 'isSearchBar' => false])

@section('content')
    <div class="py-10 max-w-sm mx-auto">
        @if ($phone)
            <h1 class="text-xl font-bold text-gray-900 mb-1">Enter the OTP</h1>
            <p class="text-sm text-gray-500 mb-6">
                We sent a code to <strong>{{ $phone }}</strong>.
                <a href="{{ route('account.login', ['reset' => 1]) }}" class="text-blue-600 hover:underline">Change number</a>
            </p>

            @include('pages.account.partials.flash')

            <form method="POST" action="{{ route('account.login.verify') }}" class="space-y-4">
                @csrf
                <input type="hidden" name="phone" value="{{ $phone }}">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">OTP</label>
                    <input type="text" name="otp" inputmode="numeric" pattern="[0-9]*" maxlength="6" required autofocus
                           class="w-full rounded-lg border-gray-300 focus:border-[#fd7319] focus:ring-[#fd7319] border px-3 py-2 tracking-widest text-lg">
                </div>
                <button type="submit"
                        class="w-full bg-[#fd7319] hover:bg-[#ff8533] text-white font-semibold py-2.5 rounded-lg">
                    Verify & Continue
                </button>
            </form>

            <form method="POST" action="{{ route('account.login.otp') }}" class="mt-4">
                @csrf
                <input type="hidden" name="phone" value="{{ $phone }}">
                <button type="submit" class="text-sm text-blue-600 hover:underline">Resend OTP</button>
            </form>
        @else
            <h1 class="text-xl font-bold text-gray-900 mb-1">Welcome</h1>
            <p class="text-sm text-gray-500 mb-6">Log in or create an account with your phone number — no password needed.</p>

            @include('pages.account.partials.flash')

            <form method="POST" action="{{ route('account.login.otp') }}" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name <span class="text-gray-400">(new accounts only)</span></label>
                    <input type="text" name="full_name" value="{{ old('full_name') }}"
                           class="w-full rounded-lg border-gray-300 focus:border-[#fd7319] focus:ring-[#fd7319] border px-3 py-2">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone</label>
                    <input type="text" name="phone" value="{{ old('phone') }}" required autofocus
                           class="w-full rounded-lg border-gray-300 focus:border-[#fd7319] focus:ring-[#fd7319] border px-3 py-2">
                </div>
                <button type="submit"
                        class="w-full bg-[#fd7319] hover:bg-[#ff8533] text-white font-semibold py-2.5 rounded-lg">
                    Send OTP
                </button>
            </form>
        @endif
    </div>
@endsection
