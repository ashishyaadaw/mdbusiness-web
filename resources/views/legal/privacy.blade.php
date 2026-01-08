@extends('layouts.app')

@section('title', 'Privacy Policy - MD Matrimony')

@section('content')
<div class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">

            <div class="bg-brand-red px-8 py-10 text-white text-center">
                <h1 class="font-serif text-4xl font-bold">Privacy Policy</h1>
                <p class="mt-2 text-brand-light opacity-90 italic">Protecting your trust and personal data</p>
                <p class="text-xs mt-2 uppercase tracking-widest">Last Updated: December 25, 2025</p>
            </div>

            <div class="p-8 md:p-12 prose prose-red max-w-none text-gray-700 space-y-8">

                <section>
                    <p class="leading-relaxed">
                        <strong>MD Matrimony Services</strong> ("MDM", "we", "us") is committed to protecting your
                        privacy. This Privacy Policy explains how we collect, use, and share personal information from
                        users of our website and mobile application.
                    </p>
                </section>

                <hr class="border-gray-100">

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">1.
                        Information We Collect</h2>
                    <p>To provide our matrimonial services, we collect information that can identify you ("Personal
                        Information"):</p>
                    <ul class="list-disc pl-5 space-y-2 mt-4">
                        <li><strong>Profile Data:</strong> Name, gender, date of birth, religion, caste/sub-caste,
                            mother tongue, photos, and marital status.</li>
                        <li><strong>Contact Data:</strong> Email address, phone number, and mailing address.</li>
                        <li><strong>Sensitive Data:</strong> Health information (optional), physical disabilities, and
                            income details.</li>
                        <li><strong>App Usage Data:</strong> IP address, device ID, browser type, and location data (if
                            GPS is enabled).</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">2.
                        How We Use Your Information</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>To create and manage your account and display your profile to prospective matches.</li>
                        <li>To communicate with you via SMS, WhatsApp, Email, and Calls.</li>
                        <li>To provide relevant match recommendations based on your preferences.</li>
                        <li>To prevent fraud, duplicate profiles, and ensure platform safety.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">3.
                        Information Sharing</h2>
                    <p>We do not sell your personal data. However, we share information as follows:</p>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>With Other Members:</strong> Your profile details (excluding contact info, depending
                            on your settings) are visible to other registered members.</li>
                        <li><strong>Legal Requirements:</strong> We may disclose data if required by law or to protect
                            the safety of our users.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">4.
                        Data Security</h2>
                    <p>We implement industry-standard security measures to protect your data. However, no method of
                        transmission over the internet or mobile device is 100% secure. You are responsible for keeping
                        your <strong>OTP and Password</strong> confidential.</p>
                </section>

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">5.
                        Your Rights & Control</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li><strong>Editing Profile:</strong> You can update your information at any time through the
                            "Edit Profile" section.</li>
                        <li><strong>Account Deletion:</strong> You may request to delete your account. Once deleted,
                            your data will be archived for legal compliance for a limited period before being purged.
                        </li>
                        <li><strong>Privacy Settings:</strong> You can control who sees your photos and contact details
                            via the app settings.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="font-serif text-2xl font-bold text-brand-dark border-b-2 border-brand-gold pb-2 mb-4">6.
                        Cookies and Tracking</h2>
                    <p>We use cookies to enhance your experience, remember your login, and analyze web traffic. You can
                        disable cookies in your browser settings, but some features of MDM may not function properly.
                    </p>
                </section>

                <section class="bg-brand-light p-6 rounded-lg border border-red-100">
                    <h2 class="font-serif text-2xl font-bold text-brand-red mb-4">7. Contact our Privacy Team</h2>
                    <p class="mb-2">For any questions regarding your data or this policy:</p>
                    <ul class="space-y-1">
                        <li><strong>Grievance Officer:</strong> RAM ASHISH YADAV</li>
                        <li><strong>Email:</strong> grievance@mdmatrimony.com</li>
                        <li><strong>Address:</strong> Office No 7, Chaturvedi Complex, Betiyahata Road, Gorakhpur -
                            273001</li>
                    </ul>
                </section>

                <div
                    class="mt-10 pt-6 border-t border-gray-200 text-center text-xs text-gray-400 uppercase tracking-widest">
                    This Privacy Policy is compliant with the IT Act, 2000 and the Digital Personal Data Protection
                    (DPDP) Act, 2023.
                </div>
            </div>
        </div>
    </div>
</div>
@endsection