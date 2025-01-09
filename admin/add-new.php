<?php
include '../includes/db_conn.php';


$username = "";
$role = "";
$password = "";
$success = "";
$error = "";

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $role = $_POST['role'];
    $password = $_POST['password'];

    if ($username && $role && $password) {
        $sql = "INSERT INTO `users`(`username`, `role`, `password`) VALUES ('$username', '$role', '$password')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            $success = "Berhasil memasukkan data baru";
            header("Location: index.php?msg=$success");
            exit();
        } else {
            $error = "Gagal memasukkan data: " . mysqli_error($conn);
        }
    } else {
        $error = "Semua data harus diisi!";
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

<div class="container">
  <div class="text-center mb-4">
    <h3>Add New User</h3>
    <p class="text-muted">Lengkapi formulir di bawah ini untuk menambahkan pengguna baru</p>
  </div>
</div>

<div class="container d-flex justify-content-center">
   <form action="" method="post" style="width:50vw; min-width:300px;">
      <?php if (!empty($success)): ?>
         <div class="alert alert-success"><?php echo $success; ?></div>
      <?php endif; ?>
      <?php if (!empty($error)): ?>
         <div class="alert alert-danger"><?php echo $error; ?></div>
      <?php endif; ?>

      <div class="mb-3">
         <label class="form-label">Username</label>
         <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>">
      </div>
      
      <div class="mb-3">
         <label class="form-label">Role</label>
         <select class="form-control" id="role" name="role">
            <option value=""> - Pilih Role - </option>
            <option value="Product Owner" <?php echo $role == "Product Owner" ? "selected" : ""; ?>>Product Owner</option>
            <option value="Pimpinan Scrum" <?php echo $role == "Pimpinan Scrum" ? "selected" : ""; ?>>Pimpinan Scrum</option>
            <option value="Scrum Master" <?php echo $role == "Scrum Master" ? "selected" : ""; ?>>Scrum Master</option>
            <option value="Developer" <?php echo $role == "Developer" ? "selected" : ""; ?>>Developer</option>
         </select>
      </div>

      <div class="mb-3">
         <label class="form-label">Password</label>
         <input type="password" class="form-control" id="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
      </div>

      <div class="d-flex justify-content-between">
         <button type="submit" class="btn btn-success" name="submit">Save</button>
         <a href="index.php" class="btn btn-danger">Cancel</a>
      </div>
   </form>
</div>

<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>
