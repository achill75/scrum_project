<?php
session_start();
include 'includes/db_conn.php';


// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
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
  <link rel="stylesheet" href="css/style.css">
  <title>Scrum Project Agile</title>
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
        <a class="nav-link active" aria-current="page" href="index.php">Dashboard</a>
        <li class="nav-item"><a class="nav-link" href="employee/projects.php">Project</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/sprints.php">Sprint</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/tugas.php">Tugas</a></li>
        <li class="nav-item"><a class="nav-link" href="employee/backlog.php">Backlog</a></li>
        <a class="nav-link" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</nav>

<div class="container mt-4">
  <h3>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h3>
  <p class="text-muted">Kelola pengguna Anda di bawah:</p>

  <!-- Alert -->
  <?php
  if (isset($_GET["msg"])) {
    $msg = $_GET["msg"];
    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
    ' . $msg . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
  }
  ?>

  <!-- Add New User Button -->
  <a href="add-new.php" class="btn btn-warning mb-2">Add New User</a>

  <!-- Users Table -->
  <table class="table table-hover text-center">
    <thead class="table-warning">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">User Name</th>
        <th scope="col">Role</th>
        <th scope="col">Password</th>
        <th scope="col">Aksi</th>
      </tr>
    </thead>
    <tbody>
      <?php
      $sql = "SELECT * FROM `users`";
      $result = mysqli_query($conn, $sql);
      while ($row = mysqli_fetch_assoc($result)) {
      ?>
      
        <tr>
          <td><?php echo $row["user_id"] ?></td>
          <td><?php echo $row["username"] ?></td>
          <td><?php echo $row["role"] ?></td>
          <td><?php echo $row["password"] ?></td>
          <td>
            <a href="edit.php?id=<?php echo $row["user_id"] ?>" class="link-warning"><i class="fa-solid fa-pen-to-square fs-5 me-3"></i></a>
            <a href="delete.php?id=<?php echo $row["user_id"] ?>" class="link-danger" onclick="return confirm('Apakah anda yakin ingin menghapus user ini?');"><i class="fa-solid fa-trash fs-5"></i></a>
          </td>
        </tr>
      <?php
      }
      ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>
</html>
