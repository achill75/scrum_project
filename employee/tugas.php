<?php
include '../includes/db_conn.php'; // Koneksi ke database

// Ambil data tugas dari database
$queryTugas = "SELECT tugas.tugas_id, backlog.deskripsi AS backlog_deskripsi, users.username AS assigned_user, sprints.tanggal_mulai, sprints.tanggal_selesai, tugas.status 
               FROM tugas
               INNER JOIN backlog ON tugas.backlog_id = backlog.backlog_id
               INNER JOIN users ON tugas.ditugaskan_ke = users.user_id
               INNER JOIN sprints ON tugas.sprint_id = sprints.sprint_id";
$resultTugas = mysqli_query($conn, $queryTugas);

if (!$resultTugas) {
    die("Query Error: " . mysqli_error($conn));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="../css/style.css">

<title>Daftar Tugas</title>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary bg-warning">
  <div class="container">
    <a class="navbar-brand" href="#">Scrum Project</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav ms-auto">
      <a class="nav-link active" href="../index.php">Dashboard</a>
        <li class="nav-item"><a class="nav-link" href="projects.php">Project</a></li>
        <li class="nav-item"><a class="nav-link" href="sprints.php">Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/tugas.php">Tugas</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/backlog.php">Backlog</a></li>
        <a class="nav-link" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h3>Daftar Tugas</h3>
    <a href="../admin/add-tugas.php" class="btn btn-primary mb-3">Tambah Tugas Baru</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Deskripsi Backlog</th>
                <th>Ditugaskan Ke</th>
                <th>Rentang Sprint</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (mysqli_num_rows($resultTugas) > 0): ?>
                <?php $no = 1; ?>
                <?php while ($row = mysqli_fetch_assoc($resultTugas)): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['backlog_deskripsi']; ?></td>
                        <td><?= $row['assigned_user']; ?></td>
                        <td><?= $row['tanggal_mulai']; ?> - <?= $row['tanggal_selesai']; ?></td>
                        <td><?= $row['status']; ?></td>
                        <td>
                            <a href="../admin/add-tugas.php?id=<?= $row['tugas_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="../admin/delete-tugas.php?id=<?= $row['tugas_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus tugas ini?');">Hapus</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center">Belum ada tugas yang ditambahkan</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
