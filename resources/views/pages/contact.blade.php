@extends('layouts.app')

@section('content')
    <x-slot:title>Contact Our Architects | mdbusiness</x-slot>

    <section class="relative bg-[#145589] py-24 md:py-32 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-[#145589] via-[#145589] to-[#7f03d3] opacity-95"></div>
        <div class="container mx-auto px-6 relative z-10 text-left">
            <span
                class="inline-block px-4 py-1 rounded-full bg-white/10 border border-white/20 text-white text-xs font-bold uppercase tracking-[0.3em] mb-6 animate-fade-in">
                Let's Build the Future
            </span>
            <h1 class="text-5xl md:text-7xl font-black text-white mb-6 tracking-tighter">Get In <span
                    class="text-[#fd7319]">Touch.</span></h1>
            <p class="text-blue-100 text-lg md:text-xl max-w-2xl font-medium leading-relaxed">
                Have a complex "Samsya"? Tell us about your vision, and our engineering team will help you architect a
                scalable solution.
            </p>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <div class="grid lg:grid-cols-3 gap-16">

                <div class="space-y-8 text-left">
                    <div
                        class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 transition-all hover:shadow-xl group">
                        <div
                            class="w-14 h-14 bg-[#145589]/5 rounded-2xl flex items-center justify-center text-[#145589] mb-6 group-hover:bg-[#145589] group-hover:text-white transition-all">
                            <ion-icon name="mail-outline" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-xl font-black text-[#145589] mb-2 uppercase tracking-tighter">Email Us</h3>
                        <p class="text-gray-500 text-sm mb-4 font-medium leading-relaxed">Technical & general inquiries.</p>
                        <a href="mailto:info@mdbusiness.com"
                            class="text-[#7f03d3] font-black text-lg hover:underline">info@mdbusiness.com</a>
                    </div>

                    <div
                        class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 transition-all hover:shadow-xl group">
                        <div
                            class="w-14 h-14 bg-green-50 rounded-2xl flex items-center justify-center text-green-600 mb-6 group-hover:bg-green-600 group-hover:text-white transition-all">
                            <ion-icon name="logo-whatsapp" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-xl font-black text-[#145589] mb-2 uppercase tracking-tighter">Direct Chat</h3>
                        <p class="text-gray-500 text-sm mb-4 font-medium leading-relaxed">Fastest response for project
                            quotes.</p>
                        <a href="https://wa.me/910000000000" class="text-green-600 font-black text-lg hover:underline">+91
                            859 107 2162 </a>
                    </div>

                    <div
                        class="bg-white p-10 rounded-[2.5rem] shadow-sm border border-gray-100 transition-all hover:shadow-xl group">
                        <div
                            class="w-14 h-14 bg-[#fd7319]/5 rounded-2xl flex items-center justify-center text-[#fd7319] mb-6 group-hover:bg-[#fd7319] group-hover:text-white transition-all">
                            <ion-icon name="location-outline" class="text-3xl"></ion-icon>
                        </div>
                        <h3 class="text-xl font-black text-[#145589] mb-2 uppercase tracking-tighter">Visit Us</h3>
                        <p class="text-gray-600 font-medium leading-relaxed">Deoria, Uttar Pradesh, <br>India</p>
                    </div>
                </div>

                <div
                    class="lg:col-span-2 bg-white p-10 md:p-16 rounded-[3rem] shadow-2xl border border-gray-50 relative overflow-hidden">
                    <div class="absolute -top-10 -right-10 w-40 h-40 bg-[#7f03d3]/5 rounded-full blur-3xl"></div>

                    <h2 class="text-4xl font-black text-[#145589] mb-10 tracking-tighter text-left">Send a Message</h2>

                    <form action="#" id="contactForm" class="space-y-8 text-left">
                        @csrf
                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Full
                                    Name</label>
                                <input type="text" name="name" required
                                    class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] outline-none transition-all shadow-sm"
                                    placeholder="John Doe">
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Email
                                    Address</label>
                                <input type="email" name="email" required
                                    class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] outline-none transition-all shadow-sm"
                                    placeholder="john@mdbusiness.com">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-8">
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Service
                                    Required</label>
                                <div class="relative">
                                    <select name="service"
                                        class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] outline-none appearance-none cursor-pointer font-bold text-gray-700">
                                        <option>Flutter App Development</option>
                                        <option>Laravel Web Development</option>
                                        <option>AI & Automation</option>
                                        <option>PropTech Solutions</option>
                                        <option>Digital Marketing</option>
                                    </select>
                                    <ion-icon name="chevron-down-outline"
                                        class="absolute right-5 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></ion-icon>
                                </div>
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Project
                                    Budget (Est.)</label>
                                <select name="budget"
                                    class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] outline-none appearance-none cursor-pointer font-bold text-gray-700">
                                    <option>₹ 15,000 - ₹ 50,000</option>
                                    <option>₹ 50,000 - ₹ 150,000</option>
                                    <option>₹ 150,000 - ₹ 500,000</option>
                                    <option>₹ 500,000+</option>
                                </select>
                            </div>
                        </div>

                        <div>
                            <label
                                class="block text-xs font-black uppercase tracking-widest text-gray-500 mb-3 ml-1">Project
                                Brief</label>
                            <textarea name="message" rows="5" required
                                class="w-full px-5 py-4 rounded-2xl border border-gray-100 bg-gray-50 focus:bg-white focus:ring-2 focus:ring-[#7f03d3] outline-none transition-all shadow-sm"
                                placeholder="Describe your technical challenge..."></textarea>
                        </div>

                        <button type="submit"
                            class="group relative flex items-center justify-center gap-3 w-full md:w-max px-14 py-5 bg-[#fd7319] text-white font-black uppercase tracking-widest text-[10px] rounded-2xl hover:bg-[#145589] shadow-xl shadow-orange-200 transition-all transform active:scale-95">
                            <span>Initialize Transformation</span>
                            <ion-icon name="send-outline"
                                class="text-lg group-hover:translate-x-1 group-hover:-translate-y-1 transition-transform"></ion-icon>
                        </button>
                    </form>

                    <div id="formSuccess"
                        class="hidden mt-8 p-10 bg-green-50 text-center rounded-[2rem] border border-green-100">
                        <ion-icon name="checkmark-done-circle" class="text-6xl text-green-500 mb-4"></ion-icon>
                        <h4 class="text-xl font-black text-green-800 tracking-tighter">Transmission Successful!</h4>
                        <p class="text-green-600 mt-2 font-medium">Our architects will review your brief and contact you
                            within 24 hours.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <section class="h-[500px] w-full grayscale hover:grayscale-0 transition-all duration-1000 border-t border-gray-100">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d114624.123456789!2d83.778!3d26.5!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMjbCsDMwJzAwLjAiTiA4M8KwNDYnNDguMCJF!5e0!3m2!1sen!2sin!4v1700000000000!5m2!1sen!2sin"
            width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
    </section>

    @push('script')
        <script>
            $(document).ready(function() {
                $('#contactForm').on('submit', function(e) {
                    e.preventDefault();
                    const form = $(this);
                    const btn = form.find('button');

                    btn.prop('disabled', true).html(
                        '<ion-icon name="sync" class="animate-spin text-xl"></ion-icon> <span>Syncing Data...</span>'
                    );

                    $.ajax({
                        url: "{{ route('contact.submit') }}",
                        method: "POST",
                        data: form.serialize(),
                        success: function(response) {
                            form.fadeOut(400, function() {
                                $('#formSuccess').removeClass('hidden').fadeIn();
                            });
                        },
                        error: function(xhr) {
                            alert("Sync Error: " + xhr.responseJSON.message);
                            btn.prop('disabled', false).html(
                                '<span>Initialize Transformation</span> <ion-icon name="send-outline" class="text-lg"></ion-icon>'
                            );
                        }
                    });
                });
            });
        </script>
    @endpush
@endsection
