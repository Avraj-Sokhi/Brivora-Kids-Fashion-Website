<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Brivora Kids Fashion') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Comic+Neue:wght@700&family=Fredoka+One&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vite / App assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Inline custom styles -->
    <style>
        body {
            font-family: 'Comic Neue', cursive;
            margin: 0;
            padding: 0;
        }

        header {
            background: #1477b5;
            color: white;
            padding: 1rem;
            text-align: center;
            font-family: 'Fredoka One', cursive;
            font-size: 2rem;
            letter-spacing: 2px;
        }

        nav {
            background: #4a90e2;
            padding: 0.5rem;
            text-align: center;
        }

        nav a {
            color: #fff;
            margin: 0 1rem;
            text-decoration: none;
            font-weight: bold;
            font-family: 'Comic Neue', cursive;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #ffeb3b;
            text-decoration: underline;
        }

        .filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem;
            flex-wrap: wrap;
        }

        .filters input,
        .filters select {
            padding: 0.5rem;
            border: 2px solid #ff6f61;
            border-radius: 10px;
            font-family: 'Comic Neue', cursive;
            background-color: #fff8e1;
        }

        .products {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            padding: 1rem;
        }

        .card {
            border: 3px solid #0320ff;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            background: #fff;
            transition: transform 0.2s;
        }

        .card:hover {
            transform: scale(1.05);
        }

        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-bottom: 3px solid #ff6f61;
        }

        .card-body {
            padding: 1rem;
            background-color: #f0f9ff;
        }

        .card-body h3 {
            margin: 0 0 .5rem;
            font-family: 'Fredoka One', cursive;
            color: #ff6f61;
        }

        .card-body p {
            margin: .3rem 0;
            color: #333;
        }

        .stock {
            font-size: .9rem;
            margin-top: .5rem;
            font-weight: bold;
            color: #4caf50;
        }

        .btn {
            background: #ff6f61;
            color: white;
            border: none;
            padding: .5rem 1rem;
            cursor: pointer;
            border-radius: 20px;
            font-family: 'Comic Neue', cursive;
            transition: background 0.3s;
        }

        .btn:hover {
            background: #ff4081;
        }

        .btn:disabled {
            background: #ccc;
            cursor: not-allowed;
        }
    </style>
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100" style="display: flex; flex-direction: column;">
        {{-- Laravel navigation removed - using custom nav component in pages instead --}}

        {{-- Page Content --}}
        <main style="flex: 1;">
            @isset($slot)
                {{ $slot }}
            @else
                @yield('content')
            @endisset

            {{-- Chatbot Widget --}}
<div id="chatbot-button" onclick="toggleChatbot()">💬</div>

<div id="chatbot-box" style="display: none;">
  <div id="chatbot-header">
    Brivora Assistant
    <span onclick="toggleChatbot()" style="cursor:pointer;">✖</span>
  </div>

  <div id="chatbot-quick-actions">
    <button class="chatbot-quick" onclick="quickQuestion('browse products')">Browse Products</button>
    <button class="chatbot-quick" onclick="quickQuestion('check stock')">Check Stock</button>
    <button class="chatbot-quick" onclick="quickQuestion('returns help')">Returns Help</button>
    <button class="chatbot-quick" onclick="quickQuestion('contact support')">Contact Support</button>
  </div>

  <div id="chatbot-messages">
    <div class="bot-message">Hi! Ask me about products, stock, orders, or returns.</div>
  </div>

  <div id="chatbot-input-area">
    <input type="text" id="chatbot-input" placeholder="Type your question..." />
    <button onclick="sendMessage()">Send</button>
  </div>
</div>

<style>
#chatbot-button {
  position: fixed;
  bottom: 20px;
  right: 20px;
  background: #ff6f61;
  color: white;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  display: flex;
  justify-content: center;
  align-items: center;
  font-size: 28px;
  cursor: pointer;
  box-shadow: 0 4px 10px rgba(0,0,0,0.2);
  z-index: 1000;
}

#chatbot-box {
  position: fixed;
  bottom: 90px;
  right: 20px;
  width: 320px;
  height: 420px;
  background: white;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.2);
  overflow: hidden;
  z-index: 1000;
  font-family: Arial, sans-serif;
  display: flex;
  flex-direction: column;
}

#chatbot-header {
  background: #1477b5;
  color: white;
  padding: 12px 15px;
  font-weight: bold;
  display: flex;
  justify-content: space-between;
  align-items: center;
  flex-shrink: 0;
}

#chatbot-quick-actions {
  padding: 10px;
  background: white;
  border-bottom: 1px solid #ddd;
  flex-shrink: 0;
}

#chatbot-messages {
  height: 180px;
  overflow-y: auto;
  padding: 10px;
  background: #f9f9f9;
}

.bot-message, .user-message {
  margin: 8px 0;
  padding: 10px;
  border-radius: 10px;
  max-width: 85%;
}

.bot-message {
  background: #e3f2fd;
  color: #333;
  width: fit-content;
}

.user-message {
  background: #ff6f61;
  color: white;
  margin-left: auto;
  text-align: right;
  width: fit-content;
  max-width: 75%;
  display: block;
  padding: 10px 14px;
  border-radius: 18px;
}

#chatbot-input-area {
  display: flex;
  border-top: 1px solid #ddd;
  background: white;
  flex-shrink: 0;
}

#chatbot-input-area input {
  flex: 1;
  border: none;
  padding: 12px;
  outline: none;
}

#chatbot-input-area button {
  background: #ff6f61;
  color: white;
  border: none;
  padding: 12px 16px;
  cursor: pointer;
}

.chatbot-quick {
  background: white;
  border: 1.5px solid #1477b5;
  color: #1477b5;
  padding: 6px 10px;
  margin: 4px;
  border-radius: 10px;
  cursor: pointer;
  font-size: 12px;
  font-weight: 500;
}

.chatbot-quick:hover {
  background: #1477b5;
  color: white;
}
</style>

<script>
  function toggleChatbot() {
    const box = document.getElementById('chatbot-box');
    box.style.display = box.style.display === 'none' ? 'block' : 'none';
  }

 async function sendMessage() {
  const input = document.getElementById('chatbot-input');
  const messages = document.getElementById('chatbot-messages');
  const message = input.value.trim();

  if (!message) return;

  // Show user message
  messages.innerHTML += `<div class="user-message">${message}</div>`;
  input.value = '';
  messages.scrollTop = messages.scrollHeight;

  try {
    const response = await fetch("{{ route('chatbot.handle') }}", {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": "{{ csrf_token() }}"
      },
      body: JSON.stringify({ message: message })
    });

    const data = await response.json();

    // Show typing message
    messages.innerHTML += `<div class="bot-message" id="typing-message">Typing...</div>`;
    messages.scrollTop = messages.scrollHeight;

    setTimeout(() => {
      const typingMessage = document.getElementById('typing-message');
      if (typingMessage) {
        typingMessage.removeAttribute('id');
        typingMessage.innerHTML = data.reply;
      }
      messages.scrollTop = messages.scrollHeight;
    }, 700);

  } catch (error) {
    messages.innerHTML += `<div class="bot-message">Sorry, something went wrong.</div>`;
    messages.scrollTop = messages.scrollHeight;
  }
}

  function quickQuestion(text) {
    const input = document.getElementById('chatbot-input');
    input.value = text;
    sendMessage();
}
</script>
        </main>

        <x-footer />
    </div>
</body>

</html>