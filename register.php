<?php
require_once 'config.php';
redirectIfLoggedIn();

$error_message = '';
$success_message = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = trim($_POST['first_name']);
    $last_name = trim($_POST['last_name']);
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    
    // Validation
    if (empty($first_name) || empty($last_name) || empty($username) || empty($email) || empty($password)) {
        $error_message = 'All fields are required.';
    } elseif ($password !== $confirm_password) {
        $error_message = 'Passwords do not match.';
    } elseif (strlen($password) < 6) {
        $error_message = 'Password must be at least 6 characters long.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = 'Please enter a valid email address.';
    } else {
        try {
            $pdo = getDBConnection();
            
            // Check if username or email already exists
            $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
            $stmt->execute([$username, $email]);
            
            if ($stmt->fetch()) {
                $error_message = 'Username or email already exists.';
            } else {
                // Insert new user
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, email, password) VALUES (?, ?, ?, ?, ?)");
                $stmt->execute([$first_name, $last_name, $username, $email, $hashed_password]);
                
                $success_message = 'Registration successful! You can now log in.';
            }
        } catch(PDOException $e) {
            $error_message = 'Registration failed. Please try again.';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="nl">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>The Vault - Register</title>

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
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 2rem;
    }

    .auth-container {
      background-color: var(--card-bg);
      border: 1px solid var(--card-border);
      border-radius: 10px;
      padding: 3rem;
      width: 100%;
      max-width: 500px;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
      transition: background-color 0.5s ease, border-color 0.5s ease;
    }

    .auth-title {
      font-family: 'Didot', serif;
      font-size: 2.5rem;
      font-weight: 700;
      text-align: center;
      margin-bottom: 2rem;
      color: var(--text-color);
      text-transform: uppercase;
      letter-spacing: 0.1em;
    }

    .form-group {
      margin-bottom: 1.5rem;
    }

    .form-label {
      display: block;
      margin-bottom: 0.5rem;
      font-weight: 500;
      text-transform: uppercase;
      letter-spacing: 0.05em;
      font-size: 0.9rem;
      color: var(--text-color);
    }

    .form-control {
      width: 100%;
      padding: 0.8rem 1rem;
      border: 1px solid var(--card-border);
      border-radius: 5px;
      font-size: 1rem;
      background-color: var(--bg-color);
      color: var(--text-color);
      transition: border-color 0.3s ease, background-color 0.5s ease;
    }

    .form-control:focus {
      outline: none;
      border-color: var(--accent-color);
    }

    .btn-primary {
      width: 100%;
      background-color: var(--button-primary-bg);
      color: var(--button-primary-text);
      border: none;
      padding: 0.8rem 2rem;
      font-size: 1rem;
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.1em;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease, transform 0.3s ease, box-shadow 0.3s ease;
      margin-top: 1rem;
    }

    .btn-primary:hover {
      background-color: var(--button-primary-hover-bg);
      transform: translateY(-2px);
      box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    }

    body.dark .btn-primary {
      color: #121212;
    }

    .alert {
      padding: 1rem;
      margin-bottom: 1rem;
      border-radius: 5px;
      font-weight: 500;
    }

    .alert-danger {
      background-color: #f8d7da;
      color: #721c24;
      border: 1px solid #f5c6cb;
    }

    .alert-success {
      background-color: #d4edda;
      color: #155724;
      border: 1px solid #c3e6cb;
    }

    body.dark .alert-danger {
      background-color: #2c1618;
      color: #f5c6cb;
      border-color: #721c24;
    }

    body.dark .alert-success {
      background-color: #0f2419;
      color: #c3e6cb;
      border-color: #155724;
    }

    .auth-link {
      text-align: center;
      margin-top: 1.5rem;
    }

    .auth-link a {
      color: var(--accent-color);
      text-decoration: none;
      font-weight: 500;
      transition: color 0.3s ease;
    }

    .auth-link a:hover {
      color: var(--accent-hover);
      text-decoration: underline;
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
      .auth-container {
        padding: 2rem;
        margin: 1rem;
      }
      .auth-title {
        font-size: 2rem;
      }
    }
  </style>
</head>
<body>
  <header>
    <div class="logo">The Vault</div>
    <nav>
      <a href="auto's/autos.html">Auto's</a>
      <a href="login.php">Login</a>
      <button id="theme-toggle">Dark</button>
    </nav>
  </header>

  <div class="content-wrapper">
    <div class="auth-container">
      <h1 class="auth-title">Register</h1>
      
      <?php if ($error_message): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error_message); ?></div>
      <?php endif; ?>
      
      <?php if ($success_message): ?>
        <div class="alert alert-success"><?php echo htmlspecialchars($success_message); ?></div>
      <?php endif; ?>

      <form method="POST" action="">
        <div class="form-group">
          <label for="first_name" class="form-label">First Name</label>
          <input type="text" class="form-control" id="first_name" name="first_name" 
                 value="<?php echo isset($_POST['first_name']) ? htmlspecialchars($_POST['first_name']) : ''; ?>" required>
        </div>

        <div class="form-group">
          <label for="last_name" class="form-label">Last Name</label>
          <input type="text" class="form-control" id="last_name" name="last_name" 
                 value="<?php echo isset($_POST['last_name']) ? htmlspecialchars($_POST['last_name']) : ''; ?>" required>
        </div>

        <div class="form-group">
          <label for="username" class="form-label">Username</label>
          <input type="text" class="form-control" id="username" name="username" 
                 value="<?php echo isset($_POST['username']) ? htmlspecialchars($_POST['username']) : ''; ?>" required>
        </div>

        <div class="form-group">
          <label for="email" class="form-label">Email</label>
          <input type="email" class="form-control" id="email" name="email" 
                 value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
        </div>

        <div class="form-group">
          <label for="password" class="form-label">Password</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="form-group">
          <label for="confirm_password" class="form-label">Confirm Password</label>
          <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
        </div>

        <button type="submit" class="btn-primary">Create Account</button>
      </form>

      <div class="auth-link">
        Already have an account? <a href="login.php">Login here</a>
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