<x-guest-layout>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="space-y-5">

        <!-- Email -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                📧 Email
            </label>

            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                autofocus
                placeholder="Masukkan email..."
                class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500 shadow-sm outline-none transition">

            @error('email')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">
                🔒 Password
            </label>

            <div class="relative">

                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    placeholder="Masukkan password..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-xl focus:border-blue-500 focus:ring-2 focus:ring-blue-500 shadow-sm pr-12 outline-none transition">

                <button
                    type="button"
                    onclick="togglePassword()"
                    class="absolute right-4 top-3 text-gray-500 hover:text-blue-600">

                    👁

                </button>

            </div>

            @error('password')
                <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
            @enderror

        </div>

        <!-- Remember -->
        <div class="flex items-center justify-between">

            <label class="flex items-center">

                <input
                    type="checkbox"
                    name="remember"
                    class="rounded border border-gray-300 text-blue-600 focus:ring-2 focus:ring-blue-500">

                <span class="ml-2 text-sm text-gray-600">
                    Remember Me
                </span>

            </label>

            @if(Route::has('password.request'))

                <a href="{{ route('password.request') }}"
                    class="text-sm text-blue-600 hover:underline">

                    Lupa Password?

                </a>

            @endif

        </div>

        <!-- Tombol Login -->

        <button
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 active:bg-blue-800 duration-200 text-white font-bold py-3 rounded-xl shadow-lg transition transform hover:scale-105">

            🔐 LOGIN

        </button>

        <!-- Register -->

        <div class="text-center">

            <span class="text-gray-500">
                Belum punya akun?
            </span>

            <a href="{{ route('register') }}"
                class="text-blue-600 font-semibold hover:underline">

                Register

            </a>

        </div>

    </form>
</x-guest-layout>

<script>

function togglePassword(){

    let x = document.getElementById("password");

    if(x.type === "password"){
        x.type = "text";
    }else{
        x.type = "password";
    }

}

</script>