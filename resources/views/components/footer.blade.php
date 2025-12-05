<footer style="background: #1477b5; color: white; padding: 3rem 2rem; margin-top: auto; font-family: 'Comic Neue', cursive;">
  <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem;">
    
    {{-- Column 1: Brand --}}
    <div>
      <h3 style="font-family: 'Fredoka One', cursive; font-size: 1.8rem; margin-bottom: 1rem; color: #ffeb3b;">Brivora Kids</h3>
      <p style="line-height: 1.6;">Fashion for the little ones that brings joy, comfort, and style to every adventure.</p>
    </div>

    {{-- Column 2: Quick Links --}}
    <div>
      <h4 style="font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem; color: #ffeb3b;">Quick Links</h4>
      <ul style="list-style: none; padding: 0;">
        <li style="margin-bottom: 0.8rem;">
          <a href="{{ route('products.index') }}" style="color: white; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ffeb3b'" onmouseout="this.style.color='white'">Shop Collection</a>
        </li>
        <li style="margin-bottom: 0.8rem;">
          <a href="{{ route('about') }}" style="color: white; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ffeb3b'" onmouseout="this.style.color='white'">About Us</a>
        </li>
        <li style="margin-bottom: 0.8rem;">
          <a href="{{ route('contact.index') }}" style="color: white; text-decoration: none; transition: color 0.3s;" onmouseover="this.style.color='#ffeb3b'" onmouseout="this.style.color='white'">Contact Us</a>
        </li>
      </ul>
    </div>

    {{-- Column 3: Contact Info --}}
    <div>
      <h4 style="font-weight: bold; font-size: 1.2rem; margin-bottom: 1rem; color: #ffeb3b;">Get in Touch</h4>
      <p style="margin-bottom: 0.5rem;">Email: hello@brivora.com</p>
      <p style="margin-bottom: 0.5rem;">Phone: +44 123 456 7890</p>
      <p>Aston University, Birmingham, UK</p>
    </div>

  </div>

  <div style="text-align: center; margin-top: 3rem; padding-top: 1.5rem; border-top: 1px solid rgba(255,255,255,0.2);">
    <p>&copy; {{ date('Y') }} Brivora Kids Fashion. All rights reserved.</p>
  </div>
</footer>