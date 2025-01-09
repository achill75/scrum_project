<?php
include '../includes/db_conn.php';


$project_id = $_GET["id"]; // Ambil ID proyek dari URL

$sql = "DELETE FROM `projects` WHERE project_id = $project_id"; // Query untuk menghapus data proyek
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: projects.php?msg=Proyek berhasil dihapus"); // Redirect jika berhasil
} else {
  echo "Gagal menghapus data proyek: " . mysqli_error($conn); // Pesan error jika gagal
}
?>
