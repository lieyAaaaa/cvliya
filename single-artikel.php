<?php
include 'koneksi.php';

// Cek jika tidak ada id di URL
if (!isset($_GET['id'])) {
    header('Location: artikel.php');
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM articles WHERE id = ?";
$article = null;

if ($stmt = mysqli_prepare($conn, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    if (mysqli_num_rows($result) == 1) {
        $article = mysqli_fetch_assoc($result);
    } else {
        // Jika artikel tidak ditemukan, redirect ke halaman daftar artikel
        header('Location: artikel.php?status=notfound');
        exit();
    }
    mysqli_stmt_close($stmt);
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> | Dliya Wahyu Ramadhani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        .article-header-image {
            width: 100%;
            height: 400px;
            object-fit: cover;
            border-radius: 24px;
            margin-bottom: 2rem;
        }
        .article-content h1, .article-content h2, .article-content h3 {
            margin-top: 1.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
        }
        .article-content p {
            line-height: 1.8;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">Dliya Wahyu R.</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="index.html">About Me</a></li>
                    <li class="nav-item"><a class="nav-link" href="pengalaman.html">Pengalaman</a></li>
                    <li class="nav-item"><a class="nav-link" href="projek.html">Project</a></li>
                    <li class="nav-item"><a class="nav-link" href="skill.html">Skill</a></li>
                    <li class="nav-item"><a class="nav-link" href="kontak.html">Kontak</a></li>
                    <li class="nav-item"><a class="nav-link active" href="artikel.php">Artikel</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container content-wrap my-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php if ($article): ?>
                    <article>
                        <header class="mb-4">
                            <h1 class="display-5 fw-bold"><?php echo htmlspecialchars($article['title']); ?></h1>
                            <p class="text-muted">Diposting pada <?php echo date('d F Y', strtotime($article['created_at'])); ?></p>
                        </header>
                        
                        <?php if (!empty($article['image'])): ?>
                            <img src="uploads/<?php echo htmlspecialchars($article['image']); ?>" alt="<?php echo htmlspecialchars($article['title']); ?>" class="article-header-image">
                        <?php endif; ?>

                        <section class="article-content mt-4">
                            <?php echo $article['content']; // Konten dari TinyMCE sudah berupa HTML ?>
                        </section>
                    </article>
                <?php else: ?>
                    <div class="text-center">
                        <h2>Artikel tidak ditemukan.</h2>
                        <a href="artikel.php" class="btn btn-primary mt-3">Kembali ke Daftar Artikel</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <footer class="mt-5">
        <p>&copy; 2025 Dliya Wahyu Ramadhani.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
