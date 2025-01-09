<?php
include '../includes/db_conn.php';// Koneksi ke database

// Mengambil data dari tabel backlog
$sql = "
    SELECT 
        backlog.backlog_id, 
        backlog.deskripsi, 
        backlog.status, 
        projects.project_name 
    FROM backlog 
    INNER JOIN projects ON backlog.project_id = projects.project_id
";
$result = mysqli_query($conn, $sql);

// Debugging query jika terjadi error
if (!$result) {
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

   <title>Backlog</title>
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
    <h2>Daftar Backlog</h2>
    <a href="../admin/add-backlog.php" class="btn btn-primary mb-3">Tambah Backlog</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Project</th>
                <th>Deskripsi</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?= htmlspecialchars($row['backlog_id']) ?></td>
                        <td><?= htmlspecialchars($row['project_name']) ?></td>
                        <td><?= htmlspecialchars($row['deskripsi']) ?></td>
                        <td><?= htmlspecialchars($row['status']) ?></td>
                        <td>
                            <a href="../admin/update-backlog.php?id=<?= $row['backlog_id'] ?>" class="btn btn-warning btn-sm">Update</a>
                            <a href="delete-backlog.php?id=<?= $row['backlog_id'] ?>" class="btn btn-danger btn-sm" 
                               onclick="return confirm('Apakah Anda yakin ingin menghapus backlog ini?')">Hapus</a>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data backlog.</td>
                </tr>
                <?php
            }
            ?>
        </tbody>
    </table>
</div>
</body>
</html>
