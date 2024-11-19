<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require 'connect.php';
        $first_name_intern = $_POST['first_name_intern'];
        $last_name_intern = $_POST['last_name_intern'];
        $birthday_intern = $_POST['birthday_intern'];
    
        $sql = "INSERT INTO `intern` (`first_name_intern`, `last_name_intern`,`birthday_intern`) VALUES ('$first_name_intern','$last_name_intern','$birthday_intern')";
        $qry = mysqli_query($conn, $sql);
        
        if ($qry) {
            header("Location: intern.php");
            exit();
        } else {
            echo "Failed: " . mysqli_error($conn);
        }
    } 


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my crud php</title>
    <link rel="stylesheet" type="text/css" href="css/stylestg.css">
</head>

<body>
    <nav class="navbar navbar-light">
        <p>gestion de intern</p>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>
        <form action="crud2.php" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">frist name:</label>
                <input name="first_name_intern" type="text" class="form-control" id="validationCustom01" value="" required>
                <div class="valid-feedback">
                    Looks good!
            </div>
            </div>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">last name:</label>
                <input name="last_name_intern" type="text" class="form-control" id="validationCustom01" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">brithday:</label>
                <input name="birthday_intern" type="date" class="form-control" id="validationCustom01" value="" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="intern.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>