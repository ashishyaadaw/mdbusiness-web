@extends('layouts.app')

@section('content')
    <x-slot:title>Terms of Service | mdbusiness</x-slot>

    <section class="bg-[#145589] py-16 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#145589] to-[#7f03d3] opacity-95"></div>
        <div class="container mx-auto px-6 relative z-10 text-left">
            <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-4">Terms & Conditions</h1>
            <p class="text-blue-100 font-medium max-w-2xl">The technical and legal framework governing our digital
                partnerships and project delivery.</p>
        </div>
    </section>

    <div class="container mx-auto px-6 py-16 max-w-4xl">
        <div class="bg-white p-8 md:p-14 rounded-[2.5rem] shadow-[0_20px_60px_rgba(20,85,137,0.06)] border border-gray-100">

            <div class="flex flex-col md:flex-row justify-between items-start mb-12 border-b border-gray-100 pb-8 gap-4">
                <div>
                    <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#fd7319]">Legal Unit: One
                        Advertisers</span>
                    <p class="text-sm text-gray-400 font-bold mt-1">Version 2.1 • Last Updated: {{ date('F d, Y') }}</p>
                </div>
                <a href="mailto:legal@mdbusiness.com"
                    class="text-xs font-bold text-[#7f03d3] flex items-center gap-2 hover:underline">
                    <ion-icon name="mail-outline"></ion-icon> Request PDF Version
                </a>
            </div>

            <div class="prose prose-slate max-w-none text-gray-600 space-y-12 leading-relaxed text-left">

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">1. Acceptance & Unit Identity</h2>
                    <p>
                        By engaging with <strong>mdbusiness</strong>, a unit of <strong>One Advertisers</strong>, you
                        acknowledge that you have read, understood, and agreed to be bound by these Terms of Service. These
                        terms govern all software development (Flutter, Laravel), digital advertising, and technical
                        consultancy provided by us.
                    </p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">2. Project Execution & Milestones</h2>
                    <p>All projects are executed in <strong>Iterative Sprints</strong> as part of our Agile methodology.
                        Each milestone is subject to client approval:</p>
                    <ul class="list-disc ml-6 space-y-2 mt-4 text-left">
                        <li>Approval of a milestone signifies acceptance of the work-to-date.</li>
                        <li>Significant changes to approved milestones will be treated as "Change Requests" and may incur
                            additional billing.</li>
                        <li>Delivery timelines are estimates and are contingent upon the timely provision of assets and
                            feedback by the client.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">3. Intellectual Property (IP) Rights</h2>
                    <p>We believe in full transparency regarding code ownership:</p>
                    <div class="bg-gray-50 p-6 rounded-2xl border border-gray-100 my-4 text-left">
                        <p class="text-sm italic">"The ownership of the final Custom Source Code (specifically developed for
                            the client) is transferred to the Client only upon <strong>100% completion of all
                                payments</strong>."</p>
                    </div>
                    <p>mdbusiness retains ownership of pre-existing proprietary modules, "boilerplate" code, and internal
                        libraries used to accelerate development.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">4. Third-Party Dependencies</h2>
                    <p>mdbusiness is not liable for service interruptions, pricing changes, or policy updates from
                        third-party providers including, but not limited to, <strong>AWS, Google Cloud, Apple App Store,
                            Google Play Store,</strong> or specific API providers (e.g., WhatsApp Business API, Payment
                        Gateways).</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">5. Confidentiality & NDA</h2>
                    <p>We treat your business logic as a "Trade Secret." mdbusiness and One Advertisers agree not to
                        disclose
                        any sensitive business data provided during the development of your software. Clients likewise agree
                        not to disclose mdbusiness's internal pricing structures or development methodologies to third
                        parties.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">6. Limitation of Liability</h2>
                    <p>In accordance with the <strong>Information Technology Act, 2000</strong>, mdbusiness's total
                        liability
                        for any claim arising out of our services shall not exceed the total amount paid by the client for
                        the specific project phase in question.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">7. Governing Law & Jurisdiction</h2>
                    <p>These terms are governed by the laws of the Republic of India. All disputes are subject to the
                        exclusive jurisdiction of the courts in <strong>Deoria, Uttar Pradesh</strong>.</p>
                </section>
                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">8. Child Safety & Age Requirements</h2>
                    <p>
                        In compliance with the <strong>Google Play Developer Program Policy</strong> and global data
                        protection laws,
                        <strong>mdbusiness</strong> maintains a strict Child Safety protocol:
                    </p>
                    <ul class="list-disc ml-6 space-y-3 mt-4 text-left">
                        <li>
                            <strong>Minimum Age:</strong> Our services are intended for users aged <strong>18 and
                                above</strong>.
                            By using this app, you represent that you have reached the age of majority in your jurisdiction.
                        </li>
                        <li>
                            <strong>Parental Consent:</strong> If you are under 18, you may only use our platform under the
                            direct supervision of a parent or legal guardian who agrees to be bound by these Terms.
                        </li>
                        <li>
                            <strong>Data Collection:</strong> We do not knowingly collect "Personally Identifiable
                            Information" (PII)
                            from children under 13 (or under 18 in India per DPDP Act). If we discover such data has been
                            collected
                            without verified parental consent, it will be <strong>purged immediately</strong> from our
                            servers.
                        </li>
                        <li>
                            <strong>Zero Tolerance:</strong> Any user-generated content (UGC) that depicts, encourages, or
                            facilitates
                            child sexual abuse or exploitation is prohibited and will result in an <strong>immediate
                                permanent ban</strong>
                            and a report to the appropriate law enforcement authorities (NCMEC/Cyber Cell).
                        </li>
                    </ul>
                </section>
                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">9. Account Deletion & Data Empowerment</h2>
                    <p>
                        In accordance with <strong>Google Play’s User Data Policy</strong> and India’s
                        <strong>DPDP Act 2023</strong>, we provide a transparent process for account termination.
                    </p>
                    <ul class="list-disc ml-6 space-y-3 mt-4 text-left text-sm">
                        <li>
                            <strong>How to Request:</strong> Users can initiate deletion via in-app settings or the
                            <a href="{{ route('deletion') }}" class="text-[#7f03d3] font-bold hover:underline">Web Deletion
                                Portal</a>
                            using their registered <strong>Email or Phone Number</strong>.
                        </li>
                        <li>
                            <strong>Reason for Deletion:</strong> We collect the reason for deletion to improve our services
                            and
                            ensure compliance with data safety audits.
                        </li>
                        <li>
                            <strong>Timeline:</strong> Once verified, mdbusiness will purge all personal data within
                            <strong>30 days</strong>, unless retention is legally mandated for tax or fraud audits.
                        </li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">10. User-Generated Content & Conduct</h2>
                    <p>
                        If our platform allows you to post business listings, reviews, or comments, you agree to:
                    </p>
                    <ul class="list-disc ml-6 space-y-2 mt-4 text-left">
                        <li>Not post content that is harmful to minors or promotes illegal activities.</li>
                        <li>Not post "Obscene" or "Pornographic" material as defined under the IT Act, 2000.</li>
                        <li>Acknowledge that mdbusiness utilizes <strong>automated and manual moderation</strong> to remove
                            objectionable content within 24 hours of a report.</li>
                    </ul>
                </section>

                <div
                    class="mt-20 p-10 bg-gradient-to-br from-[#145589] to-[#7f03d3] rounded-[2rem] text-white flex flex-col md:flex-row items-center justify-between gap-6 text-left">
                    <div class="w-full">
                        <h2 class="text-2xl font-black mb-2 tracking-tight">Need a Custom SLA?</h2>
                        <p class="text-blue-100 text-sm max-w-md">We provide tailored Service Level Agreements (SLA) for
                            Enterprise-level "Samsya" solving.</p>
                    </div>
                    <div class="w-full md:w-auto">
                        <a href="mailto:info@mdbusiness.com"
                            class="inline-block px-8 py-4 bg-[#fd7319] hover:bg-white hover:text-[#145589] rounded-xl font-black uppercase tracking-widest text-[10px] transition-all shadow-xl whitespace-nowrap">
                            Contact Billing
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
