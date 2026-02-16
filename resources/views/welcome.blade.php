@extends('layouts.app')

@section('content')
    {{-- Navigation --}}
    <x-nav />

    {{-- Hero Section --}}
    <section
        style="background: linear-gradient(135deg, #ff6f61 0%, #ff9a8b 50%, #ffc3a0 100%); padding: 5rem 2rem; text-align: center; color: white; margin-top: 2rem; position: relative; overflow: hidden;">
        <div style="max-width: 1200px; margin: 0 auto; position: relative; z-index: 2;">
            <h1
                style="font-family: 'Fredoka One', cursive; font-size: 3.5rem; margin-bottom: 1.5rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); animation: fadeInUp 0.8s ease-out;">
                Welcome to Brivora Kids Fashion
            </h1>
            <p
                style="font-family: 'Comic Neue', cursive; font-size: 1.4rem; margin-bottom: 2.5rem; line-height: 1.8; max-width: 800px; margin-left: auto; margin-right: auto; animation: fadeInUp 1s ease-out;">
                Where style meets comfort for your little ones. Discover trendy, affordable clothing that kids love to wear!
            </p>
            <a href="{{ route('products.index') }}" class="btn"
                style="padding: 1.2rem 3rem; font-size: 1.3rem; font-family: 'Fredoka One', cursive; box-shadow: 0 6px 15px rgba(0,0,0,0.3); transition: all 0.3s; text-decoration: none; display: inline-block; animation: fadeInUp 1.2s ease-out;"
                onmouseover="this.style.transform='scale(1.1) translateY(-5px)'; this.style.boxShadow='0 8px 20px rgba(0,0,0,0.4)'"
                onmouseout="this.style.transform='scale(1) translateY(0)'; this.style.boxShadow='0 6px 15px rgba(0,0,0,0.3)'">
                Shop Now
            </a>
        </div>

        {{-- Decorative circles --}}
        <div
            style="position: absolute; width: 300px; height: 300px; background: rgba(255,255,255,0.1); border-radius: 50%; top: -100px; right: -100px;">
        </div>
        <div
            style="position: absolute; width: 200px; height: 200px; background: rgba(255,255,255,0.1); border-radius: 50%; bottom: -50px; left: -50px;">
        </div>
    </section>

    {{-- Categories Section --}}
    <section style="max-width: 1200px; margin: 4rem auto; padding: 0 2rem;">
        <h2
            style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 2.5rem; text-align: center; margin-bottom: 3rem;">
            Shop by Category
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
            {{-- Category Card 1 --}}
            <a href="{{ route('products.index', ['category' => 'tops']) }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; padding: 2.5rem; border-radius: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 3px solid #ffeaa7;"
                    onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                    <h3
                        style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        Tops
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; color: #666; font-size: 1rem;">
                        Stylish shirts & jumpers
                    </p>
                </div>
            </a>

            {{-- Category Card 2 --}}
            <a href="{{ route('products.index', ['category' => 'shoes']) }}" style="text-decoration: none; color: inherit;">
                <div style="background: white; padding: 2.5rem; border-radius: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 3px solid #a29bfe;"
                    onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                    <h3
                        style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        Shoes
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; color: #666; font-size: 1rem;">
                        Comfy sneakers & trainers
                    </p>
                </div>
            </a>

            {{-- Category Card 3 --}}
            <a href="{{ route('products.index', ['category' => 'outerwear']) }}"
                style="text-decoration: none; color: inherit;">
                <div style="background: white; padding: 2.5rem; border-radius: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 3px solid #fab1a0;"
                    onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                    <h3
                        style="font-family: 'Fredoka One', cursive; color: #ff7675; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        Outerwear
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; color: #666; font-size: 1rem;">
                        Cozy jackets & fleeces
                    </p>
                </div>
            </a>

            {{-- Category Card 4 --}}
            <a href="{{ route('products.index', ['category' => 'accessories']) }}"
                style="text-decoration: none; color: inherit;">
                <div style="background: white; padding: 2.5rem; border-radius: 20px; text-align: center; box-shadow: 0 4px 15px rgba(0,0,0,0.1); transition: all 0.3s; border: 3px solid #81ecec;"
                    onmouseover="this.style.transform='translateY(-10px)'; this.style.boxShadow='0 8px 25px rgba(0,0,0,0.15)'"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.1)'">
                    <h3
                        style="font-family: 'Fredoka One', cursive; color: #00b894; font-size: 1.5rem; margin-bottom: 0.5rem;">
                        Accessories
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; color: #666; font-size: 1rem;">
                        Fun hats & backpacks
                    </p>
                </div>
            </a>
        </div>
    </section>

    {{-- Features Section --}}
    <section
        style="background: linear-gradient(135deg, #a29bfe 0%, #6c5ce7 100%); padding: 4rem 2rem; margin: 4rem 0; color: white;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="font-family: 'Fredoka One', cursive; font-size: 2.5rem; text-align: center; margin-bottom: 3rem;">
                Why Shop With Us?
            </h2>
            <div
                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2.5rem; text-align: center;">
                <div>

                    <h3 style="font-family: 'Fredoka One', cursive; font-size: 1.4rem; margin-bottom: 0.8rem;">
                        Quality Products
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; font-size: 1.1rem; line-height: 1.6;">
                        Only the best materials for your little ones
                    </p>
                </div>
                <div>

                    <h3 style="font-family: 'Fredoka One', cursive; font-size: 1.4rem; margin-bottom: 0.8rem;">
                        Affordable Prices
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; font-size: 1.1rem; line-height: 1.6;">
                        Great fashion without breaking the bank
                    </p>
                </div>
                <div>

                    <h3 style="font-family: 'Fredoka One', cursive; font-size: 1.4rem; margin-bottom: 0.8rem;">
                        Fast Shipping
                    </h3>
                    <p style="font-family: 'Comic Neue', cursive; font-size: 1.1rem; line-height: 1.6;">
                        Quick delivery right to your door
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    <section style="max-width: 1200px; margin: 4rem auto 5rem; padding: 0 2rem; text-align: center;">
        <div
            style="background: white; padding: 4rem 2rem; border-radius: 30px; border: 3px solid #ff6f61; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
            <h2 style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2.8rem; margin-bottom: 1.5rem;">
                Ready to Start Shopping?
            </h2>
            <p
                style="font-family: 'Comic Neue', cursive; font-size: 1.3rem; color: #555; margin-bottom: 2.5rem; line-height: 1.8; max-width: 700px; margin-left: auto; margin-right: auto;">
                Browse our collection of trendy kids' clothing and find the perfect outfits for your little fashionistas!
            </p>
            <div style="display: flex; gap: 1.5rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('products.index') }}" class="btn"
                    style="padding: 1.2rem 3rem; font-size: 1.2rem; font-family: 'Fredoka One', cursive; box-shadow: 0 4px 12px rgba(0,0,0,0.2); transition: all 0.3s; text-decoration: none;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    Browse All Products
                </a>
                <a href="{{ route('about') }}"
                    style="padding: 1.2rem 3rem; font-size: 1.2rem; font-family: 'Fredoka One', cursive; background: white; color: #4a90e2; border: 3px solid #4a90e2; border-radius: 15px; text-decoration: none; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: all 0.3s;"
                    onmouseover="this.style.background='#4a90e2'; this.style.color='white'; this.style.transform='scale(1.05)'"
                    onmouseout="this.style.background='white'; this.style.color='#4a90e2'; this.style.transform='scale(1)'">
                    Learn More About Us
                </a>
            </div>
        </div>
    </section>

    {{-- Animations --}}
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Comic+Neue:wght@400;700&display=swap"
        rel="stylesheet">
@endsection