@extends('layouts.app')

@section('content')
    <x-slot:title>Request Account Deletion | mdbusiness</x-slot>

    <div class="container mx-auto px-6 py-16 max-w-2xl">
        <div class="bg-white p-10 rounded-[2.5rem] shadow-xl border border-gray-100 text-center">
            <div class="w-20 h-20 bg-red-50 text-red-500 rounded-full flex items-center justify-center mx-auto mb-6">
                <ion-icon name="person-remove-outline" class="text-4xl"></ion-icon>
            </div>

            <h1 class="text-3xl font-black text-[#145589] mb-4">Account Deletion</h1>
            <p class="text-gray-500 mb-8 text-sm">Please select your primary identification method to initiate the permanent
                removal of your account data.</p>

            <form action="{{ route('deletion.submit') }}" method="POST" class="space-y-6 text-left" x-data="{ method: 'email' }">
                @csrf
                <input type="hidden" name="subject" value="Account Deletion Request">

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3">Identify
                        Account By:</label>
                    <div class="flex p-1 bg-gray-100 rounded-2xl">
                        <button type="button" @click="method = 'email'"
                            :class="method === 'email' ? 'bg-white shadow-sm text-[#145589]' : 'text-gray-400'"
                            class="flex-1 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all focus:outline-none">
                            Registered Email
                        </button>
                        <button type="button" @click="method = 'phone'"
                            :class="method === 'phone' ? 'bg-white shadow-sm text-[#145589]' : 'text-gray-400'"
                            class="flex-1 py-3 rounded-xl text-[10px] font-black uppercase tracking-widest transition-all focus:outline-none">
                            Phone Number
                        </button>
                    </div>
                </div>

                <div x-show="method === 'email'" x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Email
                        Address</label>
                    <input type="email" name="email" :required="method === 'email'"
                        placeholder="yourname@company.com"
                        class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-red-500 outline-none transition-all placeholder:text-gray-300">
                </div>

                <div x-show="method === 'phone'" x-cloak x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 transform -translate-y-2">
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Phone
                        Number</label>
                    <input type="tel" name="phone" :required="method === 'phone'" placeholder="+91 00000 00000"
                        class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-red-500 outline-none transition-all placeholder:text-gray-300">
                </div>

                <div>
                    <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Primary Reason
                        for Leaving</label>
                    <select name="reason" required
                        class="w-full p-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-2 focus:ring-red-500 outline-none text-sm font-medium text-gray-700">
                        <option value="" disabled selected>Select a reason</option>
                        <option value="privacy">Privacy & Security Concerns</option>
                        <option value="no_longer_needed">No longer using the service</option>
                        <option value="technical_issues">Frequent technical issues</option>
                        <option value="other">Other</option>
                    </select>
                </div>

                <div
                    class="flex items-start gap-3 p-5 bg-red-50 rounded-[1.5rem] text-red-800 text-[11px] leading-relaxed border border-red-100/50">
                    <ion-icon name="alert-circle" class="text-xl shrink-0"></ion-icon>
                    <p>
                        <strong>Warning:</strong> Account deletion is permanent. All your business records, settings, and
                        cloud data will be purged within **30 days**. This action cannot be undone.
                    </p>
                </div>

                <button type="submit"
                    class="w-full py-4 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-widest text-[11px] rounded-2xl transition-all shadow-lg shadow-red-200/50">
                    Submit Permanent Deletion Request
                </button>
            </form>
        </div>
    </div>
@endsection
