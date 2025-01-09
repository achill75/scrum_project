<?php
include '../includes/db_conn.php';

$user_id = $_GET["id"];

if (isset($_POST["submit"])) {
  $username = $_POST['username'];
  $role = $_POST['role'];
  $password = $_POST['password'];

  $sql = "UPDATE `users` SET `username`='$username',`password`='$password',`role`='$role' WHERE user_id=$user_id";

  $result = mysqli_query($conn, $sql);

  if ($result) {
    header("Location: index.php?msg=Data updated successfully");
  } else {
    echo "Failed: " . mysqli_error($conn);
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
      <h3>Edit User Informasi</h3>
      <p class="text-muted">Klik perbarui setelah mengubah informasi apa pun</p>
    </div>

    <?php
    $sql = "SELECT * FROM `users` WHERE user_id = $user_id LIMIT 1";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    ?>

    <div class="container d-flex justify-content-center">
      <form action="" method="post" style="width:50vw; min-width:300px;">
        <div class="row mb-3">
               <div class="mb-3">
                  <label class="form-label">Username</label>
                  <input type="text" class="form-control" name="username" value="<?php echo isset($row['username']) ? $row['username'] : ''; ?>">
               </div>
               
               <div class="mb-3">
                  <label class="form-label">Role</label>
                  <select class="form-control" name="role" id="role" value="<?php echo $role ?>">
                     <option value="Product Owner">Product Owner</option>
                     <option value="Developer">Pimpinan Scrum</option>
                     <option value="Scrum Master">Scrum Master</option>
                     <option value="Developer">Developer</option>
                  </select>
               </div>

            <div class="mb-3">
               <label class="form-label">Password</label>
               <input type="text" class="form-control" name="password" value="<?php echo $row['password']; ?>">
            </div>

        <div>
          <button type="submit" class="btn btn-success" name="submit">Update</button>
          <a href="index.php" class="btn btn-danger">Cancel</a>
        </div>
      </form>
    </div>
  </div>

  <!-- Bootstrap -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

</body>

</html>