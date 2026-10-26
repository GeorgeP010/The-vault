<?php
require_once 'config.php';
requireLogin();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Vault - Dashboard</title>

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Didot&family=Montserrat:wght@400;700&display=swap" rel="stylesheet" />

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />

  <style>
    /* Same CSS variables as other pages */
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

    .content-wrapper {
      flex-grow: 1; 
      padding: 3rem 2rem;
      max-width: 1200px;
      margin: 0 auto;
      width: 100%;
    }

    .welcome-section {
      text-align: center;
      margin-bottom: 3rem;
    }

    .welcome-title {
      font-family: 'Didot', serif;
      font-size: 3rem;
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .welcome-subtitle {
      font-size: 1.2rem;
      color: var(--text-color);
      opacity: 0.8;
      margin-bottom: 2rem;
    }

    .dashboard-cards {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
      gap: 2rem;
      margin-bottom: 3rem;
    }

    .dashboard-card {
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 2rem;
      text-align: center;
      transition: background-color 0.5s ease, border-color 0.5s ease, transform 0.3s ease;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .dashboard-card:hover {
      transform: translateY(-5px);
    }

    .card-title {
      font-family: 'Didot', serif;
      font-size: 1.5rem;
      font-weight: 700;
      color: var(--text-color);
      margin-bottom: 1rem;
      text-transform: uppercase;
      letter-spacing: 0.05em;
    }

    .card-text {
      color: var(--text-color);
      opacity: 0.8;
      margin-bottom: 1.5rem;
    }

    .btn-outline {
      background: none;
      border: 2px solid var(--accent-color);
      color: var(--accent-color);
      padding: 0.6rem 1.5rem;
      font-size: 0.9rem;
      font-weight: 600;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, color 0.3s ease;
      text-decoration: none;
      display: inline-block;
    }

    .btn-outline:hover {
      background-color: var(--accent-color);
      color: #fff;
    }

    body.dark .btn-outline:hover {
      color: #121212;
    }

    footer {
      background-color: var(--footer-bg);
      color: var(--footer-text);
      text-align: center;
      padding: 2rem 1rem;
      font-size: 0.9rem;
      letter-spacing: 0.05em;
      transition: background-color 0.5s ease;
    }

    /* Responsive */
    @media (max-width: 768px) {
      header {
        padding: 1rem 2rem;
      }
      .logo {
        font-size: 2rem;
      }
      nav a {
        margin-left: 1.5rem;
        font-size: 0.9rem;
      }
      #theme-toggle {
        margin-left: 1.5rem;
        font-size: 0.9rem;
        padding: 0.4rem 0.6rem;
      }
      .welcome-title {
        font-size: 2rem;
      }
      .content-wrapper {
        padding: 2rem 1rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <a href="../Rest/index.php" class="logo">The Vault</a>
    <nav>
      <a href="Rest/categorieën.php">Catagories</a>
      <a href="logout.php">Logout</a>
      <button id="theme-toggle">Dark</button>
    </nav>
  </header>

  <div class="content-wrapper">
    <div class="welcome-section">
      <h1 class="welcome-title">Welcome Back</h1>
      <p class="welcome-subtitle">
        Hello, <?php echo htmlspecialchars($_SESSION['first_name'] . ' ' . $_SESSION['last_name']); ?>! 
        Welcome to your exclusive Vault dashboard.
      </p>
    </div>

    <div class="dashboard-cards">
      <div class="dashboard-card">
        <h3 class="card-title">Categories</h3>
        <p class="card-text">Explore our exclusive collection of premium vehicles including Porsche, Lamborghini, and Bugatti.</p>
        <a href="../Rest/categorieën.php" class="btn-outline">View Categories</a>
      </div>

      <div class="dashboard-card">
        <h3 class="card-title">Your Profile</h3>
        <p class="card-text">Manage your account settings and personal information in your secure profile area.</p>
        <a href="#" class="btn-outline">Edit Profile</a>
      </div>

      <div class="dashboard-card">
        <h3 class="card-title">Exclusive Access</h3>
        <p class="card-text">As a member of The Vault, you have access to exclusive content and premium features.</p>
        <a href="#" class="btn-outline">Explore More</a>
      </div>
    </div>
  </div>

  <footer>
    <p>&copy; 2024 The Vault. All rights reserved.</p>
  </footer>

  <script>
    // Theme toggle functionality
    const themeToggle = document.getElementById('theme-toggle');
    const body = document.body;
    
    // Check for saved theme preference
    if (localStorage.getItem('theme') === 'dark') {
      body.classList.add('dark');
      themeToggle.textContent = 'Light';
    }
    
    themeToggle.addEventListener('click', () => {
      body.classList.toggle('dark');
      
      if (body.classList.contains('dark')) {
        themeToggle.textContent = 'Light';
        localStorage.setItem('theme', 'dark');
      } else {
        themeToggle.textContent = 'Dark';
        localStorage.setItem('theme', 'light');
      }
    });
  </script>
</body>
</html> 