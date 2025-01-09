<?php
include '../includes/db_conn.php';


// Ambil data backlog untuk dropdown
$queryBacklog = "SELECT backlog_id FROM backlog";
$resultBacklog = mysqli_query($conn, $queryBacklog);

// Ambil data users untuk dropdown
$queryUsers = "SELECT user_id, username, role FROM users WHERE role = 'developer'";
$resultUsers = mysqli_query($conn, $queryUsers);

// Ambil data sprint untuk dropdown
$querySprint = "SELECT sprint_id, tanggal_mulai, tanggal_selesai FROM sprints";
$resultSprint = mysqli_query($conn, $querySprint);

// Proses tambah tugas
if (isset($_POST['submit'])) {
    $backlog_id = $_POST['backlog_id'];
    $ditugaskan_ke = $_POST['ditugaskan_ke'];
    $sprint_id = $_POST['sprint_id'];
    $status = $_POST['status'];

    $sql = "INSERT INTO tugas (backlog_id, ditugaskan_ke, sprint_id, status) 
            VALUES ('$backlog_id', '$ditugaskan_ke', '$sprint_id', '$status')";

    $result = mysqli_query($conn, $sql);

    if ($result) {
        header("Location: tugas.php?msg=Tugas berhasil ditambahkan");
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

   <title>Tambah Tugas</title>
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
    <h3>Tambah Tugas Baru</h3>
    <form action="" method="POST">
        <!-- Backlog ID -->
        <div class="mb-3">
            <label for="backlog_id" class="form-label">Backlog ID</label>
            <select class="form-control" name="backlog_id" required>
                <?php while ($row = mysqli_fetch_assoc($resultBacklog)) { ?>
                    <option value="<?php echo $row['backlog_id']; ?>">
                        Backlog ID: <?php echo $row['backlog_id']; ?>
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Ditugaskan Ke -->
        <div class="mb-3">
            <label for="ditugaskan_ke" class="form-label">Ditugaskan Ke</label>
              <select class="form-control" name="ditugaskan_ke" required>
                  <?php while ($user = mysqli_fetch_assoc($resultUsers)) { ?>
                      <option value="<?php echo $user['user_id']; ?>">
                          <?php echo $user['username']; ?> (Role: <?php echo $user['role']; ?>)
                      </option>
                  <?php } ?>
              </select>
          </div>

        <!-- Sprint ID -->
        <div class="mb-3">
            <label for="sprint_id" class="form-label">Sprint</label>
            <select class="form-control" name="sprint_id" required>
                <?php while ($row = mysqli_fetch_assoc($resultSprint)) { ?>
                    <option value="<?php echo $row['sprint_id']; ?>">
                        Sprint <?php echo $row['sprint_id']; ?> (<?php echo $row['tanggal_mulai']; ?> - <?php echo $row['tanggal_selesai']; ?>)
                    </option>
                <?php } ?>
            </select>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select class="form-control" name="status" required>
              <option value="Sedang Berlansung">Sedang Berlangsung</option>
              <option value="Selesai">Selesai</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success" name="submit">Tambah</button>
        <a href="../employee/tugas.php" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
