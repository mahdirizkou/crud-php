<?php
session_start();
require 'connect.php';

$sql_admin = "SELECT id_admin, nom_admin FROM admin";
$result_admin = $conn->query($sql_admin);

// Fetch departments
$sql_department = "SELECT id_depart, nam_depart FROM departement";
$result_department = $conn->query($sql_department);

// Fetch interns
$sql_intern = "SELECT id_intern, first_name_intern, last_name_intern FROM intern";
$result_intern = $conn->query($sql_intern);
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Assuming the action is to save the internship record
    $id_admin = $_POST['id_admin'];
    $id_depart = $_POST['id_depart'];
    $id_intern = $_POST['id_intern'];


    $sql = "INSERT INTO internship (id_admin, id_depart, id_intern) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iii", $id_admin, $id_depart, $id_intern);

    if ($stmt->execute()) {
        // Redirect to another page, e.g., a success page or back to the form
        header("Location: internship.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
}

/*  $sql = "SELECT * 
            FROM internship 
            JOIN admins ON internship.id_admin = admins.id_admin 
            JOIN departments ON internship.id_depart = departments.id_depart 
            JOIN interns ON internship.id_intern = interns.id_intern 
            WHERE internship.id_admin = ? AND internship.id_depart = ? AND internship.id_intern = ?"; */

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>my crud php</title>
    <link rel="stylesheet" type="text/css" href="css/styleship.css">
</head>

<body>
    <nav class="navbar navbar-light">
        <p>gestion de internship</p>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Add New User</h3>
            <p class="text-muted">Complete the form below to add a new user</p>
        </div>
        <form action="crudintership.php" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mx-auto">
                <label for="validationCustom01" class="form-label">nom admin:</label><br></br>
                <select name="id_admin" class="form-select" required>
                    <option value="" selected disabled>Select Admin</option>
                    <?php
                    
                    if ($result_admin->num_rows > 0) {
                        while ($row = $result_admin->fetch_assoc()) {
                            echo "<option value='" . $row['id_admin'] . "'>" . $row['nom_admin'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No admin found</option>";
                    }
        
                    ?>
                </select>
            </div>

            <div class="col-md4 mx-auto">
                <label for="validationCustom01" class="form-label">name departement:</label><br></br>
                <select name='id_depart' class="form-select" required>
                    <option value="" selected disabled>Select departement</option>
                    <?php
                    if ($result_department->num_rows >0){
                        while($row=$result_department->fetch_assoc()){
                            echo "<option value='".$row['id_depart'] . "'>" . $row['nam_depart'] . "</option>";
                        }
                    }
                    else {
                        echo "<option value=''>No departement found</option>";
                    }

                    ?>
                </select>
            </div>
            <br></br>
            <div class="col-md4 mx-auto">
                <label for="validationCustom01" class="form-label">name intern:</label><br></br>
                <select name='id_intern' class="form-select" required>
                    <option value="" selected disabled>intern</option>
                    <?php
                    if ($result_intern->num_rows >0){
                        while($row=$result_intern->fetch_assoc()){
                            $full_name = $row['first_name_intern'] . ' ' . $row['last_name_intern'];
                            echo "<option value='" . $row['id_intern'] . "'>" . $full_name . "</option>";
                        }
                    }
                    else {
                        echo "<option value=''>No intern found</option>";
                    }

                    ?>
                </select>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-success" name="submit">Save</button>
                <a href="internship.php" class="btn btn-danger">Cancel</a>
            </div>
        </form>
    </div>

    <script>
        (function() {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation')
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }
                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>
</body>

</html>