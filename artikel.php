<?php
include 'koneksi.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel | Dliya Wahyu Ramadhani</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
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

    <div class="container content-wrap">
        <div class="row">
            <div class="col-12 text-center" data-aos="fade-down">
                <h1 class="display-4 fw-bold mt-5">Kumpulan Artikel</h1>
                <p class="lead text-muted">Berikut adalah tulisan dan artikel yang telah saya buat.</p>
                <hr class="my-4">
            </div>
        </div>
        <div class="row gy-4">
            <?php
            $query = "SELECT * FROM articles ORDER BY created_at DESC";
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="col-md-6 col-lg-4" data-aos="fade-up">
                        <div class="card custom-card h-100">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['title']); ?></h5>
                                <p class="card-text text-muted"><small>Diposting pada: <?php echo date('d M Y', strtotime($row['created_at'])); ?></small></p>
                                <p class="card-text"><?php echo substr(strip_tags($row['content']), 0, 100); ?>...</p>
                                <a href="single-artikel.php?id=<?php echo $row['id']; ?>" class="btn btn-primary mt-auto align-self-start">Baca Selengkapnya</a>
                            </div>
                        </div>
                    </div>
            <?php
                }
            } else {
                echo '<div class="col-12 text-center"><p>Belum ada artikel yang dipublikasikan.</p></div>';
            }
            ?>
        </div>
    </div>

    <footer class="mt-5">
        <p>&copy; 2025 Dliya Wahyu Ramadhani.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="script.js"></script>
</body>
</html>
