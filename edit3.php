<?php
session_start();
require 'connect.php';

if (isset($_GET['id'])) {
    $id_internship = $_GET['id'];

    // Fetch the existing record
    $sql = "SELECT * FROM internship WHERE id_internship = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id_internship);
    $stmt->execute();
    $result = $stmt->get_result();
    $internship = $result->fetch_assoc();

    // Fetch admins
    $sql_admin = "SELECT id_admin, nom_admin FROM admin";
    $result_admin = $conn->query($sql_admin);

    // Fetch departments
    $sql_department = "SELECT id_depart, nam_depart FROM departement";
    $result_department = $conn->query($sql_department);

    // Fetch interns
    $sql_intern = "SELECT id_intern, first_name_intern, last_name_intern FROM intern";
    $result_intern = $conn->query($sql_intern);

    if (isset($_POST['submit'])) {
        // Update the internship record
        $id_admin = $_POST['id_admin'];
        $id_depart = $_POST['id_depart'];
        $id_intern = $_POST['id_intern'];

        $sql = "UPDATE internship SET id_admin = ?, id_depart = ?, id_intern = ? WHERE id_internship = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iiii", $id_admin, $id_depart, $id_intern, $id_internship);

        if ($stmt->execute()) {
            // Redirect to the internships list page
            header("Location: internship.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
    }
} else {
    header("Location: crud/internship.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Internship</title>
    <link rel="stylesheet" type="text/css" href="css/styleship.css">
</head>

<body>
    <nav class="navbar navbar-light">
        <p>UPDATE</p>
    </nav>
    <div class="container">
        <div class="text-center mb-4">
            <h3>Edit Internship</h3>
        </div>
        <form action="" method="POST" class="row g-3 needs-validation" novalidate>
            <div class="col-md-4 mx-auto">
                <label for="id_admin" class="form-label">Nom Admin:</label><br></br>
                <select name="id_admin" class="form-select" required>
                    <option value="" disabled>Select Admin</option>
                    <?php
                    if ($result_admin->num_rows > 0) {
                        while ($row = $result_admin->fetch_assoc()) {
                            $selected = ($row['id_admin'] == $internship['id_admin']) ? 'selected' : '';
                            echo "<option value='" . $row['id_admin'] . "' $selected>" . $row['nom_admin'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No admin found</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="col-md-4 mx-auto">
                <label for="id_depart" class="form-label">Name Departement:</label><br></br>
                <select name='id_depart' class="form-select" required>
                    <option value="" disabled>Select Departement</option>
                    <?php
                    if ($result_department->num_rows > 0) {
                        while ($row = $result_department->fetch_assoc()) {
                            $selected = ($row['id_depart'] == $internship['id_depart']) ? 'selected' : '';
                            echo "<option value='" . $row['id_depart'] . "' $selected>" . $row['nam_depart'] . "</option>";
                        }
                    } else {
                        echo "<option value=''>No departement found</option>";
                    }
                    ?>
                </select>
            </div>
            <br></br>
            <div class="col-md-4 mx-auto">
                <label for="id_intern" class="form-label">Name Intern:</label><br></br>
                <select name='id_intern' class="form-select" required>
                    <option value="" disabled>Select Intern</option>
                    <?php
                    if ($result_intern->num_rows > 0) {
                        while ($row = $result_intern->fetch_assoc()) {
                            $full_name = $row['first_name_intern'] . ' ' . $row['last_name_intern'];
                            $selected = ($row['id_intern'] == $internship['id_intern']) ? 'selected' : '';
                            echo "<option value='" . $row['id_intern'] . "' $selected>" . $full_name . "</option>";
                        }
                    } else {
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
            'use strict';
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        }
                        form.classList.add('was-validated');
                    }, false);
                });
        })();
    </script>
</body>

</html>
