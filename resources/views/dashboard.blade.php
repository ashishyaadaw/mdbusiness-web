<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - MD Matrimony</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { red: '#D32F2F', dark: '#8E0000', gold: '#FFC107', light: '#FFF5F5' }
                    },
                    fontFamily: { sans: ['Instrument Sans', 'sans-serif'], serif: ['Playfair Display', 'serif'] }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">

    <nav class="bg-brand-red shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center gap-2">
                     <div class="w-8 h-8 bg-white rounded-full flex items-center justify-center text-brand-red">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" /></svg>
                    </div>
                    <span class="text-white text-xl font-serif font-bold">MD Matrimony</span>
                </div>
                <div class="flex items-center gap-4 text-white">
                    <a href="#" class="hover:text-brand-gold">My Matches</a>
                    <a href="#" class="hover:text-brand-gold">Inbox</a>
                    
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-xs bg-brand-dark px-3 py-1 rounded border border-brand-gold hover:bg-white hover:text-brand-red transition">
                            Logout
                        </button>
                    </form>

                    <div class="w-8 h-8 rounded-full bg-brand-dark flex items-center justify-center border border-brand-gold">
                        <span class="text-xs font-bold">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
            
            <div class="md:col-span-1">
                <div class="bg-white rounded-lg shadow p-6 text-center border-t-4 border-brand-gold">
                    <div class="w-24 h-24 mx-auto bg-brand-light rounded-full mb-4 flex items-center justify-center border-2 border-brand-gold">
                        <span class="text-2xl font-serif font-bold text-brand-red">{{ substr(Auth::user()->name, 0, 1) }}</span>
                    </div>
                    
                    <h3 class="font-bold text-gray-800 text-lg">{{ Auth::user()->name }}</h3>
                    <p class="text-sm text-gray-500 mb-1">ID: MD-{{ 1000 + Auth::user()->id }}</p>
                    <p class="text-xs font-semibold text-brand-red uppercase tracking-wider mb-4">{{ Auth::user()->religion ?? 'Religion not set' }}</p>
                    
                    <div class="mb-4 text-left">
                        <div class="flex justify-between text-xs mb-1">
                            <span>Profile Completion</span>
                            <span class="font-bold text-brand-red">40%</span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div class="bg-brand-red h-2 rounded-full" style="width: 40%"></div>
                        </div>
                        <p class="text-[10px] text-gray-500 mt-2 italic">Welcome! Complete your profile to get better matches.</p>
                    </div>
                    
                    <button class="w-full border border-brand-red text-brand-red py-2 rounded hover:bg-brand-light transition text-sm font-semibold">Edit Profile</button>
                </div>
                
                <div class="mt-4 bg-white rounded-lg shadow p-4 text-sm text-gray-600">
                    <p><strong>Email:</strong> {{ Auth::user()->email }}</p>
                    <p><strong>Tongue:</strong> {{ Auth::user()->mother_tongue ?? 'Not set' }}</p>
                </div>
            </div>

            <div class="md:col-span-3">
                <h2 class="text-2xl font-serif font-bold text-gray-800 mb-6 flex items-center gap-2">
                    <span class="text-brand-red">Recommended</span> for you
                    <span class="text-sm font-sans font-normal bg-brand-light text-brand-red px-2 py-1 rounded-full">New Account</span>
                </h2>

                <div class="space-y-4">
                    @forelse (['Priya Sharma', 'Anjali Gupta', 'Sneha Patil'] as $match)
                    <div class="bg-white rounded-lg shadow p-4 flex flex-col md:flex-row gap-6 border border-gray-100 hover:shadow-md transition">
                        <div class="w-full md:w-40 h-40 bg-gray-200 rounded-lg flex-shrink-0 relative">
                             <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&q=80&w=200" class="w-full h-full object-cover rounded-lg">
                             <div class="absolute bottom-2 right-2 bg-white/80 px-2 py-0.5 rounded text-[10px] font-bold">Premium</div>
                        </div>
                        <div class="flex-grow">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-800">{{ $match }}</h3>
                                    <p class="text-sm text-gray-500">24-26 Yrs, 5'4" | {{ Auth::user()->religion }}</p>
                                </div>
                                <span class="text-xs font-bold text-green-600 border border-green-600 px-2 py-1 rounded flex items-center gap-1">
                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"/></svg>
                                    Verified
                                </span>
                            </div>
                            
                            <div class="mt-4 grid grid-cols-2 gap-y-2 text-sm text-gray-600">
                                <p>🎓 Professional</p>
                                <p>📍 Nearby City</p>
                                <p>🗣 {{ Auth::user()->mother_tongue }}</p>
                                <p>💼 Working Profile</p>
                            </div>

                            <div class="mt-6 flex gap-3">
                                <button class="bg-brand-red text-white px-6 py-2 rounded-lg font-semibold hover:bg-brand-dark transition shadow">Send Interest</button>
                                <button class="border border-gray-300 text-gray-600 px-4 py-2 rounded-lg hover:bg-gray-50 transition">View Details</button>
                            </div>
                        </div>
                    </div>
                    @empty
                        <div class="bg-white p-12 text-center rounded-lg shadow">
                            <p class="text-gray-500">Complete your profile to see matches!</p>
                        </div>
                    @endforelse
                </div>
            </div>

        </div>
    </div>
</body>
</html>