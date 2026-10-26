<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Vault - Exclusieve Luxeproducten</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Didot&family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* CSS custom properties voor kleuren */
    :root {
      --bg-light: #f8f9fa;
      --bg-dark: #121212;
      --text-light: #111;
      --text-dark: #eee;
      --accent-light: #bfa14a;
      --accent-dark: #d4af37;
      --accent-hover-light: #9a7f36;
      --accent-hover-dark: #a5820a;
      --card-bg-light: #fff;
      --card-bg-dark: #1f1f1f;
      --border-light: #e9ecef;
      --border-dark: #333;
      --header-bg-light: #fff;
      --header-bg-dark: #1c1c1c;
      --header-border-light: #e0e0e0;
      --header-border-dark: #333;
      --footer-bg-light: #111;
      --footer-bg-dark: #1c1c1c;
      --footer-text-light: #ccc;
      --footer-text-dark: #ccc;
    }

    /* Dark mode kleuren */
    body.dark {
      --bg-color: #121212;
      --text-color: #eee;
      --accent-color: #d4af37;
      --accent-hover: #a5820a;
      --nav-link-color: #ddd;
      --nav-link-hover: var(--accent-color);
      --card-bg: #1f1f1f; /* Distinct dark card bg */
      --card-text: #bbb;
      --footer-bg: #1c1c1c; /* Match dark header */
      --footer-text: #888;
      --hero-overlay: rgba(0,0,0,0.4);
      --header-bg: #1c1c1c; /* Dark header bg */
      --header-border: #333; /* Dark header border */
    }
    html {
      height: 100%;
    }
    body {
      font-family: 'Montserrat', sans-serif;
      background-color: var(--bg-color);
      color: var(--text-color);
      margin: 0;
      padding: 0;
      transition: background-color 0.5s ease, color 0.5s ease;
      display: flex; 
      flex-direction: column; 
      min-height: 100vh;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem 4rem;
      background-color: var(--header-bg); /* Use variable */
      border-bottom: 1px solid var(--header-border); /* Use variable */
      position: sticky;
      top: 0;
      z-index: 1000;
      transition: background-color 0.5s ease, border-color 0.5s ease;
    }

    .logo {
      font-family: 'Didot', serif;
      font-size: 2.5rem;
      font-weight: 700;
      letter-spacing: 0.2em;
      color: inherit;
      user-select: none;
      text-transform: uppercase;
      cursor: default;
      transition: color 0.4s ease;
    }

    /* Navbar links */
    nav a {
      color: inherit;
      text-decoration: none;
      font-weight: 500;
      margin-left: 3rem;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      position: relative;
      transition: color 0.3s ease;
    }

    /* Link hover underline */
    nav a::after {
      content: '';
      position: absolute;
      width: 0%;
      height: 2px;
      bottom: -4px;
      left: 0;
      background-color: var(--accent-light);
      transition: width 0.3s ease;
    }
    nav a:hover::after {
      width: 100%;
    }
    body.dark nav a::after {
      background-color: var(--accent-dark);
    }

    /* Hover kleur link */
    nav a:hover {
      color: var(--accent-light);
    }
    body.dark nav a:hover {
      color: var(--accent-dark);
    }

    /* Dark mode toggle knop */
    #theme-toggle {
      background: none;
      border: 1px solid currentColor;
      color: inherit;
      padding: 0.5rem 0.8rem;
      margin-left: 3rem;
      font-size: 1rem;
      cursor: pointer;
      border-radius: 5px;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      transition: background-color 0.3s ease, color 0.3s ease;
      user-select: none;
    }
    #theme-toggle:hover {
      background-color: var(--accent-light);
      color: var(--bg-light);
      border-color: var(--accent-light);
    }
    body.dark #theme-toggle:hover {
      background-color: var(--accent-dark);
      color: var(--bg-dark);
      border-color: var(--accent-dark);
    }

    /* Hero */
    .hero {
      position: relative;
      height: 80vh;
      background: url('https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=1400&q=80') no-repeat center center/cover;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      color: var(--text-color);
      transition: color 0.5s ease;
    }
    .hero::after {
      content: "";
      position: absolute;
      inset: 0;
      background: var(--hero-overlay);
      mix-blend-mode: lighten;
      z-index: 1;
      transition: background 0.5s ease;
    }
    body.dark .hero::after {
      mix-blend-mode: normal;
    }
    .hero-content {
      position: relative;
      z-index: 2;
      max-width: 800px;
      padding: 0 2rem;
    }
    .hero-content h1 {
      font-family: 'Didot', serif;
      font-weight: 700;
      font-size: 4.5rem;
      line-height: 1.1;
      margin-bottom: 1rem;
      color: var(--text-color);
      transition: color 0.5s ease;
    }
    .hero-content p {
      font-size: 1.3rem;
      letter-spacing: 0.15em;
      color: var(--card-text);
      margin-bottom: 3rem;
      font-weight: 400;
      transition: color 0.5s ease;
    }
    .btn-primary {
      background-color: var(--accent-color);
      border: none;
      padding: 0.9rem 3rem;
      font-weight: 700;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.15em;
      color: #fff;
      transition: background-color 0.3s ease;
      border-radius: 0;
    }
    .btn-primary:hover {
      background-color: var(--accent-hover);
      color: #fff;
    }

    /* Product grid */
    section.products {
      max-width: 1200px;
      margin: 5rem auto 7rem;
      padding: 0 2rem;
    }
    section.products h2 {
      font-family: 'Didot', serif;
      font-weight: 700;
      font-size: 2.8rem;
      margin-bottom: 3rem;
      text-align: center;
      letter-spacing: 0.15em;
      color: var(--text-color);
      transition: color 0.5s ease;
    }
    .product-card {
      border: none;
      overflow: hidden;
      cursor: pointer;
      transition: transform 0.3s ease, background-color 0.5s ease;
      border-radius: 8px;
      background-color: var(--card-bg);
    }
    .product-card:hover {
      transform: scale(1.03);
      box-shadow: 0 20px 30px rgba(0,0,0,0.12);
    }
    .product-card img {
      width: 100%;
      height: 320px;
      object-fit: cover;
      transition: transform 0.5s ease;
    }
    .product-card:hover img {
      transform: scale(1.05);
    }
    .card-body {
      padding: 1rem 1rem 1.5rem;
      background-color: var(--card-bg);
      transition: background-color 0.5s ease;
    }
    .card-title {
      font-family: 'Didot', serif;
      font-weight: 700;
      font-size: 1.3rem;
      margin-bottom: 0.5rem;
      color: var(--text-color);
      transition: color 0.5s ease;
    }
    .card-text {
      font-size: 0.9rem;
      color: var(--card-text);
      margin-bottom: 1.2rem;
      transition: color 0.5s ease;
    }
    .btn-outline-primary {
      border: 1.5px solid var(--accent-color);
      color: var(--accent-color);
      padding: 0.5rem 1.5rem;
      font-weight: 700;
      letter-spacing: 0.1em;
      border-radius: 0;
      transition: background-color 0.3s ease, color 0.3s ease;
      text-transform: uppercase;
    }
    .btn-outline-primary:hover {
      background-color: var(--accent-color);
      color: #fff;
    }

    /* Footer */
    footer {
      background-color: var(--footer-bg);
      color: var(--footer-text);
      text-align: center;
      padding: 2rem 1rem;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
      user-select: none;
      transition: background-color 0.5s ease, color 0.5s ease;
    }

    /* Responsive tweaks */
    @media (max-width: 768px) {
      .hero-content h1 {
        font-size: 2.8rem;
      }
      .product-card img {
        height: 220px;
      }
      header {
        padding: 1rem 2rem;
      }
    }

    /* Toggle switch styling */
    .switch {
      position: relative;
      display: inline-block;
      width: 46px;
      height: 24px;
    }
    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }
    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      transition: 0.4s;
      border-radius: 34px;
    }
    .slider:before {
      position: absolute;
      content: "";
      height: 18px;
      width: 18px;
      left: 3px;
      bottom: 3px;
      background-color: white;
      transition: 0.4s;
      border-radius: 50%;
    }
    input:checked + .slider {
      background-color: var(--accent-color);
    }
    input:checked + .slider:before {
      transform: translateX(22px);
    }

    /* Hamburger Menu Styles */
    .nav-toggle {
        display: none; 
        background: transparent;
        border: none;
        cursor: pointer;
        padding: 0.5rem;
        z-index: 1001;
    }
    .hamburger {
        display: block;
        position: relative;
        width: 25px;
        height: 3px;
        background-color: var(--text-light);
        transition: all 0.3s ease-in-out;
    }
    body.dark .hamburger {
        background-color: var(--text-dark);
    }
    .hamburger::before,
    .hamburger::after {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--text-light);
        transition: all 0.3s ease-in-out;
    }
    body.dark .hamburger::before,
    body.dark .hamburger::after {
        background-color: var(--text-dark);
    }
    .hamburger::before {
        top: -8px;
    }
    .hamburger::after {
        bottom: -8px;
    }
    .nav-toggle.active .hamburger {
        background-color: transparent;
    }
    .nav-toggle.active .hamburger::before {
        transform: translateY(8px) rotate(45deg);
    }
    .nav-toggle.active .hamburger::after {
        transform: translateY(-8px) rotate(-45deg);
    }
    .nav-links-container {
        display: flex;
        align-items: center;
    }

    /* Responsive tweaks - Combined and enhanced */
    @media (max-width: 1024px) { /* Tablet */
        header {
            padding: 1rem 2rem;
        }
        .logo {
            font-size: 2.2rem;
        }
        .nav-links-container a {
            margin-left: 2rem;
            font-size: 0.9rem;
        }
        .nav-links-container #theme-toggle {
            margin-left: 2rem;
            font-size: 0.9rem;
        }
        .hero {
            height: 70vh;
        }
        .hero-content h1 {
            font-size: 3.5rem;
        }
        .hero-content p {
            font-size: 1.1rem;
        }
        section.products h2 {
            font-size: 2.5rem;
        }
    }

    @media (max-width: 768px) { /* Smaller Tablets / Large Phones - Hamburger appears */
        .nav-toggle {
            display: block;
        }
        header {
            justify-content: space-between;
            align-items: center;
        }
        .nav-links-container {
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background-color: var(--header-bg); /* Uses updated var */
            flex-direction: column;
            align-items: center;
            padding: 1rem 0;
            border-top: 1px solid var(--header-border);
            transform: translateY(-150%);
            transition: transform 0.3s ease-in-out, opacity 0.3s ease-in-out;
            opacity: 0;
            pointer-events: none;
            z-index: 1000;
        }
        .nav-links-container.active {
            transform: translateY(0);
            opacity: 1;
            pointer-events: auto;
        }
        .nav-links-container a {
            margin: 1rem 0;
            font-size: 1.1rem;
        }
        .nav-links-container #theme-toggle {
            margin: 1rem 0;
        }

        .hero-content h1 {
          font-size: 2.8rem; /* Already present, kept for clarity */
        }
        .hero-content p {
            font-size: 1rem;
            margin-bottom: 2rem;
        }
        .btn-primary {
            padding: 0.8rem 2.5rem;
            font-size: 0.9rem;
        }
        section.products {
            margin: 3rem auto 5rem;
            padding: 0 1rem;
        }
        section.products h2 {
            font-size: 2rem;
            margin-bottom: 2rem;
        }
        .product-card img {
          height: 220px; /* Already present, kept for clarity */
        }
        .col-md-4 {
            flex: 0 0 100%; /* Stack product cards */
            max-width: 100%;
        }
    }

    @media (max-width: 480px) { /* Mobile phones */
        header {
            padding: 1rem 1rem;
            /* flex-direction: row; is default and set by 768px for space-between */
        }
        .logo {
            font-size: 1.8rem; 
        }
        .hero {
            height: 60vh;
        }
        .hero-content h1 {
            font-size: 2.2rem;
        }
        .hero-content p {
            font-size: 0.9rem;
            letter-spacing: 0.1em;
        }
        section.products {
            margin: 2rem auto 4rem;
        }
        section.products h2 {
            font-size: 1.8rem;
        }
        .product-card img {
            height: 200px;
        }
        .card-title {
            font-size: 1.1rem;
        }
        .card-text {
            font-size: 0.85rem;
        }
        .btn-outline-primary {
            padding: 0.4rem 1.2rem;
            font-size: 0.9rem;
        }
    }

    /* Chatbot Styles */
    #chatbot-toggle {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: var(--accent-color);
      color: white;
      border: none;
      border-radius: 50%;
      width: 60px;
      height: 60px;
      font-size: 24px;
      display: flex;
      justify-content: center;
      align-items: center;
      cursor: pointer;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      z-index: 1001;
      transition: background-color 0.3s ease;
    }
    #chatbot-toggle:hover {
      background-color: var(--accent-hover);
    }
    #chatbot-container {
      position: fixed;
      bottom: 90px;
      right: 20px;
      width: 320px;
      max-height: 450px;
      background-color: var(--card-bg);
      border: 1px solid var(--header-border);
      border-radius: 10px;
      box-shadow: 0 5px 15px rgba(0,0,0,0.15);
      display: none; /* Hidden by default */
      flex-direction: column;
      z-index: 1000;
      overflow: hidden;
    }
    #chatbot-container.active {
      display: flex;
    }
    .chatbot-header {
      background-color: var(--header-bg);
      color: var(--text-color);
      padding: 10px 15px;
      border-bottom: 1px solid var(--header-border);
      font-weight: bold;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }
    #close-chatbot {
        background: none;
        border: none;
        color: var(--text-color);
        font-size: 20px;
        cursor: pointer;
    }
    .chatbot-messages {
      flex-grow: 1;
      padding: 15px;
      overflow-y: auto;
      display: flex;
      flex-direction: column;
      gap: 10px;
    }
    .chat-message {
      padding: 8px 12px;
      border-radius: 15px;
      max-width: 80%;
      word-wrap: break-word;
      font-size: 0.9rem;
    }
    .chat-message.user {
      background-color: var(--accent-color);
      color: white;
      align-self: flex-end;
      border-bottom-right-radius: 5px;
    }
    .chat-message.bot {
      background-color: var(--bg-color);
      color: var(--text-color);
      border: 1px solid var(--header-border);
      align-self: flex-start;
      border-bottom-left-radius: 5px;
      display: flex;
      align-items: flex-start;
      gap: 8px;
    }
    .chat-message.bot .bot-icon {
        font-size: 1.2rem;
        line-height: 1.3;
    }
    .chatbot-input {
      display: flex;
      border-top: 1px solid var(--header-border);
      padding: 10px;
    }
    .chatbot-input input {
      flex-grow: 1;
      border: 1px solid var(--header-border);
      padding: 8px 10px;
      border-radius: 20px;
      margin-right: 8px;
      background-color: var(--bg-color);
      color: var(--text-color);
    }
    .chatbot-input button {
      background-color: var(--accent-color);
      color: white;
      border: none;
      border-radius: 20px;
      padding: 8px 15px;
      cursor: pointer;
      font-weight: bold;
    }
    .chatbot-input button:hover {
      background-color: var(--accent-hover);
    }
  </style>
