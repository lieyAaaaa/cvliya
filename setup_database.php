<?php
include 'koneksi.php';

header('Content-Type: text/plain');

echo "Menjalankan setup database...\n\n";

// SQL untuk membuat tabel articles
$sql_articles = "CREATE TABLE articles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// SQL untuk membuat tabel users
$sql_users = "CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

// SQL untuk memasukkan user admin
$sql_insert_admin = "INSERT INTO `users` (`username`, `password`) VALUES ('admin', MD5('admin123'));";

// Fungsi untuk menjalankan query dan memberikan feedback
function run_query($conn, $sql, $message) {
    if (mysqli_query($conn, $sql)) {
        echo "[SUCCESS] " . $message . "\n";
    } else {
        // Cek jika tabel sudah ada
        if (mysqli_errno($conn) == 1050) { // Error code for 'Table already exists'
            echo "[INFO] Tabel sudah ada, proses dilewati. (" . $message . ")\n";
        } else {
            echo "[ERROR] Gagal menjalankan query: " . $message . " - " . mysqli_error($conn) . "\n";
        }
    }
}

// Jalankan semua query
run_query($conn, $sql_articles, 'Membuat tabel articles');
run_query($conn, $sql_users, 'Membuat tabel users');
run_query($conn, $sql_insert_admin, 'Menambahkan user admin');

echo "\nSetup selesai. Silakan coba akses website Anda lagi.\n";
echo "PENTING: Hapus file 'setup_database.php' ini dari server Anda sekarang juga demi keamanan.";

mysqli_close($conn);

?>
