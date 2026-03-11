@extends('layouts.app')

@section('content')
    <header>
        <h1>Contact Us</h1>
    </header>

    {{-- Navigation --}}
    <x-nav />

    {{-- Success Message --}}
    @if(session('success'))
        <div
            style="background: #4caf50; color: white; padding: 1.5rem; margin: 1rem auto; border-radius: 15px; text-align: center; max-width: 600px; font-family: 'Comic Neue', cursive; font-size: 1.2rem; animation: slideDown 0.3s ease-out; box-shadow: 0 4px 8px rgba(0,0,0,0.2);">
            ✓ {{ session('success') }}
        </div>
    @endif

    <style>
        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <section style="max-width: 800px; margin: 2rem auto; padding: 2rem;">
        {{-- Contact Form --}}
        <div
            style="background: white; padding: 2rem; border-radius: 20px; border: 3px solid #4a90e2; box-shadow: 0 8px 16px rgba(0,0,0,0.15);">
            <h2
                style="font-family: 'Fredoka One', cursive; color: #ff6f61; font-size: 2rem; margin-bottom: 1rem; text-align: center;">
                Send Us a Message
            </h2>
            <p style="text-align: center; color: #666; margin-bottom: 2rem; font-size: 1.1rem;">
                We'd love to hear from you! Fill out the form below and we'll get back to you as soon as possible.
            </p>

            <form method="POST" action="{{ route('contact.submit') }}"
                style="display: flex; flex-direction: column; gap: 1.5rem;">
                @csrf

                {{-- Name Field --}}
                <div>
                    <label for="name"
                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem; font-size: 1.1rem;">
                        Your Name *
                    </label>
                    <input type="text" id="name" name="name" required value="{{ old('name') }}"
                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; font-size: 1rem; background-color: #fff8e1; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#ff6f61'"
                        placeholder="Enter your full name">
                    @error('name')
                        <span
                            style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Email Field --}}
                <div>
                    <label for="email"
                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem; font-size: 1.1rem;">
                        Your Email *
                    </label>
                    <input type="email" id="email" name="email" required value="{{ old('email') }}"
                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; font-size: 1rem; background-color: #fff8e1; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#ff6f61'"
                        placeholder="your.email@example.com">
                    @error('email')
                        <span
                            style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Subject Field --}}
                <div>
                    <label for="subject"
                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem; font-size: 1.1rem;">
                        Subject *
                    </label>
                    <input type="text" id="subject" name="subject" required value="{{ old('subject') }}"
                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; font-size: 1rem; background-color: #fff8e1; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#ff6f61'"
                        placeholder="What's this about?">
                    @error('subject')
                        <span
                            style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Message Field --}}
                <div>
                    <label for="message"
                        style="display: block; font-family: 'Fredoka One', cursive; color: #4a90e2; margin-bottom: 0.5rem; font-size: 1.1rem;">
                        Your Message *
                    </label>
                    <textarea id="message" name="message" required rows="6"
                        style="width: 100%; padding: 0.8rem; border: 2px solid #ff6f61; border-radius: 10px; font-family: 'Comic Neue', cursive; font-size: 1rem; background-color: #fff8e1; resize: vertical; transition: border-color 0.3s;"
                        onfocus="this.style.borderColor='#4a90e2'" onblur="this.style.borderColor='#ff6f61'"
                        placeholder="Tell us what your query/concerns are...">{{ old('message') }}</textarea>
                    @error('message')
                        <span
                            style="color: #e74c3c; font-size: 0.9rem; margin-top: 0.3rem; display: block;">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Submit Button --}}
                <button type="submit" class="btn"
                    style="padding: 1rem 2rem; font-size: 1.2rem; font-family: 'Fredoka One', cursive; box-shadow: 0 4px 8px rgba(0,0,0,0.2); transition: transform 0.2s;"
                    onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                    Send Message
                </button>
            </form>
        </div>
    </section>
@endsection