<?php
// Koneksi ke database
include '../includes/db_conn.php';


// Ambil project_id dari URL
$project_id = $_GET["id"];

// Ambil data proyek berdasarkan ID untuk ditampilkan di form
$sql = "SELECT * FROM `projects` WHERE project_id = $project_id LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

if (!$row) {
  die("Proyek tidak ditemukan.");
}

// Proses update data proyek
if (isset($_POST["submit"])) {
  $project_name = $_POST['project_name'];
  $product_owner_id = $_POST['product_owner_id'];

  $sqlUpdate = "UPDATE `projects` SET `project_name`='$project_name', `product_owner_id`='$product_owner_id' WHERE `project_id`=$project_id";
  $resultUpdate = mysqli_query($conn, $sqlUpdate);

  if ($resultUpdate) {
    header("Location: projects.php?msg=Proyek berhasil diperbarui");
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

  <title>Edit Proyek</title>
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
    <h3>Edit Informasi Proyek</h3>
    <p class="text-muted">Klik perbarui setelah mengubah informasi apa pun</p>
  </div>

  <div class="container d-flex justify-content-center">
    <form action="" method="post" style="width:50vw; min-width:300px;">
      <div class="mb-3">
        <label class="form-label">Nama Proyek</label>
        <input type="text" class="form-control" name="project_name" value="<?php echo isset($row['project_name']) ? $row['project_name'] : ''; ?>">
      </div>

      <div class="mb-3">
        <label class="form-label">Product Owner</label>
        <select class="form-control" id="product_owner_id" name="product_owner_id">
          <option value="">- Pilih Product Owner -</option>
          <?php
          // Ambil daftar pengguna dengan role 'Product Owner'
          $queryUsers = "SELECT user_id, username FROM users WHERE role='Product Owner'";
          $users = mysqli_query($conn, $queryUsers);

          while ($user = mysqli_fetch_assoc($users)) {
            $selected = ($user['user_id'] == $row['product_owner_id']) ? 'selected' : '';
            echo "<option value='" . $user['user_id'] . "' $selected>" . $user['username'] . "</option>";
          }
          ?>
        </select>
      </div>

      <div>
        <button type="submit" class="btn btn-success" name="submit">Perbarui</button>
        <a href="../employee/projects.php" class="btn btn-danger">Batal</a>
      </div>
    </form>
  </div>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
