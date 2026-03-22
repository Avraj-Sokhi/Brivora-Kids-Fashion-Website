@extends('layouts.app')

@section('content')
    <header style="background: #28a745;">
        <h1>Admin Dashboard</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    <section style="max-width: 1200px; margin: 2rem auto; padding: 0 2rem;">

        {{-- Summary Stat Cards --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            {{-- Total Products --}}
            <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #4a90e2; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="font-size: 2.5rem; font-family: 'Fredoka One', cursive; color: #4a90e2;">{{ $totalProducts }}</div>
            <a href="{{ route('admin.products.index') }}" style="text-decoration: none;">
            </div>
            {{-- Total Orders --}}
            <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #28a745; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="font-size: 2.5rem; font-family: 'Fredoka One', cursive; color: #28a745;">{{ $totalOrders }}</div>
                    <p style="color: #334155; font-family: 'Comic Neue', cursive;">Add, edit, or remove products</p>
            </div>
            {{-- Total Customers --}}
            <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #ff9800; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="font-size: 2.5rem; font-family: 'Fredoka One', cursive; color: #ff9800;">{{ $totalCustomers }}</div>
                <div style="color: #666; font-family: 'Comic Neue', cursive; font-size: 1.1rem;">Customers</div>
            </div>
            {{-- Revenue --}}
            <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #e91e63; text-align: center; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                <div style="font-size: 2.5rem; font-family: 'Fredoka One', cursive; color: #e91e63;">£{{ number_format($totalRevenue, 2) }}</div>
                <div style="color: #666; font-family: 'Comic Neue', cursive; font-size: 1.1rem;">Revenue</div>
            </div>
        </div>

        {{-- Orders by Status --}}
        <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #4a90e2; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 1.5rem; margin-bottom: 1rem;">📊 Orders by Status</h2>
            <div style="display: flex; gap: 1rem; flex-wrap: wrap;">
                @php
                    $statusColors = ['processing' => '#ff9800', 'shipped' => '#2196f3', 'delivered' => '#4caf50', 'cancelled' => '#f44336', 'returned' => '#9c27b0'];
                @endphp
                @foreach(['processing', 'shipped', 'delivered', 'cancelled', 'returned'] as $status)
                    <div style="background: {{ $statusColors[$status] }}15; border: 2px solid {{ $statusColors[$status] }}; border-radius: 10px; padding: 1rem 1.5rem; text-align: center; min-width: 120px;">
                        <div style="font-size: 1.8rem; font-weight: bold; color: {{ $statusColors[$status] }};">{{ $ordersByStatus[$status] ?? 0 }}</div>
                        <div style="color: #334155; font-size: 0.9rem; text-transform: capitalize;">{{ $status }}</div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- Quick Actions --}}
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
            <a href="{{ route('admin.orders.index') }}" style="text-decoration: none;">
                <div style="background: #e8f5e9; padding: 2rem; border-radius: 15px; border: 3px solid #28a745; transition: transform 0.2s; text-align: center;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">📦</div>
                    <h3 style="font-family: 'Fredoka One', cursive; color: #28a745; margin-bottom: 0.5rem;">Manage Orders</h3>
                    <p style="color: #666; font-family: 'Comic Neue', cursive;">View and process customer orders</p>
                </div>
            </a>

            <a href="{{ route('admin.products.index') }}" style="text-decoration: none;">
                <div style="background: #f0f9ff; padding: 2rem; border-radius: 15px; border: 3px solid #4a90e2; transition: transform 0.2s; text-align: center;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">👕</div>
                    <h3 style="font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem;">Manage Inventory</h3>
                    <p style="color: #334155; font-family: 'Comic Neue', cursive;">Add, edit, or remove products</p>
                </div>
            </a>

            <a href="{{ route('admin.users.index') }}" style="text-decoration: none;">
                <div style="background: #fff8e1; padding: 2rem; border-radius: 15px; border: 3px solid #ff9800; transition: transform 0.2s; text-align: center;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    <div style="font-size: 3rem; margin-bottom: 0.5rem;">👥</div>
                    <h3 style="font-family: 'Fredoka One', cursive; color: #ff9800; margin-bottom: 0.5rem;">Manage Customers</h3>
                    <p style="color: #666; font-family: 'Comic Neue', cursive;">View and manage registered users</p>
                </div>
            </a>
        </div>

        {{-- Stock Alerts --}}
        @if($outOfStockProducts->isNotEmpty() || $lowStockProducts->isNotEmpty())
        <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #f44336; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="font-family: 'Fredoka One', cursive; color: #f44336; font-size: 1.5rem; margin-bottom: 1rem;">⚠️ Stock Alerts</h2>

            @if($outOfStockProducts->isNotEmpty())
                <h3 style="color: #f44336; margin-bottom: 0.5rem; font-size: 1rem;">Out of Stock ({{ $outOfStockProducts->count() }})</h3>
                <div style="margin-bottom: 1rem;">
                    @foreach($outOfStockProducts as $p)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 1rem; background: #ffebee; border-radius: 8px; margin-bottom: 0.5rem;">
                            <span style="font-weight: bold;">{{ $p->name }} <span style="color: #999; font-weight: normal;">({{ $p->category->name ?? '' }})</span></span>
                            <a href="{{ route('admin.inventory.create', $p->id) }}" style="color: #4a90e2; text-decoration: none; font-weight: bold;">Restock →</a>
                        </div>
                    @endforeach
                </div>
            @endif

            @if($lowStockProducts->isNotEmpty())
                <h3 style="color: #ff9800; margin-bottom: 0.5rem; font-size: 1rem;">Low Stock ({{ $lowStockProducts->count() }})</h3>
                <div>
                    @foreach($lowStockProducts as $p)
                        <div style="display: flex; justify-content: space-between; align-items: center; padding: 0.5rem 1rem; background: #fff8e1; border-radius: 8px; margin-bottom: 0.5rem;">
                            <span>{{ $p->name }} — <strong>{{ $p->stock_quantity }}</strong> left (threshold: {{ $p->low_stock_threshold }})</span>
                            <a href="{{ route('admin.inventory.create', $p->id) }}" style="color: #4a90e2; text-decoration: none; font-weight: bold;">Restock →</a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
        @endif

        {{-- Recent Inventory Activity --}}
        @if($recentLogs->isNotEmpty())
        <div style="background: white; padding: 2rem; border-radius: 15px; border: 3px solid #9c27b0; box-shadow: 0 4px 12px rgba(0,0,0,0.1); margin-bottom: 2rem;">
            <h2 style="font-family: 'Fredoka One', cursive; color: #9c27b0; font-size: 1.5rem; margin-bottom: 1rem;">📋 Recent Inventory Activity</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <thead>
                    <tr style="border-bottom: 2px solid #eee;">
                        <th style="text-align: left; padding: 0.5rem; color: #666; font-size: 0.85rem;">Date</th>
                        <th style="text-align: left; padding: 0.5rem; color: #666; font-size: 0.85rem;">Product</th>
                        <th style="text-align: left; padding: 0.5rem; color: #666; font-size: 0.85rem;">Action</th>
                        <th style="text-align: left; padding: 0.5rem; color: #666; font-size: 0.85rem;">Change</th>
                        <th style="text-align: left; padding: 0.5rem; color: #666; font-size: 0.85rem;">By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentLogs as $log)
                    <tr style="border-bottom: 1px solid #f0f0f0;">
                        <td style="padding: 0.5rem; font-size: 0.9rem;">{{ $log->created_at->format('M d, H:i') }}</td>
                        <td style="padding: 0.5rem; font-size: 0.9rem;">{{ $log->product->name ?? 'Deleted' }}</td>
                        <td style="padding: 0.5rem;">
                            <span style="padding: 2px 8px; border-radius: 10px; font-size: 0.8rem;
                                @if($log->action_type === 'incoming') background: #e8f5e9; color: #2e7d32;
                                @elseif($log->action_type === 'outgoing') background: #ffebee; color: #c62828;
                                @else background: #e3f2fd; color: #1565c0; @endif">
                                {{ ucfirst($log->action_type) }}
                            </span>
                        </td>
                        <td style="padding: 0.5rem; font-weight: bold; color: {{ $log->quantity_change >= 0 ? '#2e7d32' : '#c62828' }};">
                            {{ $log->quantity_change >= 0 ? '+' : '' }}{{ $log->quantity_change }}
                        </td>
                        <td style="padding: 0.5rem; font-size: 0.9rem; color: #666;">{{ $log->user->name ?? 'System' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif

    </section>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Comic+Neue:wght@400;700&display=swap" rel="stylesheet">
@endsection