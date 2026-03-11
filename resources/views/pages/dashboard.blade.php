@extends('layouts.app')

@section('content')
    <header>
        <h1>Dashboard</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    <section style="max-width: 1200px; margin: 2rem auto; padding: 2rem;">
        <div
            style="background: white; padding: 3rem; border-radius: 20px; border: 3px solid #4a90e2; box-shadow: 0 8px 16px rgba(0,0,0,0.15); text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;">👋</div>
            <h2 style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 2rem; margin-bottom: 1rem;">
                Welcome, {{ Auth::user()->name }}!
            </h2>
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">
                You're logged in and ready to shop!
            </p>

            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">
                {{-- Quick Links --}}
                <a href="{{ route('products.index') }}" style="text-decoration: none;">
                    <div style="background: #f0f9ff; padding: 2rem; border-radius: 15px; border: 3px solid #4a90e2; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">🛍️</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Browse
                            Products</h3>
                        <p style="color: #666;">Explore our collection</p>
                    </div>
                </a>

                <a href="{{ route('basket.index') }}" style="text-decoration: none;">
                    <div style="background: #fff8e1; padding: 2rem; border-radius: 15px; border: 3px solid #ff6f61; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">🛒</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #ff6f61; margin-bottom: 0.5rem;">My Basket
                        </h3>
                        <p style="color: #666;">View your items</p>
                    </div>
                </a>

                <a href="{{ route('profile.edit') }}" style="text-decoration: none;">
                    <div style="background: #e8f5e9; padding: 2rem; border-radius: 15px; border: 3px solid #4caf50; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">👤</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #4caf50; margin-bottom: 0.5rem;">My Profile
                        </h3>
                        <p style="color: #666;">Update your details</p>
                    </div>
                </a>
            </div>
        </div>
    </section>
@endsection