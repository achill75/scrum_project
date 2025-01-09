<?php
// Koneksi ke database
include '../includes/db_conn.php';


// Ambil tugas_id dari URL
$tugas_id = $_GET["id"];

// Ambil data tugas berdasarkan ID untuk ditampilkan di form
$sqlTugas = "SELECT * FROM tugas WHERE tugas_id = $tugas_id LIMIT 1";
$resultTugas = mysqli_query($conn, $sqlTugas);
$rowTugas = mysqli_fetch_assoc($resultTugas);

if (!$rowTugas) {
  die("Tugas tidak ditemukan.");
}

// Ambil data backlog untuk dropdown
$queryBacklog = "SELECT backlog_id FROM backlog";
$resultBacklog = mysqli_query($conn, $queryBacklog);

// Ambil data sprint untuk dropdown
$querySprint = "SELECT sprint_id, tanggal_mulai, tanggal_selesai FROM sprints";
$resultSprint = mysqli_query($conn, $querySprint);

// Ambil data users dengan role 'developer' untuk dropdown
$queryUsers = "SELECT user_id, username, role FROM users WHERE role = 'developer'";
$resultUsers = mysqli_query($conn, $queryUsers);

// Proses update tugas
if (isset($_POST["submit"])) {
  $backlog_id = $_POST['backlog_id'];
  $ditugaskan_ke = $_POST['ditugaskan_ke'];
  $sprint_id = $_POST['sprint_id'];
  $status = $_POST['status'];

  $sqlUpdate = "UPDATE tugas SET backlog_id = '$backlog_id', ditugaskan_ke = '$ditugaskan_ke', sprint_id = '$sprint_id', status = '$status' WHERE tugas_id = $tugas_id";
  $resultUpdate = mysqli_query($conn, $sqlUpdate);

  if ($resultUpdate) {
    header("Location: tugas.php?msg=Tugas berhasil diperbarui");
  } else {
    echo "Gagal memperbarui data: " . mysqli_error($conn);
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
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="../css/style.css">

  <title>Edit Tugas</title>
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
  <div class="text-center mb-4">
    <h3>Edit Informasi Tugas</h3>
    <p class="text-muted">Klik perbarui setelah mengubah informasi tugas</p>
  </div>

  <div class="container d-flex justify-content-center">
    <form action="" method="post" style="width:50vw; min-width:300px;">
      
      <!-- Backlog ID -->
      <div class="mb-3">
        <label class="form-label">Backlog ID</label>
        <select class="form-control" name="backlog_id" required>
          <?php while ($rowBacklog = mysqli_fetch_assoc($resultBacklog)) { ?>
            <option value="<?php echo $rowBacklog['backlog_id']; ?>" <?php echo ($rowBacklog['backlog_id'] == $rowTugas['backlog_id']) ? 'selected' : ''; ?>>
              Backlog ID: <?php echo $rowBacklog['backlog_id']; ?>
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- Ditugaskan Ke -->
      <div class="mb-3">
        <label class="form-label">Ditugaskan Ke</label>
        <select class="form-control" name="ditugaskan_ke" required>
          <?php while ($user = mysqli_fetch_assoc($resultUsers)) { ?>
            <option value="<?php echo $user['user_id']; ?>" <?php echo ($user['user_id'] == $rowTugas['ditugaskan_ke']) ? 'selected' : ''; ?>>
              <?php echo $user['username']; ?> (Role: <?php echo $user['role']; ?>)
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- Sprint ID -->
      <div class="mb-3">
        <label class="form-label">Sprint</label>
        <select class="form-control" name="sprint_id" required>
          <?php while ($rowSprint = mysqli_fetch_assoc($resultSprint)) { ?>
            <option value="<?php echo $rowSprint['sprint_id']; ?>" <?php echo ($rowSprint['sprint_id'] == $rowTugas['sprint_id']) ? 'selected' : ''; ?>>
              Sprint <?php echo $rowSprint['sprint_id']; ?> (<?php echo $rowSprint['tanggal_mulai']; ?> - <?php echo $rowSprint['tanggal_selesai']; ?>)
            </option>
          <?php } ?>
        </select>
      </div>

      <!-- Status -->
      <div class="mb-3">
        <label class="form-label">Status</label>
        <select class="form-control" name="status" required>
          <option value="Sedang Berlangsung" <?php echo ($rowTugas['status'] == 'Sedang Berlangsung') ? 'selected' : ''; ?>>Sedang Berlangsung</option>
          <option value="Selesai" <?php echo ($rowTugas['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
        </select>
      </div>

      <button type="submit" class="btn btn-success" name="submit">Perbarui</button>
      <a href="../employee/tugas.php" class="btn btn-danger">Batal</a>
    </form>
  </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
