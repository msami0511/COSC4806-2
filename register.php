<?php
require_once('database.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (strlen($password) < 8) {
        die('Password must be at least 8 characters long.');
    }

    $dbh = db_connect();

    $stmt = $dbh->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        die('Username already exists.');
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = $dbh->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
    if ($insert->execute([$username, $hashedPassword])) {
        echo "Account created successfully!";
    } else {
        echo "Error creating account.";
         }
        } else {
            ?>
            <form method="post" action="register.php">
              Username: <input type="text" name="username" required><br>
              Password: <input type="password" name="password" required><br>
              <button type="submit">Register</button>
            </form>
        <?php
        }
        ?>
