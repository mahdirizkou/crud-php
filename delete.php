<?php
include "connect.php";
$id = $_GET["id"];
$sql = "DELETE FROM `departement` WHERE id_depart = $id";
$result = mysqli_query($conn, $sql);

if ($result) {
  header("Location: table.php");
} else {
  echo "Failed: " . mysqli_error($conn);
}
?>