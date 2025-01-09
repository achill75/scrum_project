<?php
include '../includes/db_conn.php';

$meeting_id = intval($_GET['id']);

if (isset($_POST['submit'])) {
    $sprint_id = $_POST['sprint_id'];
    $type = $_POST['type'];
    $tanggal = $_POST['tanggal'];

    $sql = "UPDATE meetings SET sprint_id='$sprint_id', type='$type', tanggal='$tanggal' WHERE meeting_id=$meeting_id";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: meetings.php?msg=Meeting berhasil diperbarui");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM meetings WHERE meeting_id=$meeting_id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Meeting</title>
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

<div class="container mt-5">
  <h3>Edit Meeting</h3>
  <form action="" method="POST">
    <div class="mb-3">
      <label for="sprint_id" class="form-label">Sprint ID</label>
      <input type="number" class="form-control" name="sprint_id" value="<?php echo $row['sprint_id']; ?>" required>
    </div>
    <div class="mb-3">
      <label for="type" class="form-label">Type</label>
      <select class="form-control" name="type" required>
        <option value="Standup Harian" <?php if ($row['type'] == 'Standup Harian') echo 'selected'; ?>>Standup Harian</option>
        <option value="Sprint Review" <?php if ($row['type'] == 'Sprint Review') echo 'selected'; ?>>Sprint Review</option>
      </select>
    </div>
    <div class="mb-3">
      <label for="tanggal" class="form-label">Tanggal</label>
      <input type="date" class="form-control" name="tanggal" value="<?php echo $row['tanggal']; ?>" required>
    </div>
    <button type="submit" class="btn btn-success" name="submit">Update</button>
    <a href="../employee/meetings.php" class="btn btn-secondary">Kembali</a>
  </form>
</div>
</body>
</html>