</head>
<body>

  <header>
    <div class="logo">THE VAULT</div>
    <button class="nav-toggle" aria-label="toggle navigation">
      <span class="hamburger"></span>
    </button>
    <nav class="nav-links-container">
      <a href="categorieën.php">Categorieën</a>
      <a href="berichten.php">Berichten</a>
      <?php require_once '../config.php'; if (function_exists('isLoggedIn') && isLoggedIn()): ?>
        <a href="../dashboard.php" title="Account"><img src="../images/user.png" alt="Account" style="height:1.5em;width:1.5em;vertical-align:middle;border-radius:50%;object-fit:cover;" /></a>
      <?php else: ?>
        <a href="../login.php">Login</a>
      <?php endif; ?>
      <button id="theme-toggle" aria-label="Toggle dark mode">🌙</button>
    </nav>
  </header>

<main class="content-wrapper">
  <section class="hero">
    <div class="hero-content">
      <h1>Exclusieve Luxeproducten<br>voor de Elite</h1>
      <p>Ontdek de meest exclusieve villa\'s, horloges, auto\'s en meer</p>
      <a href="categorieën.php" class="btn btn-primary">Bekijk aanbod</a>
    </div>
  </section>

  <section class="products container">
    <h2>Uitgelichte Producten</h2>
    <div class="row g-4">
      <div class="col-md-4">
        <div class="card product-card">
          <img src="../images1/boot1.jpg" alt="Luxe villa" />
          <div class="card-body">
            <h5 class="card-title">Luxe Jacht "Serenity"</h5>
            <p class="card-text">Ervaar ongeëvenaarde luxe en vrijheid op open water.</p>
          </div>
          <div class="card-footer bg-transparent border-top-0">
            <div class="d-flex justify-content-between align-items-center">
              <span class="price text-accent">€POA</span>
              <a href="../jachten/jachten.php" class="btn btn-outline-primary">Bekijk</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card product-card">
          <img src="../images/Watch6.jpg" alt="Horloge" />
          <div class="card-body">
            <h5 class="card-title">Horloge Limited Edition</h5>
            <p class="card-text">Diamanten details, exclusief design en ultieme luxe.</p>
            <div class="card-footer bg-transparent border-top-0">
              <div class="d-flex justify-content-between align-items-center">
                <span class="price text-accent">€POA</span>
                <a href="../horloge/horloges.php" class="btn btn-outline-primary">Bekijk</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="card product-card">
          <img src="../images/auto's/uruscar1.jpg" alt="Luxe auto" />
          <div class="card-body">
            <h5 class="card-title">lamborghini Urus</h5>
            <p class="card-text">High-performance, exclusief en futuristisch design.</p>
            <div class="card-footer bg-transparent border-top-0">
              <div class="d-flex justify-content-between align-items-center">
                <span class="price text-accent">€POA</span>
                <a href="../auto's/autos.php" class="btn btn-outline-primary">Bekijk</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <footer>
    &copy; 2025 The Vault — Alle rechten voorbehouden.
  </footer>
