<?php require_once '../config.php'; ?>
<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Vault - Auto's</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Didot&family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* Consistent CSS variables */
    :root {
      --bg-color: #f8f9fa; 
      --text-color: #111;
      --accent-color: #bfa14a;
      --accent-hover: #9a7f36;
      --header-bg: #fff; 
      --header-border: #e0e0e0;
      --footer-bg: #111;
      --footer-text: #ccc;
      --card-bg: #fff; 
      --card-border: #e9ecef;
      --button-primary-bg: var(--accent-color);
      --button-primary-text: #fff;
      --button-primary-hover-bg: var(--accent-hover);
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
      --card-bg: #1f1f1f; 
      --card-border: #333;
      --button-primary-bg: var(--accent-color);
      --button-primary-text: #121212; 
      --button-primary-hover-bg: var(--accent-hover);
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
      color: var(--text-color);
      cursor: default;
      user-select: none;
      text-transform: uppercase;
      transition: color 0.5s ease;
    }
    nav a {
      color: var(--text-color);
      text-decoration: none;
      font-weight: 500;
      margin-left: 3rem;
      font-size: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      transition: color 0.3s ease;
    }
    nav a:hover {
      color: var(--accent-color);
    }
    
    .content-wrapper {
      flex-grow: 1; 
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

    #theme-toggle {
      background: none;
      border: 1px solid var(--text-color);
      color: var(--text-color);
      padding: 0.5rem 0.8rem;
      margin-left: 3rem;
      font-size: 1rem; 
      cursor: pointer;
      border-radius: 5px;
      transition: background-color 0.3s ease, color 0.3s ease, border-color 0.3s ease;
      text-transform: uppercase; 
      letter-spacing: 0.1em;
    }
    #theme-toggle:hover {
      background-color: var(--accent-color);
      color: var(--bg-color); 
      border-color: var(--accent-color);
    }
    body.dark #theme-toggle {
      border-color: var(--text-color); 
      color: var(--text-color);
    }
    body.dark #theme-toggle:hover {
      background-color: var(--accent-color);
      color: #121212; 
      border-color: var(--accent-color);
    }

    /* Full-Screen Item Display Styles (generic for cars) */
    .full-screen-item-display {
      min-height: 90vh; 
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem; 
      box-sizing: border-box;
      position: relative; 
      overflow: hidden; 
      border-bottom: 1px solid var(--card-border); 
    }
    .full-screen-item-display:last-child {
        border-bottom: none; 
    }

    .full-screen-item-display:nth-child(even) .item-display-content {
      order: 2; 
    }
    .full-screen-item-display:nth-child(even) .item-display-image {
      order: 1; 
    }

    .item-display-content {
      flex: 1 1 45%; 
      padding: 2rem 3rem;
      display: flex;
      flex-direction: column;
      justify-content: center;
      text-align: left;
    }

    .item-display-content .item-display-name {
      font-family: 'Didot', serif;
      font-size: 4rem; 
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: 1rem;
      line-height: 1.1;
    }

    .item-display-content .item-display-tagline {
      font-family: 'Montserrat', sans-serif;
      font-size: 1.3rem;
      color: var(--text-color);
      opacity: 0.85;
      margin-bottom: 2rem;
      max-width: 450px; 
    }

    .item-display-content .btn-discover-more {
      font-family: 'Montserrat', sans-serif;
      color: var(--text-color);
      text-decoration: none;
      font-size: 1rem;
      font-weight: 500;
      letter-spacing: 0.05em;
      display: inline-block;
      border-bottom: 1px solid transparent; 
      transition: color 0.3s ease, border-color 0.3s ease;
      align-self: flex-start; 
    }

    .item-display-content .btn-discover-more:hover {
      color: var(--accent-color);
      border-bottom-color: var(--accent-color);
    }
    .item-display-content .btn-discover-more .arrow {
        margin-left: 0.5em;
        transition: transform 0.3s ease;
    }
    .item-display-content .btn-discover-more:hover .arrow {
        transform: translateX(5px);
    }
    
    .item-display-content .btn-add-to-cart-fs {
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
      text-decoration: none; 
      display: inline-block;
      margin-top: 1.5rem; 
      text-align: center;
    }

    .item-display-content .btn-add-to-cart-fs:hover {
      background-color: var(--button-primary-hover-bg);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }
    body.dark .item-display-content .btn-add-to-cart-fs {
        color: #121212; 
    }

    .item-display-image {
      flex: 1 1 55%; 
      height: 100%; 
      max-height: 70vh; 
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .item-display-image img {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain; 
      display: block;
    }

    /* Specific background classes for items - can be customized */
    .item-1-bg, .item-2-bg, .item-3-bg {
       background-color: var(--bg-color);
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
        .item-display-content .item-display-name {
            font-size: 3rem;
        }
        .item-display-content .item-display-tagline {
            font-size: 1.1rem;
        }
        .full-screen-item-display {
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
        .full-screen-item-display {
            flex-direction: column;
            min-height: auto; /* Adjust height for stacked layout */
            padding: 2rem 1rem; /* Adjust padding */
        }
        .item-display-content,
        .item-display-image {
            flex: 1 1 100%; /* Take full width when stacked */
            text-align: center; /* Center text content */
            padding: 1rem;
        }
        .item-display-content .btn-discover-more,
        .item-display-content .btn-add-to-cart-fs {
            align-self: center; /* Center buttons */
        }
        .item-display-image {
            max-height: 50vh; /* Constrain image height */
            margin-top: 1rem;
        }
    }

    @media (max-width: 480px) { /* Mobile phones */
        header {
            padding: 1rem 1rem;
            flex-direction: row;
        }
        .logo {
            margin-bottom: 0;
            font-size: 1.8rem; /* Slightly smaller logo for mobile */
        }
        .item-display-content .item-display-name {
            font-size: 2.2rem;
        }
        .item-display-content .item-display-tagline {
            font-size: 1rem;
        }
        .item-display-content .btn-discover-more,
        .item-display-content .btn-add-to-cart-fs {
            font-size: 0.8rem;
            padding: 0.7rem 1.2rem;
        }
    }

    /* Scroll Animation Utilities */
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(30px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .animate-on-scroll.is-visible {
        opacity: 1;
        transform: translateY(0);
    }

  </style>
</head>
<body>

<header>
  <a href="../Rest/index.php" class="logo">THE VAULT</a>
  <button class="nav-toggle" aria-label="toggle navigation">
    <span class="hamburger"></span>
  </button>
  <nav class="nav-links-container">
    <a href="../Rest/index.php">Home</a>
    <a href="../Rest/categorieën.php">Categorieën</a>
    <a href="../horloge/horloges.php">Horloges</a>
    <a href="../jachten/jachten.php">Jachten</a>
    <?php if (function_exists('isLoggedIn') && isLoggedIn()): ?>
      <a href="../dashboard.php" title="Account"><img src="../images/user.png" alt="Account" style="height:1.5em;width:1.5em;vertical-align:middle;border-radius:50%;object-fit:cover;" /></a>
    <?php else: ?>
      <a href="../login.php">Login</a>
    <?php endif; ?>
    <button id="theme-toggle" aria-label="Toggle dark mode">🌙</button>
  </nav>
</header>

<main class="content-wrapper">

  <!-- Full Screen Car Display 1 -->
  <section class="full-screen-item-display item-1-bg animate-on-scroll">
    <div class="item-display-content">
      <h2 class="item-display-name">Porsche Taycan 4 Sedan Exterior</h2>
      <p class="item-display-tagline">Elegantie op de weg.</p>
      <a href="#" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
      <a href="porsche-taycan-detail.php" class="btn-add-to-cart-fs">Bekijk Meer</a>
    </div>
    <div class="item-display-image">
      <img src="../images/auto's/Main.jpg" alt="Luxe Sportwagen X">
    </div>
  </section>

  <!-- Full Screen Car Display 2 -->
  <section class="full-screen-item-display item-2-bg animate-on-scroll">
    <div class="item-display-content">
      <h2 class="item-display-name">Lamborghini Urus</h2>
      <p class="item-display-tagline">Comfort en technologie, perfect gecombineerd voor de moderne bestuurder.</p>
      <a href="#" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
      <a href="lamborghini-urus-detail.php" class="btn-add-to-cart-fs">Bekijk Meer</a>
    </div>
    <div class="item-display-image">
      <img src="../images/auto's/uruscar1.jpg" alt="Prestige Sedan Y">
    </div>
  </section>
  
  <!-- Full Screen Car Display 3 -->
  <section class="full-screen-item-display item-3-bg animate-on-scroll">
    <div class="item-display-content">
      <h2 class="item-display-name">Bugatti Chiron</h2>
      <p class="item-display-tagline">De ultieme samensmelting van kunst, vorm en techniek.</p>
      <a href="#" class="btn-discover-more">Ontdek meer <span class="arrow">&rsaquo;</span></a>
      <a href="bugatti-chiron-detail.php" class="btn-add-to-cart-fs">Bekijk Meer</a>
    </div>
    <div class="item-display-image">
      <img src="../images/auto's/bugatticar1.jpg" alt="Bugatti Chiron">
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

  // Hamburger Menu Toggle Script
  const navToggle = document.querySelector('.nav-toggle');
  const navLinksContainer = document.querySelector('.nav-links-container');

  if (navToggle && navLinksContainer) {
    navToggle.addEventListener('click', () => {
      navToggle.classList.toggle('active');
      navLinksContainer.classList.toggle('active');
    });
  }

  // Scroll Animation Script
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
  if (scrollElements.length > 0) { // Check if there are elements to animate
    handleScrollAnimation(); // Initial check
    window.addEventListener('scroll', () => {
      handleScrollAnimation();
    });
  }

</script>

</body>
</html> 