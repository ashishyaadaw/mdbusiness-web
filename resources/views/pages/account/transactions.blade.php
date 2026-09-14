@extends('layouts.app', ['title' => 'My Transactions', 'isSearchBar' => false])

@section('content')
    <div class="py-6">
        @include('pages.account.partials.nav')
        @include('pages.account.partials.flash')

        <h1 class="text-xl font-bold text-gray-900 mb-6">My Transactions</h1>

        @if ($transactions->isEmpty())
            <p class="text-gray-500">You don't have any transactions yet.</p>
        @else
            <div class="overflow-x-auto bg-white rounded-2xl border border-gray-100 shadow-sm">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="text-left text-gray-500 border-b border-gray-100">
                            <th class="px-4 py-3">Reference</th>
                            <th class="px-4 py-3">Title</th>
                            <th class="px-4 py-3">Amount</th>
                            <th class="px-4 py-3">Payment Method</th>
                            <th class="px-4 py-3">Status</th>
                            <th class="px-4 py-3">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($transactions as $transaction)
                            <tr class="border-b border-gray-50 last:border-0">
                                <td class="px-4 py-3 font-mono text-xs text-gray-600">{{ $transaction->transaction_reference }}</td>
                                <td class="px-4 py-3 font-semibold text-gray-800">{{ $transaction->title }}</td>
                                <td class="px-4 py-3">₹{{ number_format($transaction->amount, 2) }}</td>
                                <td class="px-4 py-3 text-gray-500">{{ $transaction->payment_method }}</td>
                                <td class="px-4 py-3">
                                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-0.5 rounded-full
                                        {{ match($transaction->status) {
                                            'success' => 'bg-green-100 text-green-700',
                                            'failed' => 'bg-red-100 text-red-700',
                                            default => 'bg-amber-100 text-amber-700',
                                        } }}">
                                        {{ ucfirst($transaction->status) }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-500">{{ optional($transaction->transaction_date)->format('d M Y') ?? $transaction->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-4">{{ $transactions->links() }}</div>
        @endif
    </div>
@endsection