</main>

<!-- Chatbot HTML -->
<button id="chatbot-toggle" aria-label="Open chatbot">💬</button>
<div id="chatbot-container">
  <div class="chatbot-header">
    <span>Chat met The Vault</span>
    <button id="close-chatbot" aria-label="Close chatbot">&times;</button>
  </div>
  <div class="chatbot-messages" id="chatbot-messages">
    <!-- Bot welcome message -->
    <div class="chat-message bot">Hallo! Hoe kan ik u helpen?</div>
  </div>
  <div class="chatbot-input">
    <input type="text" id="chatbot-user-input" placeholder="Stel een vraag...">
    <button id="chatbot-send-btn">Stuur</button>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Speel video af als muis erop komt, pauzeer als muis weggaat
  document.querySelectorAll('.category-card').forEach(card => {
    const video = card.querySelector('video');
    card.addEventListener('mouseenter', () => {
      if (video) { // Check if video exists
        video.currentTime = 0;
        video.play();
      }
    });
    card.addEventListener('mouseleave', () => {
      if (video) { // Check if video exists
        video.pause();
        video.currentTime = 0;
      }
    });
  });

  // Dark Mode Toggle Script (from categorieën.php)
  const themeToggle = document.getElementById('theme-toggle');
  const currentTheme = localStorage.getItem('theme');

  if (currentTheme) {
    document.body.classList.add(currentTheme);
    if (currentTheme === 'dark') {
        themeToggle.textContent = '☀️'; 
    } else {
        themeToggle.textContent = '🌙'; 
    }
  } else {
    themeToggle.textContent = '🌙';
  }

  themeToggle.addEventListener('click', () => {
    document.body.classList.toggle('dark');
    let theme = 'light';
    if (document.body.classList.contains('dark')) {
      theme = 'dark';
      themeToggle.textContent = '☀️'; 
    } else {
      themeToggle.textContent = '🌙'; 
    }
    localStorage.setItem('theme', theme);
  });

  // Hamburger Menu Toggle Script
  const navToggle = document.querySelector('.nav-toggle');
  const navLinksContainer = document.querySelector('.nav-links-container');

  if (navToggle && navLinksContainer) {
    navToggle.addEventListener('click', () => {
      navToggle.classList.toggle('active');
      navLinksContainer.classList.toggle('active');
    });
  }

  // Chatbot Script
  const chatbotToggle = document.getElementById('chatbot-toggle');
  const chatbotContainer = document.getElementById('chatbot-container');
  const closeChatbotBtn = document.getElementById('close-chatbot');
  const chatbotMessages = document.getElementById('chatbot-messages');
  const chatbotUserInput = document.getElementById('chatbot-user-input');
  const chatbotSendBtn = document.getElementById('chatbot-send-btn');

  const predefinedQA = {
    "waar kan ik spullen kopen?": "U kunt items bekijken en kopen op onze <a href='categorieën.php'>Categorieën</a> pagina. Veel winkelplezier!",
    "hoe kan ik iets verkopen?": "Momenteel is de functionaliteit om zelf items te verkopen nog in ontwikkeling. Houd onze updates in de gaten!",
    "wat voor soort producten zijn er?": "Wij bieden een breed scala aan luxe producten, waaronder exclusieve auto's, horloges en jachten. Neem een kijkje op de <a href='categorieën.php'>Categorieën</a> pagina voor het volledige aanbod.",
    "is er een klantenservice?": "Zeker! Voor specifieke vragen kunt u contact opnemen via het (denkbeeldige) contactformulier of een e-mail sturen naar info@thevault.example.com.",
    "hoe werkt de website?": "The Vault is een exclusieve online marktplaats. U kunt door categorieën bladeren om items te ontdekken en te kopen. Voor verkopen, zie de eerdere vraag.",
    "openingstijden": "Wij zijn een online winkel en dus 24/7 bereikbaar!",
    "contact": "U kunt ons bereiken via het (fictieve) contactformulier op de website of via info@thevault.example.com."
    // Add more Q&A pairs here
  };

  chatbotToggle.addEventListener('click', () => {
    chatbotContainer.classList.toggle('active');
    if (chatbotContainer.classList.contains('active')) chatbotUserInput.focus();
  });

  closeChatbotBtn.addEventListener('click', () => {
    chatbotContainer.classList.remove('active');
  });

  function addMessageToChat(message, sender) {
    const messageDiv = document.createElement('div');
    messageDiv.classList.add('chat-message', sender);

    if (sender === 'bot') {
      messageDiv.innerHTML = `<span class="bot-icon">🤖</span><span>${message}</span>`;
    } else {
      messageDiv.innerHTML = message; // User messages don't get an icon
    }
    
    chatbotMessages.appendChild(messageDiv);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight; // Scroll to bottom
  }

  function getBotResponse(userInput) {
    userInput = userInput.toLowerCase().trim();
    let bestMatch = null;
    let highestMatchScore = 0;

    for (const question in predefinedQA) {
        // Simple keyword matching: count how many words from the question appear in the input
        const keywords = question.toLowerCase().split(" ");
        let currentScore = 0;
        keywords.forEach(keyword => {
            if (userInput.includes(keyword)) {
                currentScore++;
            }
        });

        if (currentScore > highestMatchScore) {
            highestMatchScore = currentScore;
            bestMatch = predefinedQA[question];
        }
    }
    return bestMatch || "Sorry, dat begreep ik niet helemaal. Kunt u uw vraag anders formuleren? Of probeer een van de veelgestelde vragen.";
  }

 chatbotSendBtn.addEventListener('click', () => {
    const userInput = chatbotUserInput.value;
    if (userInput.trim() === '') return;

    addMessageToChat(userInput, 'user');
    const botResponse = getBotResponse(userInput);
    
    setTimeout(() => { // Simulate bot thinking time
        addMessageToChat(botResponse, 'bot');
    }, 500);

    chatbotUserInput.value = ''; // Clear input field
  });

  chatbotUserInput.addEventListener('keypress', (event) => {
    if (event.key === 'Enter') {
      chatbotSendBtn.click();
    }
  });
</script>

</body>
</html>
