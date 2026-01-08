<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register - MD Matrimony</title>
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
    <style>
        .mandala-bg {
            background-color: #ffffff;
            background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23d32f2f' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
        }
    </style>
</head>
<body class="mandala-bg min-h-screen py-10 px-4">
    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-2xl overflow-hidden border-t-4 border-brand-gold">
        <div class="bg-brand-red p-6 text-center">
            <h2 class="text-3xl font-serif font-bold text-white">Begin your Auspicious Journey</h2>
            <p class="text-red-100 mt-2">Create a profile using your phone number.</p>
        </div>

        <div class="p-8">
            <form method="POST" action="{{ route('register.submit') }}" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                @csrf
                
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Profile created for</label>
                    <div class="flex gap-4">
                        @foreach(['Self', 'Son', 'Daughter'] as $role)
                        <label class="flex items-center p-3 border rounded-lg cursor-pointer hover:bg-brand-light hover:border-brand-red transition">
                            <input type="radio" name="profile_for" value="{{ $role }}" {{ old('profile_for') == $role ? 'checked' : '' }} class="text-brand-red focus:ring-brand-red">
                            <span class="ml-2">{{ $role }}</span>
                        </label>
                        @endforeach
                    </div>
                    @error('profile_for') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Full Name</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="w-full px-4 py-2 border @error('name') border-red-500 @else border-gray-300 @enderror rounded-lg focus:border-brand-red outline-none">
                    @error('name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Phone Number</label>
                    <div class="flex">
                        <span class="inline-flex items-center px-3 rounded-l-lg border border-r-0 @error('phone') border-red-500 @else border-gray-300 @enderror bg-gray-50 text-gray-500">+91</span>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="10-digit mobile number" class="w-full px-4 py-2 border @error('phone') border-red-500 @else border-gray-300 @enderror rounded-r-lg focus:border-brand-red outline-none">
                    </div>
                    @error('phone') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Date of Birth</label>
                    <input type="date" name="dob" value="{{ old('dob') }}" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brand-red outline-none">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Religion</label>
                    <select name="religion" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brand-red outline-none bg-white">
                        @foreach(['Hindu', 'Muslim', 'Sikh', 'Christian', 'Jain'] as $religion)
                            <option value="{{ $religion }}" {{ old('religion') == $religion ? 'selected' : '' }}>{{ $religion }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Mother Tongue</label>
                    <select name="mother_tongue" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brand-red outline-none bg-white">
                        @foreach(['Hindi', 'Marathi', 'Bengali', 'Tamil', 'Telugu'] as $lang)
                            <option value="{{ $lang }}" {{ old('mother_tongue') == $lang ? 'selected' : '' }}>{{ $lang }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                    <input type="password" name="password" class="w-full px-4 py-2 border @error('password') border-red-500 @else border-gray-300 @enderror rounded-lg focus:border-brand-red outline-none">
                    @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:border-brand-red outline-none">
                </div>

                <div class="md:col-span-2 mt-4">
                    <button type="submit" class="w-full bg-brand-red text-white font-bold py-3 rounded-lg hover:bg-brand-dark transition shadow-lg text-lg">
                        Register Now
                    </button>
                    <p class="text-xs text-center text-gray-500 mt-4">
                        Already have an account? <a href="{{ route('login') }}" class="text-brand-red font-semibold hover:underline">Login with Phone</a>.
                    </p>
                    <p class="text-xs text-center text-gray-500 mt-2">
                        By clicking register, you agree to our <a href="{{ route('pages.terms') }}" class="underline">Terms & Conditions</a> and <a href="{{ route('privacy') }}" class="underline">Privacy Policy</a>.
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>