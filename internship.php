<?php
require 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Internship Table</title>

    <script src="confir3.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/stylecrud.css">

</head>

<body>
    <nav style="background-color:#bdbdb7;" class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color: #00ff5573;">
        <div class="container-fluid d-flex justify-content-between align-items-center">
            <div>
                <img src="aid.png" alt="Logo" width="100" height="50" style="display: block;">
                <div class="button-container">

                    <button onclick="window.location.href='table.php'">DEPARTEMENT</button>
                    <button onclick="window.location.href='intern.php'">INTERN</button>
                    <button onclick="window.location.href='internship.php'">INTERNSHIP</button>
                </div>
            </div>
        </div>
    </nav>
    <div class="countraint5">
        <div class="container">
            <a href="crudintership.php" class="btn btn-dark mb-3">Add Internship</a>
            <a href="pdfff.php" class="btn btn-success mb-3 float-end"><span class="glyphicon glyphicon-print"></span> Print</a>
            <div class="logout">
                <a class="btn btn-warning" href="login.php">Log out</a>
            </div>

            <table class="table table-hover text-center">
                <thead class="table-light">
                    <tr>
                        <th>ID Internship</th>
                        <th>Admin Name</th>
                        <th>Department Name</th>
                        <th>Intern Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT 
                                internship.id_internship, 
                                admin.nom_admin, 
                                departement.nam_depart, 
                                CONCAT(intern.first_name_intern, ' ', intern.last_name_intern) AS intern_name
                            FROM 
                                internship
                            JOIN 
                                admin ON internship.id_admin = admin.id_admin
                            JOIN 
                                departement ON internship.id_depart = departement.id_depart
                            JOIN 
                                intern ON internship.id_intern = intern.id_intern";
                    $result = $conn->query($sql);
                    while ($row = $result->fetch_assoc()) {
                    ?>
                        <tr>
                            <td><?php echo $row["id_internship"]; ?></td>
                            <td><?php echo $row["nom_admin"]; ?></td>
                            <td><?php echo $row["nam_depart"]; ?></td>
                            <td><?php echo $row["intern_name"]; ?></td>
                            <td>
                                <a href="edit3.php?id=<?php echo $row["id_internship"]; ?>" class="link-dark">
                                    <i class="fa-solid fa-pen-to-square fs-5 me-3"></i>
                                </a>
                                <button class="link-dark button" onclick="confirmDelete(<?php echo $row['id_internship']; ?>, 'delete3.php')">
    <i class="fa-solid fa-trash fs-5"></i>
</button>
                            </td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>

        </div>
    </div>
</body>

</html>