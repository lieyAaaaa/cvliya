<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = md5($_POST['password']); // Menggunakan MD5 sesuai dengan user default yang disarankan

    $sql = "SELECT id, username FROM users WHERE username = ? AND password = ?";
    
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        
        if (mysqli_stmt_execute($stmt)) {
            mysqli_stmt_store_result($stmt);
            
            if (mysqli_stmt_num_rows($stmt) == 1) {
                mysqli_stmt_bind_result($stmt, $id, $username);
                if (mysqli_stmt_fetch($stmt)) {
                    // Password benar, mulai session baru
                    $_SESSION["loggedin"] = true;
                    $_SESSION["id"] = $id;
                    $_SESSION["username"] = $username;
                    
                    // Redirect ke halaman admin
                    header("location: admin/index.php");
                }
            } else {
                // Password salah, redirect ke halaman login dengan error
                header("location: login.php?error=1");
            }
        } else {
            echo "Oops! Terjadi kesalahan. Silakan coba lagi nanti.";
        }

        mysqli_stmt_close($stmt);
    }
    
    mysqli_close($conn);
} else {
    // Jika bukan metode POST, redirect ke login
    header("location: login.php");
    exit();
}
?>