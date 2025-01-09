<?php
include '../includes/db_conn.php';


$sprint_id = $_GET["id"];

if (isset($_POST["submit"])) {
  $project_id = $_POST['project_id'];
  $tanggal_mulai = $_POST['tanggal_mulai'];
  $tanggal_selesai = $_POST['tanggal_selesai'];
  $status = $_POST['status'];

  $sql = "UPDATE `sprints` 
          SET `project_id`='$project_id', 
              `tanggal_mulai`='$tanggal_mulai', 
              `tanggal_selesai`='$tanggal_selesai', 
              `status`='$status' 
          WHERE `sprint_id`=$sprint_id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: sprints.php?msg=Data sprint berhasil diperbarui");
  } else {
    echo "Error: " . mysqli_error($conn);
  }
}

// Ambil data sprint untuk ditampilkan dalam form
$sql = "SELECT * FROM `sprints` WHERE `sprint_id` = $sprint_id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Sprint</title>
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
  <h3>Edit Sprint</h3>
  <form action="" method="post">
    <div class="mb-3">
      <label class="form-label">Proyek</label>
      <select class="form-control" name="project_id">
        <option value="">- Pilih Proyek -</option>
        <?php
        $queryProjects = "SELECT project_id, project_name FROM projects";
        $projects = mysqli_query($conn, $queryProjects);
        while ($project = mysqli_fetch_assoc($projects)) {
          $selected = ($project['project_id'] == $row['project_id']) ? 'selected' : '';
          echo "<option value='" . $project['project_id'] . "' $selected>" . $project['project_name'] . "</option>";
        }
        ?>
      </select>
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Mulai</label>
      <input type="date" class="form-control" name="tanggal_mulai" value="<?php echo $row['tanggal_mulai']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Tanggal Selesai</label>
      <input type="date" class="form-control" name="tanggal_selesai" value="<?php echo $row['tanggal_selesai']; ?>">
    </div>
    <div class="mb-3">
      <label class="form-label">Status</label>
      <select class="form-control" name="status">
        <option value="Buka" <?php echo ($row['status'] == 'Buka') ? 'selected' : ''; ?>>Buka</option>
        <option value="Tutup" <?php echo ($row['status'] == 'Tutup') ? 'selected' : ''; ?>>Tutup</option>
      </select>
    </div>
    <button type="submit" class="btn btn-primary" name="submit">Update</button>
    <a href="../employee/sprints.php" class="btn btn-danger">Batal</a>
  </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
