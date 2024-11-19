<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'connect.php';
    if(isset($_POST['nam_depart'])) {
        $nam_depart = $_POST['nam_depart'];
        $id_admin = $_SESSION['admin_id'];

        $sql = "INSERT INTO `departement` (`id_admin`, `nam_depart`) VALUES ('$id_admin','$nam_depart')";
        $qry = mysqli_query($conn, $sql);
        
        if ($qry) {
            header("Location: table.php");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } 
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my crud php</title>
    <link rel="stylesheet" type="text/css" href="css/style1.css">
</head>

<body>
    <nav class="navbar navbar-light">
        <p>gestion de departement</p>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>
        <form action="crud.php" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">Name de departement:</label>
                <input name="nam_depart" type="text" class="form-control" id="validationCustom01" value="Mark" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="table.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>