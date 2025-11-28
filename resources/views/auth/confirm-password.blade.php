<div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100 dark:bg-gray-900">
    <div class="w-full sm:max-w-md px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
        <h2 class="text-2xl font-bold text-center text-gray-900 dark:text-white mb-6">
            Confirm Password
        </h2>

        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            This is a secure area of the application. Please confirm your password before continuing.
        </div>

        <!-- Validation Errors -->
        @if ($errors->any())
            <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-200 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-gray-700 dark:text-gray-300 text-sm font-bold mb-2">
                    Password
                </label>
                <input id="password" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 dark:bg-gray-700 dark:text-white @error('password') border-red-500 @enderror" type="password" name="password" required autocomplete="current-password" />
                @error('password')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-center">
                <button type="submit" class="bg-pink-500 hover:bg-pink-600 text-white font-bold py-2 px-4 rounded-lg transition duration-300">
                    Confirm Password
                </button>
            </div>
        </form>
    </div>
</div>
