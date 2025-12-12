<?php
session_start();
// Jika sudah login, redirect ke halaman admin
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('location: admin/index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin | Dliya Wahyu Ramadhani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .login-container {
            min-height: 80vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            max-width: 450px;
            width: 100%;
        }
    </style>
</head>
<body>
    <div class="container content-wrap login-container">
        <div class="card custom-card login-card">
            <div class="card-body">
                <h3 class="card-title text-center mb-4">Admin Login</h3>
                <?php 
                if(isset($_GET['error'])){
                    echo '<div class="alert alert-danger" role="alert">Username atau password salah.</div>';
                }
                ?>
                <form action="proses_login.php" method="POST">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <footer class="mt-auto">
        <p>&copy; 2025 Dliya Wahyu Ramadhani.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
