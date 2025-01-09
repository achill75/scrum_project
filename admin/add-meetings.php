<?php
include '../includes/db_conn.php';

if (isset($_POST['submit'])) {
    $sprint_id = $_POST['sprint_id'];
    $type = $_POST['type'];
    $tanggal = $_POST['tanggal'];

    $sql = "INSERT INTO meetings (sprint_id, type, tanggal) VALUES ('$sprint_id', '$type', '$tanggal')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: meetings.php?msg=Meeting berhasil ditambahkan");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tambah Meeting</title>
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
        <a class="nav-link" href="logout.php">Logout</a>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h3>Tambah Meeting Baru</h3>
  <form action="" method="POST">
    <div class="mb-3">
      <label for="sprint_id" class="form-label">Sprint ID</label>
      <input type="number" class="form-control" name="sprint_id" required>
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-control" name="type" required>
        <option value="Standup Harian">Standup Harian</option>
        <option value="Sprint Review">Sprint Review</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" class="form-control" name="tanggal" required>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Tambah</button>
    <a href="../employee/meetings.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
