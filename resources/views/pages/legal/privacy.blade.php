@extends('layouts.app')

@section('content')
    <x-slot:title>Privacy Policy | mdbusiness</x-slot>

    <section class="bg-[#145589] py-16 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#145589] to-[#7f03d3] opacity-90"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-4">Privacy Policy</h1>
            <p class="text-blue-100 font-medium">Commitment to Data Sovereignty & User Trust</p>
        </div>
    </section>

    <div class="container mx-auto px-6 py-16 max-w-4xl">
        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-[0_20px_50px_rgba(20,85,137,0.05)] border border-gray-100">
            <div class="flex justify-between items-center mb-10 border-b border-gray-100 pb-6">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#7f03d3]">Compliance Status:
                    Active</span>
                <p class="text-sm text-gray-400 font-bold">Last Updated: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-slate max-w-none text-gray-600 space-y-10 leading-relaxed">

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">1. Introduction</h2>
                    <p>mdbusiness, a digital service division of <strong>One Advertisers</strong> ("we," "us," or "our"), is
                        committed to protecting the privacy of our clients and users. This policy outlines our protocols for
                        collecting, processing, and safeguarding your personal data in accordance with the
                        <strong>Information Technology Act, 2000</strong> and the <strong>Digital Personal Data Protection
                            (DPDP) Act, 2023</strong> of India.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">2. Information Collection & Consent</h2>
                    <p>We collect data specifically required to solve your technical "Samsyas." By using our services or
                        submitting a request, you provide explicit consent for the collection of:</p>
                    <ul class="list-disc ml-6 space-y-2 mt-4">
                        <li><strong>Personal Identifiers:</strong> Name, Business Email, and Mobile Number.</li>
                        <li><strong>Project Metadata:</strong> Service interests, technical requirements, and business
                            briefs.</li>
                        <li><strong>Technical Data:</strong> IP addresses, browser types, and cookies via Google Analytics
                            for service optimization.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">3. Data Processing & Usage</h2>
                    <p>In compliance with the <em>Purpose Limitation</em> principle of Indian law, your data is used only
                        for:</p>
                    <ul class="list-disc ml-6 space-y-2 mt-4">
                        <li>Execution of Software Development & Digital Marketing contracts.</li>
                        <li>Technical support and "Call Back" request fulfillment.</li>
                        <li>Legal compliance and protection against unauthorized access.</li>
                        <li>Occasional delivery of technical guides or pricing estimates (only with your subscription).</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">4. Security & Protection</h2>
                    <p>We implement "Privacy by Design." Your data is stored on secured cloud servers with 256-bit
                        encryption. While we utilize industry-leading security protocols to protect your business
                        information, we adhere to the <strong>IT Rules, 2011</strong> for reporting any data security
                        breaches to the relevant authorities.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">5. Your Rights (The Data Principal)</h2>
                    <p>Under the DPDP Act 2023, you have the following rights:</p>
                    <div class="grid md:grid-cols-2 gap-4 mt-6">
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="font-bold text-[#145589] mb-1">Right to Access</p>
                            <p class="text-xs">Request a summary of the personal data we process.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="font-bold text-[#145589] mb-1">Right to Erasure</p>
                            <p class="text-xs">Request deletion of data once the project/purpose is fulfilled.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="font-bold text-[#145589] mb-1">Right to Correction</p>
                            <p class="text-xs">Update or rectify inaccurate personal information.</p>
                        </div>
                        <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                            <p class="font-bold text-[#145589] mb-1">Grievance Redressal</p>
                            <p class="text-xs">Access to a Data Protection Officer for any privacy concerns.</p>
                        </div>
                    </div>
                </section>
                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">6. Children's Privacy & COPPA Compliance</h2>
                    <p>
                        As our platform provides services accessible to users under the age of 13, we adhere to the
                        <strong>Children’s Online Privacy Protection Rule (COPPA)</strong> and the
                        <strong>DPDP Act’s provisions regarding minors.</strong> We are committed to providing a safe and
                        secure environment for all young "Samsya" solvers.
                    </p>

                    <div class="space-y-6 mt-6">
                        <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                            <h3 class="font-bold text-[#145589] mb-2 flex items-center gap-2">
                                <ion-icon name="shield-checkmark-outline"></ion-icon> Verifiable Parental Consent
                            </h3>
                            <p class="text-sm">
                                We do not knowingly collect personal information from children under 13 without obtaining
                                <strong>Verifiable Parental Consent</strong>. For certain features, we may require a
                                parent’s
                                email address to provide notice and obtain consent before collecting any PII from a minor.
                            </p>
                        </div>

                        <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                            <h3 class="font-bold text-[#145589] mb-2 flex items-center gap-2">
                                <ion-icon name="eye-off-outline"></ion-icon> Limited Data Collection
                            </h3>
                            <p class="text-sm">
                                For users under 13, we strictly limit data collection to <strong>only what is
                                    necessary</strong>
                                to participate in the activity. We do not use behavioral advertising or tracking for
                                children.
                                Any data collected is used solely for internal app functionality and service improvement.
                            </p>
                        </div>

                        <div class="p-6 bg-blue-50 rounded-2xl border border-blue-100">
                            <h3 class="font-bold text-[#145589] mb-2 flex items-center gap-2">
                                <ion-icon name="person-outline"></ion-icon> Parental Rights
                            </h3>
                            <p class="text-sm">
                                Parents have the right to review their child's personal information, direct us to delete it,
                                and refuse to allow further collection or use of the child's information. To exercise these
                                rights, please contact us at <strong>legal@mdbusiness.com</strong> with the subject
                                "Parental Access Request."
                            </p>
                        </div>
                    </div>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">7. Contact & Grievance</h2>
                    <p>For any questions regarding this policy or to exercise your data rights, please contact our Grievance
                        Officer at:</p>
                    <div class="mt-6 p-6 border-l-4 border-[#fd7319] bg-gray-50 rounded-r-2xl">
                        <p class="font-bold text-gray-800">One Advertisers / mdbusiness</p>
                        <p>Email: legal@mdbusiness.com</p>
                        <p>Subject: Privacy Data Request</p>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
