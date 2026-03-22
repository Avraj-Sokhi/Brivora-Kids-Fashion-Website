@extends('layouts.app')

@section('content')
    <header style="background: #28a745;">
        <h1>Admin Dashboard</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    <section style="max-width: 1200px; margin: 2rem auto; padding: 2rem;">
        <div
            style="background: white; padding: 3rem; border-radius: 20px; border: 3px solid #28a745; box-shadow: 0 8px 16px rgba(0,0,0,0.15); text-align: center;">
            <div style="font-size: 4rem; margin-bottom: 1rem;"></div>
            <h2 style="font-family: 'Fredoka One', cursive; color: #28a745; font-size: 2rem; margin-bottom: 1rem;">
                Admin Portal
            </h2>
            <p style="font-size: 1.2rem; color: #666; margin-bottom: 2rem;">
                Manage the Brivora Kids Fashion store from here!
            </p>

            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-top: 2rem;">

                {{-- Order Management --}}
                <a href="{{ route('admin.orders.index') }}" style="text-decoration: none;">
                    <div style="background: #e8f5e9; padding: 2rem; border-radius: 15px; border: 3px solid #28a745; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">📦</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #28a745; margin-bottom: 0.5rem;">Manage
                            Orders</h3>
                        <p style="color: #666;">View and process customer orders</p>
                    </div>
                </a>

                {{-- Product Management --}}
                <a href="{{ route('admin.products.index') }}" style="text-decoration: none;">
                    <div style="background: #f0f9ff; padding: 2rem; border-radius: 15px; border: 3px solid #4a90e2; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">👕</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Manage
                            Inventory</h3>
                        <p style="color: #666;">Add, edit, or remove products</p>
                    </div>
                </a>

                {{-- User Management (Placeholder) --}}
                <a href="#" style="text-decoration: none; opacity: 0.7;">
                    <div style="background: #fff8e1; padding: 2rem; border-radius: 15px; border: 3px solid #ff9800; transition: transform 0.2s;"
                        onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        <div style="font-size: 3rem; margin-bottom: 0.5rem;">👥</div>
                        <h3 style="font-family: 'Fredoka One', cursive; color: #ff9800; margin-bottom: 0.5rem;">Manage
                            Customers</h3>
                        <p style="color: #666;">View registered customers (Coming Soon)</p>
                    </div>
                </a>

            </div>
        </div>
    </section>
@endsection