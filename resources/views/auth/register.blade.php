<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-slate-950 relative overflow-hidden">

        <!-- Background Effects -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-cyan-500/20 blur-3xl rounded-full"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-amber-500/20 blur-3xl rounded-full"></div>

        <div
            class="w-full max-w-md bg-slate-900/80 backdrop-blur-xl border border-slate-700 rounded-3xl shadow-2xl p-8">

            <!-- Logo -->
            <div class="text-center mb-8">

                <div
                    class="w-20 h-20 mx-auto rounded-2xl bg-gradient-to-r from-cyan-500 to-amber-500 flex items-center justify-center shadow-lg">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="h-10 w-10 text-white"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M9.75 3v2.25M14.25 3v2.25M4.5 9h15M6.75 21h10.5A2.25 2.25 0 0019.5 18.75V8.25A2.25 2.25 0 0017.25 6H6.75A2.25 2.25 0 004.5 8.25v10.5A2.25 2.25 0 006.75 21z" />
                    </svg>
                </div>

                <h1 class="mt-4 text-3xl font-extrabold text-white">
                    Billiard Rental
                </h1>

                <p class="text-slate-400 text-sm mt-2">
                    Create your account and start managing tables efficiently
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <label class="block text-slate-300 text-sm font-semibold mb-2">
                        Full Name
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-cyan-400">
                            👤
                        </span>

                        <x-text-input
                            id="name"
                            class="w-full pl-10 bg-slate-800 border-slate-700 text-white rounded-xl focus:border-cyan-500 focus:ring-cyan-500"
                            type="text"
                            name="name"
                            :value="old('name')"
                            required
                            autofocus
                            autocomplete="name" />
                    </div>

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-5">

                    <label class="block text-slate-300 text-sm font-semibold mb-2">
                        Email Address
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-cyan-400">
                            ✉️
                        </span>

                        <x-text-input
                            id="email"
                            class="w-full pl-10 bg-slate-800 border-slate-700 text-white rounded-xl focus:border-cyan-500 focus:ring-cyan-500"
                            type="email"
                            name="email"
                            :value="old('email')"
                            required
                            autocomplete="username" />
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-5">

                    <label class="block text-slate-300 text-sm font-semibold mb-2">
                        Password
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-cyan-400">
                            🔒
                        </span>

                        <x-text-input
                            id="password"
                            class="w-full pl-10 bg-slate-800 border-slate-700 text-white rounded-xl focus:border-cyan-500 focus:ring-cyan-500"
                            type="password"
                            name="password"
                            required
                            autocomplete="new-password" />
                    </div>

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-5">

                    <label class="block text-slate-300 text-sm font-semibold mb-2">
                        Confirm Password
                    </label>

                    <div class="relative">
                        <span class="absolute left-3 top-3 text-cyan-400">
                            ✅
                        </span>

                        <x-text-input
                            id="password_confirmation"
                            class="w-full pl-10 bg-slate-800 border-slate-700 text-white rounded-xl focus:border-cyan-500 focus:ring-cyan-500"
                            type="password"
                            name="password_confirmation"
                            required
                            autocomplete="new-password" />
                    </div>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Register Button -->
                <button
                    type="submit"
                    class="mt-8 w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-amber-500 text-white font-bold text-lg shadow-lg hover:scale-[1.02] transition duration-300">
                    🚀 Create Account
                </button>

                <!-- Login Link -->
                <div class="mt-6 text-center">

                    <a href="{{ route('login') }}"
                        class="text-slate-400 hover:text-cyan-400 transition">
                        Already have an account?
                        <span class="font-semibold">
                            Sign In
                        </span>
                    </a>

                </div>

                <!-- Badge -->
                <div class="mt-6 flex justify-center">

                    <span
                        class="px-4 py-2 rounded-full text-xs font-bold bg-amber-500/20 text-amber-400 border border-amber-500/30">
                        🎱 SPORT • TECH • RENTAL SYSTEM
                    </span>

                </div>

            </form>
        </div>

    </div>
</x-guest-layout>