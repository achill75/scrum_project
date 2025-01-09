<?php
// Koneksi ke database
include '../includes/db_conn.php';

// Ambil data dari tabel projects dengan JOIN tabel users untuk mendapatkan nama Product Owner
$queryProjects = "
    SELECT p.project_id, p.project_name, u.username AS product_owner
    FROM projects p
    JOIN users u ON p.product_owner_id = u.user_id";
$resultProjects = mysqli_query($conn, $queryProjects);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Project</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">

  
</head>
<body>
<nav class="navbar navbar-expand-lg bg-warning">
  <div class="container">
    <a class="navbar-brand" href="#">Scrum Project</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
      <a class="nav-link active" href="../index.php">Dashboard</a>
        <li class="nav-item"><a class="nav-link" href="../employee/projects.php">Project</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/sprints.php">Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/tugas.php">Tugas</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/backlog.php">Backlog</a></li>
        <a class="nav-link" href="logout.php">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h3>Daftar Project</h3>
    <a href="../admin/add-projects.php" class="btn btn-primary mb-3">Tambah Project Baru</a>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Project</th>
        <th>Product Owner</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php if (mysqli_num_rows($resultProjects) > 0): ?>
        <?php while ($row = mysqli_fetch_assoc($resultProjects)) { ?>
          <tr>
            <td><?php echo $row['project_id']; ?></td>
            <td><?php echo $row['project_name']; ?></td>
            <td><?php echo $row['product_owner']; ?></td>
            <td>
              <a href="../admin/add-projects.php?id=<?php echo $row['project_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
              <a href="../admin/delete-projects.php?id=<?php echo $row['project_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus proyek ini?')">Delete</a>
            </td>
          </tr>
        <?php } ?>
      <?php else: ?>
        <tr>
          <td colspan="4" class="text-center">Tidak ada proyek yang tersedia</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
