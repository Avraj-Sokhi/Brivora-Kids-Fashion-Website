<x-guest-layout>
    <h2 class="text-xl font-bold mb-4">Change Your Password</h2>

    @if (session('status'))
        <div class="mb-4 text-green-600">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.change.update') }}">
        @csrf

        <div class="mt-4">
            <label class="block font-medium">New Password</label>
            <input class="border p-2 w-full rounded" type="password" name="password" required>
        </div>

        <div class="mt-4">
            <label class="block font-medium">Confirm Password</label>
            <input class="border p-2 w-full rounded" type="password" name="password_confirmation" required>
        </div>

        <button class="mt-4 bg-blue-600 text-white px-4 py-2 rounded">
            Update Password
        </button>
    </form>
</x-guest-layout>
