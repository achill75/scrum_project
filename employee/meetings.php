<?php
include '../includes/db_conn.php';


// Ambil data meetings
$query = "SELECT * FROM meetings";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Meetings</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/style.css">

</head>
<body>
<nav class="navbar navbar-expand-lg bg-warning">
  <div class="container">
    <a class="navbar-brand" href="#">Scrum Project</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav ms-auto">
      <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        <li class="nav-item"><a class="nav-link" href="employee/projects.php">Project</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/sprints.php">Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/tugas.php">Tugas</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/meetings.php">Meeting</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/backlog.php">Backlog</a></li>
        <a class="nav-link" href="logout.php">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h3>Daftar Meetings</h3>
  <a href="../admin/add-meetings.php" class="btn btn-primary mb-3">Tambah Meeting Baru</a>
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ID</th>
        <th>Sprint ID</th>
        <th>Type</th>
        <th>Tanggal</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php while ($row = mysqli_fetch_assoc($result)) { ?>
      <tr>
        <td><?php echo $row['meeting_id']; ?></td>
        <td><?php echo $row['sprint_id']; ?></td>
        <td><?php echo $row['type']; ?></td>
        <td><?php echo $row['tanggal']; ?></td>
        <td>
          <a href="../admin/edit-meetigs.php echo $row['meeting_id']; ?>" class="btn btn-warning btn-sm">Edit</a>
          <a href="../admin/delete-meetings.php?php echo $row['meeting_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus meeting ini?')">Hapus</a>
        </td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
