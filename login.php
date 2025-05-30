<?php
require_once('database.php');


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $dbh = db_connect();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (password_verify($password, $user['password'])) {
            echo "Login successful! Welcome, " . htmlspecialchars($username) . ".";
        } else {
            echo "Incorrect password.";
        }
    } else {
        echo "Username not found.";
    }
} else {
    ?>
    <form method="post" action="login.php">
      Username: <input type="text" name="username" required><br>
      Password: <input type="password" name="password" required><br>
      <button type="submit">Login</button>
    </form>
    <p><a href="register.php">Register here</a></p>
    <?php
    }
    ?>
