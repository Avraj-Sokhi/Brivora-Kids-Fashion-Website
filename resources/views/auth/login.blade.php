<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">
            {{ config('app.name') }} - Login
        </h2>

        <!-- Session Status -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="mb-4">
                <label for="email" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    Email Address
                </label>
                <input id="email" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 dark:bg-gray-700 dark:text-white @error('email') border-red-500 @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    Password
                </label>
                <input id="password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-700 border-gray-300 dark:border-gray-600 text-pink-600 shadow-sm focus:ring-pink-500 dark:focus:ring-pink-600 dark:checked:bg-pink-600" name="remember" />
                <label for="remember_me" class="ml-2 text-sm text-gray-600 dark:text-gray-400">
                    Remember me
                </label>
            </div>

            <div class="flex items-center justify-between">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-pink-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                        Forgot your password?
                    </a>
                @endif

                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Log in
                </button>
            </div>
        </form>

        <div class="mt-6 text-center">
            <p class="text-gray-600 dark:text-gray-400 text-sm">
                Don't have an account?
                <a href="{{ route('register') }}" class="text-pink-600 dark:text-pink-400 hover:underline font-bold">
                    Register here
                </a>
            </p>
        </div>
    </div>
</div>
