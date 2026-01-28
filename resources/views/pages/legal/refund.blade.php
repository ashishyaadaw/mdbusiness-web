@extends('layouts.app')

@section('content')
    <x-slot:title>Refund & Cancellation Policy | mdbusiness</x-slot>

    <section class="bg-[#145589] py-16 text-white relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-r from-[#145589] to-[#7f03d3] opacity-90"></div>
        <div class="container mx-auto px-6 relative z-10 text-center">
            <h1 class="text-4xl md:text-5xl font-black tracking-tighter mb-4">Refund & Cancellation</h1>
            <p class="text-blue-100 font-medium">Clear Terms for Professional Partnerships</p>
        </div>
    </section>

    <div class="container mx-auto px-6 py-16 max-w-4xl">
        <div class="bg-white p-8 md:p-12 rounded-[2.5rem] shadow-[0_20px_50px_rgba(20,85,137,0.05)] border border-gray-100">

            <div class="flex justify-between items-center mb-10 border-b border-gray-100 pb-6">
                <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#fd7319]">Entity: One Advertisers /
                    mdbusiness</span>
                <p class="text-sm text-gray-400 font-bold">Effective Date: {{ date('F d, Y') }}</p>
            </div>

            <div class="prose prose-slate max-w-none text-gray-600 space-y-10 leading-relaxed">

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">1. Nature of Services</h2>
                    <p>mdbusiness provides highly customized digital services, including software development
                        (Flutter/Laravel) and advertising placements. Due to the bespoke nature of these services and the
                        immediate allocation of engineering and creative resources, our policy is <strong>inclined toward
                            non-refundability</strong> once project execution begins.</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">2. Cancellation Policy</h2>
                    <p>We provide a narrow window for project cancellation to ensure fairness to both parties:</p>
                    <ul class="list-disc ml-6 space-y-2 mt-4">
                        <li><strong>Initial Window:</strong> Cancellation requests are only accepted within <strong>24
                                hours</strong> of the initial payment or order placement.</li>
                        <li><strong>Ineligibility:</strong> Requests will not be entertained if the project has already been
                            assigned to our development team or if the advertising campaign (One Advertisers) has been
                            scheduled or pushed to live servers/media outlets.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">3. Non-Refundable Policy</h2>
                    <p>In accordance with the <strong>Consumer Protection Act, 2019</strong> and industry standards for
                        digital products/services:</p>
                    <div class="bg-red-50 border-l-4 border-red-500 p-6 rounded-r-2xl my-6">
                        <p class="text-red-800 font-bold mb-2 uppercase tracking-wide text-xs">Final Sale Notice</p>
                        <p class="text-sm italic text-red-700">All payments made toward software development, API
                            integrations, and digital marketing campaigns are non-refundable. Once a milestone is approved
                            or a project phase begins, the associated costs are considered fully earned by the agency.</p>
                    </div>
                    <p>We do not offer refunds for "change of mind" or "project delay" caused by third-party integrations
                        (e.g., App Store approval delays, API changes by external providers).</p>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">4. Satisfaction & Iterations</h2>
                    <p>While we do not offer refunds, your satisfaction is our priority. If the delivered work does not meet
                        the <strong>Scope of Work (SOW)</strong> agreed upon:</p>
                    <ul class="list-disc ml-6 space-y-2 mt-4">
                        <li>Clients may request revisions within <strong>7 days</strong> of delivery.</li>
                        <li>We will provide iterations as defined in your specific contract to ensure the "Samsya" is
                            resolved.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-2xl font-black text-[#145589] mb-4">5. Dispute Resolution</h2>
                    <p>Any disputes regarding payments or service delivery shall be subject to the exclusive jurisdiction of
                        the courts in <strong>Deoria/Uttar Pradesh</strong>, India.</p>
                </section>

                <div class="mt-12 p-8 bg-gray-50 rounded-3xl text-center">
                    <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Questions regarding your bill?
                    </p>
                    <a href="mailto:billing@mdbusiness.com"
                        class="text-[#7f03d3] font-black text-lg hover:underline">billing@mdbusiness.com</a>
                </div>
            </div>
        </div>
    </div>
@endsection
