@extends('layouts.app')

@section('content')
<div style="min-height: 100vh; display: flex; flex-direction: column; justify-content: center; align-items: center; padding: 48px 16px; background: linear-gradient(135deg, rgba(249, 240, 245, 1), rgba(254, 245, 230, 1));">
    <div style="width: 100%; max-width: 448px; background: white; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); overflow: hidden; border: 2px solid #fce7f3;">
        <div style="padding: 24px; background: linear-gradient(135deg, #ec4899, #f97316); color: white;">
            <h2 style="text-align: center; font-size: 28px; font-weight: bold; margin: 0; font-family: 'Fredoka One', cursive;">
                Login
            </h2>
        </div>
        <div style="padding: 24px;">
            <!-- Session Status -->
            @if ($errors->any())
                <div style="margin-bottom: 16px; padding: 16px; background-color: #fee2e2; border-left: 4px solid #ef4444; color: #dc2626; border-radius: 4px;">
                    <ul style="list-style-type: disc; padding-left: 20px; margin: 0; gap: 4px;">
                        @foreach ($errors->all() as $error)
                            <li style="margin: 4px 0;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}" style="width: 100%;">
                @csrf

                <!-- Email Address -->
                <div style="margin-bottom: 20px;">
                    <label for="email" style="display: block; color: #374151; font-size: 14px; font-weight: bold; margin-bottom: 8px;">
                        Email Address
                    </label>
                    <input id="email" style="width: 100%; padding: 8px 16px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; box-sizing: border-box; transition: border-color 0.2s; @error('email') border-color: #ef4444; @enderror" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236, 72, 153, 0.1)'" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'" />
                    @error('email')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div style="margin-bottom: 16px;">
                    <label for="password" style="display: block; color: #374151; font-size: 14px; font-weight: bold; margin-bottom: 8px;">
                        Password
                    </label>
                    <input id="password" style="width: 100%; padding: 8px 16px; border: 2px solid #e5e7eb; border-radius: 8px; font-size: 14px; box-sizing: border-box; transition: border-color 0.2s; @error('password') border-color: #ef4444; @enderror" type="password" name="password" required autocomplete="current-password" onfocus="this.style.borderColor='#ec4899'; this.style.boxShadow='0 0 0 3px rgba(236, 72, 153, 0.1)'" onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='none'" />
                    @error('password')
                        <p style="color: #ef4444; font-size: 12px; margin-top: 4px;">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div style="margin-bottom: 24px; display: flex; align-items: center;">
                    <input id="remember_me" type="checkbox" style="width: 16px; height: 16px; border: 1px solid #d1d5db; border-radius: 4px; cursor: pointer;" name="remember" />
                    <label for="remember_me" style="margin-left: 8px; font-size: 14px; color: #4b5563; cursor: pointer;">
                        Remember me
                    </label>
                </div>

                <!-- Login Button -->
                <button type="submit" style="width: 100%; background: linear-gradient(135deg, #ec4899, #f97316); color: white; font-weight: bold; padding: 12px 16px; border: none; border-radius: 8px; cursor: pointer; transition: all 0.3s; font-size: 16px;" onmouseover="this.style.opacity='0.9'; this.style.transform='scale(1.02)'" onmouseout="this.style.opacity='1'; this.style.transform='scale(1)'">
                    Log In
                </button>
            </form>

            <!-- Forgot Password & Register Links -->
            <div style="margin-top: 24px; text-align: center;">
                @if (Route::has('password.request'))
                    <div style="margin-bottom: 12px;">
                        <a style="font-size: 12px; color: #ec4899; text-decoration: none; font-weight: 600; cursor: pointer;" href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    </div>
                @endif
                <div style="border-top: 1px solid #e5e7eb; padding-top: 12px;">
                    <p style="color: #4b5563; font-size: 14px; margin: 0;">
                        Don't have an account?
                        <a href="{{ route('register') }}" style="color: #ec4899; text-decoration: none; font-weight: bold;">
                            Register here
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
