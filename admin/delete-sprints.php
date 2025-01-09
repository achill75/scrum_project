<?php
include '../includes/db_conn.php';


$sprint_id = $_GET["id"]; // Ambil ID sprint dari URL

$sql = "DELETE FROM `sprints` WHERE sprint_id = $sprint_id"; // Query untuk menghapus data sprint
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: sprints.php?msg=Sprint berhasil dihapus"); // Redirect jika berhasil
} else {
  echo "Gagal menghapus data sprint: " . mysqli_error($conn); // Pesan error jika gagal
}
?>
