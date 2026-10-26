<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Vault - Jachten</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Didot&family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* Copied from categorieën.html - CSS custom properties */
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
    body.dark {
      --bg-color: #121212;
      --text-color: #eee;
      --accent-color: #d4af37;
      --accent-hover: #a5820a;
      --header-bg: #1c1c1c;
      --header-border: #333;
      --footer-bg: #1c1c1c; 
      --footer-text: #ccc;
      --card-bg: #1f1f1f; /* For dark mode product cards */
      --card-border: #333;
      --button-primary-bg: var(--accent-color);
      --button-primary-text: #121212; /* Darker text on accent for dark mode button */
      --button-primary-hover-bg: var(--accent-hover);
    }
    html {
      height: 100%;
    }
    body {
      --bg-color: var(--bg-light);
      --text-color: var(--text-light);
      --accent-color: var(--accent-light);
      --accent-hover: var(--accent-hover-light);
      --header-bg: var(--header-bg-light);
      --header-border: var(--header-border-light);
      --footer-bg: var(--footer-bg-light);
      --footer-text: var(--footer-text-light);
      --card-bg: var(--card-bg-light);
      --card-border: var(--border-light);
      --button-primary-bg: var(--accent-color); /* This will now correctly use --accent-light */
      --button-primary-text: #FFFFFF; /* White text for light mode buttons on accent background */
      --button-primary-hover-bg: var(--accent-hover); /* This will now correctly use --accent-hover-light */

      font-family: 'Montserrat', sans-serif;
      background-color: var(--bg-color); /* This will now work */
      color: var(--text-color); /* This will now work */
      margin: 0;
      padding: 0;
      transition: background-color 0.5s ease, color 0.5s ease;
      display: flex; 
      flex-direction: column; 
      min-height: 100vh;
    }

    main.content-wrapper {
      flex-grow: 1;
    }

    header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding: 1.5rem 4rem;
      background-color: var(--header-bg);
      border-bottom: 1px solid var(--header-border);
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

    /* NEW Full-Screen Watch Display Styles */
    .full-screen-watch-display {
      min-height: 90vh; /* Adjust as needed, considering header height if sticky */
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem; /* General padding */
      box-sizing: border-box;
      position: relative; /* For potential absolute positioning of elements if needed */
      overflow: hidden; /* Prevent scrollbars if content slightly overflows due to padding */
      /* border-bottom: 1px solid var(--card-border); */ /* Replaced by new separator style */
    }
    /* .full-screen-watch-display:last-child { */ /* Commented out as it was for the old border style */
        /* border-bottom: none; */ 
    /* } */

    /* New Separator Style (Copied from horloges.html) */
    .full-screen-watch-display:not(:last-child)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);
        width: 60%; /* Width of the line */
        height: 1px;
        background-color: var(--card-border);
    }
    .full-screen-watch-display:not(:last-child)::before { /* Diamond shape */
        content: '\25C6'; /* Unicode for black diamond or use an SVG */
        position: absolute;
        bottom: -8px; /* Adjust to sit on the line */
        left: 50%;
        transform: translateX(-50%) rotate(45deg);
        font-size: 10px; /* Size of the diamond */
        color: var(--accent-color);
        background-color: var(--bg-color); /* To mask the line behind it */
        padding: 0 5px; /* Space around the diamond */
        z-index: 1; /* Ensure it's above the line */
    }
    /* END New Separator Style */

    /* Style for alternating sections if desired, e.g., text left / image right, then image left / text right */
    .full-screen-watch-display:nth-child(even) .watch-display-content {
      order: 2; /* Text on the right for even sections */
    }
    .full-screen-watch-display:nth-child(even) .watch-display-image {
      order: 1; /* Image on the left for even sections */
    }

    .watch-display-content {
      flex: 1 1 40%; /* Changed from 45% to 40% */
      padding: 2rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: left;
    }

    .watch-display-content .watch-display-name {
      font-family: 'Didot', serif;
      font-size: 4rem; /* Large, impactful name */
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: 1rem;
      line-height: 1.1;
    }

    .watch-display-content .watch-display-tagline {
      font-family: 'Montserrat', sans-serif;
      font-size: 1.3rem;
      color: var(--text-color);
      opacity: 0.85;
      margin-bottom: 2rem;
      max-width: 450px; /* Limit width of tagline */
    }

    .watch-display-content .btn-discover-more {
      font-family: 'Montserrat', sans-serif;
      color: var(--text-color);
      text-decoration: none;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      display: inline-block;
      border-bottom: 1px solid transparent; /* For hover effect */
      transition: color 0.3s ease, border-color 0.3s ease;
      align-self: flex-start; /* Align button to the start of the flex container */
    }

    .watch-display-content .btn-discover-more:hover {
      color: var(--accent-color);
      border-bottom-color: var(--accent-color);
    }
    .watch-display-content .btn-discover-more .arrow {
        margin-left: 0.5em;
        transition: transform 0.3s ease;
    }
    .watch-display-content .btn-discover-more:hover .arrow {
        transform: translateX(5px);
    }
    
    .watch-display-image {
      flex: 1 1 60%; /* Changed from 55% to 60% */
      height: 100%;
      display: flex;
      align-items: stretch;
      justify-content: stretch;
      overflow: hidden; /* Voorkom overloop */
    }

    .watch-display-image img {
      width: 100%;
      height: 100%;
      object-fit: cover; /* Vul de hele ruimte op zonder vervorming */
      display: block;
    }


    /* Specific background for each section for demo, can be image-based */
    .full-screen-watch-display.sky-dweller-bg {
      /* background: linear-gradient(rgba(0,0,0,0.05), rgba(0,0,0,0.05)), url('placeholder-bg.jpg'); */
      /* For now, just use body bg color */
       background-color: var(--bg-color);
    }
    .full-screen-watch-display.lady-datejust-bg {
       background-color: var(--bg-color); /* Or a different subtle shade if needed */
    }
    .full-screen-watch-display.land-dweller-bg {
       background-color: var(--bg-color);
    }
    /* Add similar bg classes for new watches if needed */
    .full-screen-watch-display.new-watch-1-bg {
       background-color: var(--bg-color);
    }
    .full-screen-watch-display.new-watch-2-bg {
       background-color: var(--bg-color);
    }
    .full-screen-watch-display.new-watch-3-bg {
       background-color: var(--bg-color);
    }

    /* New Add to Cart button style for full-screen display */
    .watch-display-content .btn-add-to-cart-fs {
      font-family: 'Montserrat', sans-serif;
      background-color: var(--button-primary-bg);
      color: var(--button-primary-text);
      border: none;
      padding: 0.8rem 2rem;
      font-size: 0.9rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
      text-decoration: none; /* Ensure it looks like a button if it's an <a> tag */
      display: inline-block;
      margin-top: 1.5rem; /* Space above this button */
      text-align: center;
    }

    .watch-display-content .btn-add-to-cart-fs:hover {
      background-color: var(--button-primary-hover-bg);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    body.dark .watch-display-content .btn-add-to-cart-fs {
        color: #121212; /* Consistent dark text on accent for dark mode button */
    }

    footer {
      background-color: var(--footer-bg);
      color: var(--footer-text);
      text-align: center;
      padding: 2rem 1rem;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
      user-select: none;
      transition: background-color 0.5s ease, color 0.5s ease;
      border-top: 1px solid transparent; 
    }
    body.dark footer {
        border-top: 1px solid var(--header-border); 
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
        background-color: var(--text-color);
        transition: all 0.3s ease-in-out;
    }
    .hamburger::before,
    .hamburger::after {
        content: '';
        position: absolute;
        left: 0;
        width: 100%;
        height: 3px;
        background-color: var(--text-color);
        transition: all 0.3s ease-in-out;
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

    /* Responsive adjustments */
    @media (max-width: 1024px) { /* Tablet and smaller */
        header {
            padding: 1rem 2rem;
        }
        .logo {
            font-size: 2rem;
        }
        .nav-links-container a {
            margin-left: 1.5rem;
            font-size: 0.9rem;
        }
        .nav-links-container #theme-toggle {
            margin-left: 1.5rem;
            font-size: 0.9rem;
        }
        .watch-display-content .watch-display-name { /* Assuming .watch-display classes are used for yachts too */
            font-size: 3rem; 
        }
        .watch-display-content .watch-display-tagline {
            font-size: 1.1rem; 
        }
        .full-screen-watch-display { /* Assuming .full-screen-watch-display is used for yachts */
            padding: 1.5rem; 
        }
    }

    @media (max-width: 768px) { /* Smaller tablets / Large phones - Hamburger appears */
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
            background-color: var(--header-bg);
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
        .full-screen-watch-display {
            flex-direction: column;
            min-height: auto; 
            padding: 2rem 1rem; 
        }
        .watch-display-content,
        .watch-display-image {
            flex: 1 1 100%; 
            text-align: center; 
            padding: 1rem;
        }
        .watch-display-content .btn-discover-more,
        .watch-display-content .btn-add-to-cart-fs {
            align-self: center; 
        }
        .watch-display-image {
            max-height: 70vh; /* Consistent with horloges.html adjustment */
            margin-top: 1rem;
            width: 100%; 
            display: flex; 
            align-items: stretch; 
            justify-content: stretch; 
        }
         .watch-display-image img {
            width: 100%; 
            height: 100%; 
            object-fit: cover; 
            object-position: center center; 
        }
    }

    @media (max-width: 480px) { /* Mobile phones */
        header {
            padding: 1rem 1rem;
            flex-direction: row;
        }
        .logo {
            margin-bottom: 0;
            font-size: 1.8rem; 
        }
        .watch-display-content .watch-display-name {
            font-size: 2.2rem;
        }
        .watch-display-content .watch-display-tagline {
            font-size: 1rem;
        }
        .watch-display-content .btn-discover-more,
        .watch-display-content .btn-add-to-cart-fs {
            font-size: 0.8rem;
            padding: 0.7rem 1.2rem;
        }
    }

    /* Scroll Animation Utilities (if adding scroll animations later) */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .animate-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

    /* NEW JACHTEN HERO SECTION STYLES (Corrected) */
    .video-hero-section-jachten {
      position: relative;
      height: 90vh; /* Ensure this is 90vh */
      width: 100%;
      overflow: hidden;
      display: flex;
      align-items: center;
      justify-content: center;
      text-align: center;
      color: #fff;
    }
    .video-hero-section-jachten video {
      position: absolute;
      top: 50%;
      left: 50%;
      min-width: 100%;
      min-height: 100%;
      width: auto;
      height: auto;
      z-index: -100;
      transform: translateX(-50%) translateY(-50%);
      object-fit: cover; /* Ensure this is present */
    }
    .video-hero-overlay-jachten {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(0, 0, 0, 0.5);
      z-index: 1;
    }
    .hero-content-jachten {
      position: relative;
      z-index: 2;
      padding: 20px;
    }
    .hero-content-jachten .subtitle-jachten {
      font-family: 'Montserrat', sans-serif;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 0.2em;
      text-transform: uppercase;
      color: rgba(255, 255, 255, 0.8);
      margin-bottom: 0.5rem;
    }
    .hero-content-jachten h1 {
      font-family: 'Didot', serif;
      font-size: 4.5rem;
      font-weight: bold;
      margin-bottom: 1.5rem;
      line-height: 1.1;
    }
    .hero-content-jachten .btn-discover-jachten {
      font-family: 'Montserrat', sans-serif;
      background-color: rgba(255, 255, 255, 0.2);
      color: #fff;
      padding: 0.8rem 2rem;
      border-radius: 30px;
      text-decoration: none;
      font-size: 0.9rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border: 1px solid rgba(255, 255, 255, 0.5);
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
    }
    .hero-content-jachten .btn-discover-jachten:hover {
      background-color: rgba(255, 255, 255, 0.9);
      color: #000;
      border-color: #fff;
    }
    /* END NEW JACHTEN HERO SECTION STYLES */

    /* NEW: Introductory Text Section Styles (Copied from horloges.html) */
    .intro-text-section {
        padding: 3rem 2rem;
        text-align: center;
        margin-bottom: 2rem; /* Space before the first yacht section */
        /* border-bottom: 1px solid var(--card-border); */ /* Optional separator */
        background-color: var(--bg-color); /* Match page background */
    }
    .intro-text-section .intro-heading {
        font-family: 'Didot', serif;
        font-size: 2.8rem;
        color: var(--text-color);
        margin-bottom: 1rem;
        font-weight: 700;
    }
    .intro-text-section .intro-paragraph {
        font-family: 'Montserrat', sans-serif;
        font-size: 1.1rem;
        color: var(--text-color);
        opacity: 0.85;
        max-width: 700px; /* Limit width of paragraph */
        margin: 0 auto 1.5rem auto; /* Center the paragraph and add bottom margin */
        line-height: 1.7;
    }
    /* END: Introductory Text Section Styles */

  </style>
</head>
<body>

  <header>
    <div class="logo">THE VAULT</div>
    <button class="nav-toggle" aria-label="toggle navigation">
      <span class="hamburger"></span>
    </button>
    <nav class="nav-links-container">
      <a href="../Rest/index.php">Home</a>
      <a href="../Rest/categorieën.php">Categorieën</a>
      <a href="../horloge/horloges.php">Horloges</a>
      <a href="../jachten/jachten.php">Jachten</a>
      <a href="../Rest/dashboard.php">Account</a>
      <button id="theme-toggle" aria-label="Toggle dark mode">🌙</button>
    </nav>
  </header>

  <!-- NEW HERO SECTION for Jachten (Corrected Structure) -->
  <section class="video-hero-section-jachten">
    <video autoplay loop muted playsinline>
      <source src="../Videos/yacht video.mp4" type="video/mp4">
      <source src="../Videos/yacht video.webm" type="video/webm">
      Your browser does not support the video tag.
    </video>
    <div class="video-hero-overlay-jachten"></div>
    <div class="hero-content-jachten">
      <p class="subtitle-jachten">DE COLLECTIE</p>
      <h1>Onze Jachten</h1>
      <a href="#jacht-collectie" class="btn-discover-jachten">ONTDEK DE COLLECTIE VAN 2025 ›</a>
    </div>
  </section>
  <!-- END NEW HERO SECTION for Jachten -->

  <!-- NEW: Introductory Text Section for Jachten -->
  <section class="intro-text-section">
    <h2 class="intro-heading">Exclusieve Elegantie, Ongeëvenaarde Vrijheid</h2>
    <p class="intro-paragraph">
      Ontdek een zorgvuldig samengestelde selectie van 's werelds meest verfijnde jachten. 
      Bij The Vault verenigen we traditie met innovatie, en bieden we iconische modellen 
      die de essentie van luxe en prestaties op het water belichamen.
    </p>
  </section>
  <!-- END: Introductory Text Section for Jachten -->

  <main class="container mt-5 content-wrapper" id="jacht-collectie">
    <!-- Full Screen Yacht Display 1: Sunseeker Manhattan 84 -->
    <section id="jacht-collectie" class="full-screen-watch-display sunseeker-manhattan-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2000 Sunseeker Manhattan 84 | 26m</h2>
        <p class="watch-display-tagline">Luxe en comfort gecombineerd met krachtige prestaties op zee.</p>
        <a href="./jacht-detail-sunseeker-manhattan-84.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot1.jpg" alt="Sunseeker Manhattan 84 jacht" />
      </div>
    </section>
  
    <!-- Full Screen Yacht Display 2: Tecnomar Lamborghini 63 -->
    <section class="full-screen-watch-display tecnomar-lamborghini-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2022 Tecnomar Lamborghini 63 | 20m</h2>
        <p class="watch-display-tagline">Exclusief design geïnspireerd op de snelheid en elegantie van Lamborghini.</p>
        <a href="./jacht-detail-tecnomar-lamborghini-63.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot2.jpg" alt="Tecnomar Lamborghini 63 jacht" />
      </div>
    </section>
    
    <!-- Full Screen Yacht Display 3: Sunseeker 116 Yacht -->
    <section class="full-screen-watch-display sunseeker-116-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2020 Sunseeker 116 Yacht | 35m</h2>
        <p class="watch-display-tagline">Een meesterwerk van luxe, ruimte en innovatie voor ultieme ontspanning.</p>
        <a href="./jacht-detail-sunseeker-116-yacht.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot3.jpg" alt="Sunseeker 116 Yacht" />
      </div>
    </section>
  
    <!-- Full Screen Yacht Display 4: Mangusta 108 -->
    <section class="full-screen-watch-display mangusta-108-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2003 Mangusta 108 | 33m</h2>
        <p class="watch-display-tagline">Krachtig en stijlvol, perfect voor avontuurlijke zeevaarders.</p>
        <a href="./jacht-detail-mangusta-108.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot4.jpg" alt="Mangusta 108 jacht" />
      </div>
    </section>
  
    <!-- Full Screen Yacht Display 5: Ada Yacht 50Z -->
    <section class="full-screen-watch-display ada-yacht-50z-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2025 Ada Yacht 50Z | 50m</h2>
        <p class="watch-display-tagline">Tijdloos elegant, een exclusief meesterwerk op het water.</p>
        <a href="./jacht-detail-ada-yacht-50z.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot5.jpg" alt="Ada Yacht 50Z" />
      </div>
    </section>
  
    <!-- Full Screen Yacht Display 6: Benetti 60 -->
    <section class="full-screen-watch-display benetti-60-bg animate-on-scroll">
      <div class="watch-display-content">
        <h2 class="watch-display-name">2011 Benetti 60 | 60m</h2>
        <p class="watch-display-tagline">Exclusiviteit, precisie en traditie in één majestueus jacht.</p>
        <a href="./jacht-detail-benetti-60.html" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
        <a href="../Rest/cart.html" class="btn-add-to-cart-fs">Toevoegen aan winkelwagen</a>
      </div>
      <div class="watch-display-image">
        <img src="../images1/boot6.jpg" alt="Benetti 60 jacht" />
      </div>
    </section>
  </main>
  

<footer>
  &copy; 2025 The Vault — Alle rechten voorbehouden.
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  // Dark Mode Toggle Script
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

  // Filter button active state (simple example)
  const filterButtons = document.querySelectorAll('.filter-bar .btn-filter');
  filterButtons.forEach(button => {
    button.addEventListener('click', () => {
      filterButtons.forEach(btn => btn.classList.remove('active'));
      button.classList.add('active');
      // Add actual filtering logic here in a real application
    });
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

  // Scroll Animation Script (can be used if you add .animate-on-scroll to sections)
  const scrollElements = document.querySelectorAll('.animate-on-scroll');
  const elementInView = (el, dividend = 1) => {
    const elementTop = el.getBoundingClientRect().top;
    return (
      elementTop <= (window.innerHeight || document.documentElement.clientHeight) / dividend
    );
  };
  const displayScrollElement = (element) => {
    element.classList.add('is-visible');
  };
  const handleScrollAnimation = () => {
    scrollElements.forEach((el) => {
      if (elementInView(el, 1.25)) { 
        displayScrollElement(el);
      }
    })
  };
  if (scrollElements.length > 0) {
    handleScrollAnimation(); // Initial check
    window.addEventListener('scroll', () => {
      handleScrollAnimation();
    });
  }

</script>

</body>
</html>
