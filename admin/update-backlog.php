<?php
include '../includes/db_conn.php';
// Koneksi ke database

// Menangani pengambilan data backlog berdasarkan backlog_id
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $backlog_id = $_GET['id'];
    $sql = "SELECT backlog_id, status FROM backlog WHERE backlog_id = $backlog_id";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
    } else {
        // Jika backlog_id tidak ditemukan
        header("Location: backlog.php?msg=Backlog tidak ditemukan");
        exit();
    }
} else {
    // Jika tidak ada id di URL
    header("Location: backlog.php?msg=ID backlog tidak valid");
    exit();
}

// Menangani pengeditan status backlog
if (isset($_POST['submit'])) {
    $status = $_POST['status'];

    // Validasi nilai status dengan ENUM yang ada
    $valid_status = ['Melaksanakan', 'Proses', 'Selesai'];
    if (!in_array($status, $valid_status)) {
        echo "Error: Nilai status tidak valid.";
        exit();
    }

    $update_sql = "UPDATE backlog SET status = '$status' WHERE backlog_id = $backlog_id";
    if (mysqli_query($conn, $update_sql)) {
        header("Location: backlog.php?msg=Status backlog berhasil diperbarui");
        exit();
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
<link rel="stylesheet" href="../css/style.css">


<title>Update Status Backlog</title>
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
    <h2>Update Status Backlog</h2>
    <form action="" method="POST">
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="" disabled <?= empty($row['status']) ? 'selected' : ''; ?>>-Pilih-</option>
                <option value="Proses" <?= ($row['status'] == 'Proses') ? 'selected' : ''; ?>>Proses</option>
                <option value="Selesai" <?= ($row['status'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
            </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Simpan Perubahan</button>
        <a href="../employee/backlog.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>

</body>
</html>
