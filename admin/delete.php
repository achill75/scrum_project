<?php
include '../includes/db_conn.php';

$user_id = $_GET["id"];
$sql = "DELETE FROM `users` WHERE user_id = $user_id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: index.php?msg=Data deleted successfully");
} else {
  echo "Failed: " . mysqli_error($conn);
}

?>