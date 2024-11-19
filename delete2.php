<?php
include "connect.php";
$id = $_GET["id"];
$sql = "DELETE FROM `intern` WHERE id_intern = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: intern.php");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>