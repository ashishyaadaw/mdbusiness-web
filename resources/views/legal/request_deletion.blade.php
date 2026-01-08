@extends('layouts.app')

@section('title', 'Delete Account - MD Matrimony')

@section('content')
<div class="py-16">
    <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            
            <div class="bg-brand-red px-8 py-10 text-white text-center">
                <h1 class="font-serif text-3xl font-bold">Account Deletion</h1>
                <p class="mt-2 text-brand-light opacity-90">Verify your mobile number to proceed</p>
            </div>

            <div class="p-8 md:p-12">
                <div class="mb-8 p-4 bg-red-50 rounded-xl border border-red-100 flex items-start">
                    <svg class="h-6 w-6 text-brand-red mt-0.5 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                    <div>
                        <h4 class="text-brand-red font-bold text-sm">Permanent Action</h4>
                        <p class="text-xs text-gray-600 mt-1">
                            As per the DPDP Act 2023, your data will be archived for legal compliance before being purged. You cannot undo this action.
                        </p>
                    </div>
                </div>

                <form action="" method="POST" id="deletion-form">
                    @csrf
                    
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Reason for leaving</label>
                            <select name="reason" class="w-full p-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none transition-all">
                                <option value="found_match">I found my soulmate on MD Matrimony</option>
                                <option value="privacy">I am concerned about my privacy</option>
                                <option value="technical">App is difficult to use</option>
                                <option value="other">Other reasons</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Registered Mobile Number</label>
                            <div class="relative">
                                <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-500 font-bold">+91</span>
                                <input type="tel" name="mobile" value=""  
                                    class="w-full pl-12 p-3 bg-gray-100 border border-gray-200 rounded-lg text-gray-600 cursor-not-allowed">
                            </div>
                        </div>

                        <div id="otp-container">
                            <div class="flex justify-between items-center mb-2">
                                <label class="block text-sm font-semibold text-gray-700">Enter 6-Digit OTP</label>
                                <button type="button" onclick="sendOTP()" class="text-xs font-bold text-brand-red hover:underline">
                                    Send/Resend OTP
                                </button>
                            </div>
                            <input type="text" name="otp" maxlength="6" placeholder="· · · · · ·" 
                                class="w-full p-4 text-center text-2xl tracking-[1em] font-mono border border-gray-200 rounded-lg focus:ring-2 focus:ring-brand-red outline-none">
                            <p id="otp-status" class="mt-2 text-xs text-center text-gray-500 italic"></p>
                        </div>

                        <div class="pt-6">
                            <button type="submit" class="w-full bg-brand-red hover:bg-red-700 text-white font-bold py-4 rounded-xl shadow-lg transition duration-300 transform hover:-translate-y-1">
                                Confirm & Delete Account
                            </button>
                            <a href="{{ route('dashboard') }}" class="block text-center mt-4 text-sm font-medium text-gray-500 hover:text-gray-700">
                                I've changed my mind, keep my account
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function sendOTP() {
        const status = document.getElementById('otp-status');
        status.innerText = "Sending OTP to your mobile...";
        status.classList.remove('text-red-500');
        
        // Mocking an AJAX call to your OTP route
        fetch("", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            status.innerText = "OTP sent successfully!";
            status.classList.add('text-green-600');
        })
        .catch(error => {
            status.innerText = "Failed to send OTP. Please try again.";
            status.classList.add('text-red-500');
        });
    }
</script>
@endsection