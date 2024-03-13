<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Email Address -->
    <div>
        <label for="email">ID</label>
        <input id="email" type="email" name="email" required autofocus />
    </div>

    <!-- Password -->
    <div class="mt-4">
        <label for="password">Password</label>
        <input id="password" type="password" name="password" required autocomplete="current-password" />
    </div>

    <!-- Remember Me -->
    <div class="block mt-4">
        <label for="remember_me" class="flex items-center">
            <input id="remember_me" type="checkbox" name="remember">
            <span class="ml-2">Remember me</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        <!-- Forgot Password -->
        @if (session('status') == 'passwords.sent')
            <a class="underline text-sm" href="{{ route('password.request') }}">
                Forgot your password?
            </a>
        @endif

        <!-- Login Button -->
        <button class="ml-4">
            Login
        </button>

        <!-- Register Button -->
        <a href="{{ route('register') }}" class="ml-4">
            Register
        </a>
    </div>
</form>
