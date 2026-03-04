@extends('layouts.app')

@section('content')
    <header>
        <h1>About Brivora Kids Fashion</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    {{-- Hero Section --}}
    <section
        style="background: linear-gradient(135deg, #ff6f61 0%, #ff9a8b 100%); padding: 4rem 2rem; text-align: center; color: white; border-radius: 30px; margin: 2rem auto; max-width: 1200px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
        <h2
            style="font-family: 'Fredoka One', cursive; font-size: 3rem; margin-bottom: 1rem; text-shadow: 2px 2px 4px rgba(0,0,0,0.2);">
            Welcome to Brivora
        </h2>
        <p
            style="font-family: 'Comic Neue', cursive; font-size: 1.3rem; max-width: 800px; margin: 0 auto; line-height: 1.8;">
            Where style meets comfort for your little ones. We believe every child deserves to look amazing and feel great
            in what they wear.
        </p>
    </section>

    {{-- Our Story Section --}}
    <section style="max-width: 1200px; margin: 3rem auto; padding: 0 2rem;">
        <div
            style="background: white; padding: 3rem; border-radius: 25px; border: 3px solid #4a90e2; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
            <h2
                style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2.5rem; margin-bottom: 1.5rem; text-align: center;">
                Our Story
            </h2>
            <p
                style="font-family: 'Comic Neue', cursive; font-size: 1.2rem; color: #555; line-height: 1.8; margin-bottom: 1.5rem; text-align: center;">
                Brivora Kids Fashion was born from a simple idea: kids' clothing should be fun, comfortable, and affordable.
                We started our journey with a mission to bring joy to families by offering high-quality, stylish clothing
                that kids actually want to wear.
            </p>
        </div>
    </section>

    {{-- What We Offer Section --}}
    <section style="max-width: 1200px; margin: 3rem auto; padding: 0 2rem;">
        <h2
            style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 2.5rem; margin-bottom: 2rem; text-align: center;">
            What We Offer
        </h2>
        <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem;">
            {{-- Card 1 --}}
            <div style="background: white; padding: 2rem; border-radius: 20px; border: 2px solid #ffeaa7; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s;"
                onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <h3 style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 1.5rem; margin-bottom: 1rem;">
                    Trendy Clothing
                </h3>
                <p style="font-family: 'Comic Neue', cursive; color: #555; font-size: 1.1rem; line-height: 1.6;">
                    From cute tops to cozy outerwear, we have a wide selection of stylish clothing that kids love to wear.
                </p>
            </div>

            {{-- Card 2 --}}
            <div style="background: white; padding: 2rem; border-radius: 20px; border: 2px solid #a29bfe; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s;"
                onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <h3 style="font-family: 'Fredoka One', cursive; color: #4a90e2; font-size: 1.5rem; margin-bottom: 1rem;">
                    Quality Footwear
                </h3>
                <p style="font-family: 'Comic Neue', cursive; color: #555; font-size: 1.1rem; line-height: 1.6;">
                    Comfortable shoes and sneakers perfect for every adventure, from playground fun to special occasions.
                </p>
            </div>

            {{-- Card 3 --}}
            <div style="background: white; padding: 2rem; border-radius: 20px; border: 2px solid #81ecec; box-shadow: 0 4px 12px rgba(0,0,0,0.1); transition: transform 0.3s;"
                onmouseover="this.style.transform='translateY(-5px)'" onmouseout="this.style.transform='translateY(0)'">
                <h3 style="font-family: 'Fredoka One', cursive; color: #00b894; font-size: 1.5rem; margin-bottom: 1rem;">
                    Fun Accessories
                </h3>
                <p style="font-family: 'Comic Neue', cursive; color: #555; font-size: 1.1rem; line-height: 1.6;">
                    Complete the look with our range of backpacks, hats, and other accessories that add personality to any
                    outfit.
                </p>
            </div>
        </div>
    </section>


    {{-- Call to Action --}}
    <section style="max-width: 1200px; margin: 3rem auto 4rem; padding: 0 2rem; text-align: center;">
        <div
            style="background: white; padding: 3rem; border-radius: 25px; border: 3px solid #ff6f61; box-shadow: 0 8px 20px rgba(0,0,0,0.15);">
            <h2 style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2.5rem; margin-bottom: 1rem;">
                Ready to Shop?
            </h2>
            <p
                style="font-family: 'Comic Neue', cursive; font-size: 1.2rem; color: #555; margin-bottom: 2rem; line-height: 1.8;">
                Explore our collection and find the perfect outfits for your little ones.
            </p>
            <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap;">
                <a href="{{ route('products.index') }}" class="btn"
                    style="padding: 1rem 2.5rem; font-size: 1.2rem; font-family: 'Fredoka One', cursive; box-shadow: 0 4px 10px rgba(0,0,0,0.2); transition: transform 0.2s; text-decoration: none;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    Browse Products
                </a>
                <a href="{{ route('contact.index') }}"
                    style="padding: 1rem 2.5rem; font-size: 1.2rem; font-family: 'Fredoka One', cursive; background: white; color: #4a90e2; border: 3px solid #4a90e2; border-radius: 15px; text-decoration: none; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: all 0.3s;"
                    onmouseover="this.style.background='#4a90e2'; this.style.color='white'; this.style.transform='scale(1.05)'"
                    onmouseout="this.style.background='white'; this.style.color='#4a90e2'; this.style.transform='scale(1)'">
                    Contact Us
                </a>
            </div>
        </div>
    </section>

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka+One&family=Comic+Neue:wght@400;700&display=swap"
        rel="stylesheet">
@endsection