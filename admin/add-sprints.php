<?php
include '../includes/db_conn.php';


if (isset($_POST['submit'])) {
  $project_id = $_POST['project_id'];
  $tanggal_mulai = $_POST['tanggal_mulai'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
  $status = $_POST['status'];

  $sql = "INSERT INTO sprints (project_id, tanggal_mulai, tanggal_selesai, status) 
          VALUES ('$project_id', '$tanggal_mulai', '$tanggal_selesai', '$status')";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: sprints.php?msg=Sprint berhasil ditambahkan");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
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

   <title>Scrum Project</title>
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

<div class="container mt-4">
  <h3>Tambah Sprint Baru</h3>
  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Proyek</label>
      <select class="form-control" name="project_id">
        <option value="">- Pilih Proyek -</option>
        <?php
        $queryProjects = "SELECT project_id, project_name FROM projects";
        $projects = mysqli_query($conn, $queryProjects);
        while ($row = mysqli_fetch_assoc($projects)) {
          echo "<option value='" . $row['project_id'] . "'>" . $row['project_name'] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Mulai</label>
      <input type="date" class="form-control" name="tanggal_mulai">
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Selesai</label>
      <input type="date" class="form-control" name="tanggal_selesai">
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select class="form-control" name="status">
        <option value="Buka">Buka</option>
        <option value="Tutup">Tutup</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Simpan</button>
    <a href="../employee/sprints.php" class="btn btn-danger">Batal</a>
  </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
