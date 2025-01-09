<?php
include '../includes/db_conn.php';


// Ambil data dari tabel sprints dan projects
$query = "
  SELECT s.sprint_id, s.tanggal_mulai, s.tanggal_selesai, s.status, p.project_name
  FROM sprints s
  JOIN projects p ON s.project_id = p.project_id
";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Sprints</title>
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-warning">
  <div class="container">
    <a class="navbar-brand" href="#">Scrum Project</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
      <a class="nav-link active" href="../index.php">Dashboard</a>
        <li class="nav-item"><a class="nav-link" href="projects.php">Project</a></li>
        <li class="nav-item"><a class="nav-link" href="sprints.php">Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/tugas.php">Tugas</a></li>
        <li class="nav-item"><a class="nav-link" href="../employee/backlog.php">Backlog</a></li>
        <a class="nav-link" href="logout.php">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h3>Daftar Sprints</h3>
  <a href="../admin/add-sprints.php" class="btn btn-primary mb-3">Tambah Sprint Baru</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nama Proyek</th>
        <th>Tanggal Mulai</th>
        <th>Tanggal Selesai</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['sprint_id']; ?></td>
        <td><?php echo $row['project_name']; ?></td>
        <td><?php echo $row['tanggal_mulai']; ?></td>
        <td><?php echo $row['tanggal_selesai']; ?></td>
        <td><?php echo $row['status']; ?></td>
        <td>
          <a href="../admin/add-sprints.php?id=<?php echo $row['sprint_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="../admin/delete-sprints.php?id=<?php echo $row['sprint_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus sprint ini?')">Delete</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
