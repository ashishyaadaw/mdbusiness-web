@extends('layouts.app')

@section('title', 'Safety Standards (CSAE) - MD Matrimony')

@section('content')
<div class="py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white shadow-xl rounded-2xl overflow-hidden border border-gray-100">
            
            <div class="bg-brand-red px-8 py-10 text-white text-center">
                <h1 class="font-serif text-3xl font-bold uppercase tracking-wide">Safety Standards</h1>
                <p class="mt-2 text-brand-light opacity-90">Protection against Child Sexual Abuse and Exploitation (CSAE)</p>
            </div>

            <div class="p-8 md:p-12 prose prose-red max-w-none">
                <div class="mb-10 p-5 bg-blue-50 rounded-xl border border-blue-100 flex items-start">
                    <svg class="h-6 w-6 text-blue-600 mt-0.5 mr-3 flex-shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <div>
                        <h4 class="text-blue-800 font-bold text-sm uppercase">Our Commitment</h4>
                        <p class="text-xs text-blue-700 mt-1">
                            MD Matrimony is a platform for adults to find life partners. We have a zero-tolerance policy toward any content or behavior that harms children.
                        </p>
                    </div>
                </div>

                <div class="space-y-10 text-gray-700">
                    <section>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-red-100 text-brand-red flex items-center justify-center mr-3 text-sm">01</span>
                            Prohibited Content & Behavior
                        </h2>
                        <p class="mt-3 ml-11">
                            We strictly prohibit the upload, sharing, or solicitation of Child Sexual Abuse Material (CSAM). This includes visual depictions, grooming behavior, or any form of child exploitation. Any such activity results in immediate account termination.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-red-100 text-brand-red flex items-center justify-center mr-3 text-sm">02</span>
                            Moderation & AI Detection
                        </h2>
                        <p class="mt-3 ml-11">
                            Our platform employs advanced image recognition technology and keyword filtering to detect and block CSAM. Our human moderation team reviews reported profiles 24/7 to ensure compliance with global safety standards.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-red-100 text-brand-red flex items-center justify-center mr-3 text-sm">03</span>
                            Mandatory Reporting
                        </h2>
                        <p class="mt-3 ml-11">
                            MD Matrimony complies with international law by reporting any instances of CSAM to the <strong>National Center for Missing & Exploited Children (NCMEC)</strong> and relevant law enforcement agencies immediately upon discovery.
                        </p>
                    </section>

                    <section>
                        <h2 class="text-xl font-bold text-gray-900 flex items-center">
                            <span class="w-8 h-8 rounded-full bg-red-100 text-brand-red flex items-center justify-center mr-3 text-sm">04</span>
                            How to Report
                        </h2>
                        <p class="mt-3 ml-11">
                            If you encounter any suspicious content, use the <strong>"Report Profile"</strong> feature within the app or email us at <span class="text-brand-red font-semibold">safety@mdmatrimony.com</span>. All reports are confidential and investigated with high priority.
                        </p>
                    </section>
                </div>

                <div class="mt-12 pt-8 border-t border-gray-100 text-center">
                    <p class="text-xs text-gray-400">
                        Last Reviewed: {{ now()->format('d M, Y') }} | Standard ID: CSAE-COMP-2024
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection