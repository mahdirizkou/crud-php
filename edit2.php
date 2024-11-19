<?php
session_start();
require 'connect.php';
$id = $_GET['id'];

// Retrieve the user data from the database


// Handle the form submission
if (isset($_POST['submit'])) {
    $first_name_intern = $_POST['first_name_intern'];
    $last_name_intern = $_POST['last_name_intern'];
    $birthday_intern = $_POST['birthday_intern'];

    // Update the user data in the database
    $sql = "UPDATE `intern` SET first_name_intern = '$first_name_intern',last_name_intern ='$last_name_intern',birthday_intern='$birthday_intern' WHERE id_intern = $id";
    mysqli_query($conn, $sql);

    // Redirect back to the table page
    header('Location: intern.php');
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
        <p>UPDATE intern</p>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">update stager</p>
        </div>
        <?php
        $sql = "SELECT * FROM `intern` WHERE id_intern = $id";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_assoc($result);
        ?>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">frist name:</label>
                <input name="first_name_intern" type="text" class="form-control" id="validationCustom01" value="<?php echo $row["first_name_intern"] ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">last name:</label>
                <input name="last_name_intern" type="text" class="form-control" id="validationCustom01" value="<?php echo $row["last_name_intern"] ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">brithday:</label>
                <input name="birthday_intern" type="date" class="form-control" id="validationCustom01" value="<?php echo $row["birthday_intern"] ?>" required>
                <div class="valid-feedback">
                    Looks good!
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" name="submit">Update</button>
                <a href="intern.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>
</body>

</html>