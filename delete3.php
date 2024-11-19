<?php
include "connect.php";
$id = $_GET["id"];
$sql = "DELETE FROM `internship` WHERE id_internship = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: internship.php");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>