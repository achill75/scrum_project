<?php
session_start();
include 'includes/db_conn.php';


$error = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Validasi input
    if (empty($username) || empty($password)) {
        $error = "Username dan Password wajib diisi!";
    } else {
        // Query untuk memeriksa user
        $sql = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            // Set sesi pengguna
            $_SESSION['username'] = $row['username'];
            $_SESSION['role'] = $row['role'];

            // Redirect berdasarkan role
            header("Location: index.php");
              exit();

        } else {
            $error = "Username atau Password salah!";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('asset/img1.jpg') no-repeat center center fixed;
            background-size: cover;
            font-family: Arial, sans-serif;
            color: #fff;
        }

        .login-container {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.5);
            width: 350px;
        }

        .login-container h3 {
            font-weight: 700;
            color: #fff;
            text-align: center;
        }

        .login-container input[type="text"], 
        .login-container input[type="password"] {
            background-color: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: #fff;
            border-radius: 5px;
        }

        .login-container input::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .login-container button {
            background-color: #007bff;
            border: none;
            color: white;
            padding: 10px;
            width: 100%;
            border-radius: 5px;
            font-weight: bold;
            margin-top: 10px;
        }

        .login-container button:hover {
            background-color: #0056b3;
        }

        .footer {
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 10px;
        }

        .footer a {
            color: #fff;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="login-container">
            <h3>Login</h3>
            <form action="login.php" method="post">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter your username" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                </div>
                <button type="submit" name="submit" class="btn">Login</button>
            </form>
            <div class="footer">
                <p>Belum punya akun? <a href="./admin/add-new.php">Register</a></p>
                <p>Login Admin <a href="./admin/login-admin.php">Klik</a></p>
            </div>
        </div>
    </div>
</body>
</html>

