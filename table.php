<?php
require 'connect.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" type="text/css" href="css/stylecrud.css">
    <script src="confir.js"></script>
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            padding-top: 60px;
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        .btn-primary {
            padding: 10px 20px;
            /* Add padding inside the buttons */
            margin: 0 10px;
            /* Add margin between the buttons */
            border: none;
            /* Remove the default button border */
            border-radius: 5px;
            /* Add rounded corners to the buttons */
            background-color: #007bff;
            /* Button background color */
            color: #fff;
            /* Button text color */
            font-size: 16px;
            /* Button text size */
            cursor: pointer;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-light justify-content-center fs-3 mb-5" style="background-color:#bdbdb7;">
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

    <div class="container">
        <a href="crud.php" class="btn btn-dark mb-3">Add Department</a>
        <a href="pdfff.php" class="btn btn-success mb-3 float-end"><span class="glyphicon glyphicon-print"></span> Print</a>
        <div class="logout">
            <a class="btn btn-warning" href="login.php">Log out</a>
        </div>

        <table class="table table-hover text-center">
            <thead class="table-light">
                <tr>
                    <th>ID Department</th>
                    <th>ID Admin</th>
                    <th>Name admin</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `departement`";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_assoc($result)) {
                ?>
                    <tr>
                        <td><?php echo $row["id_depart"] ?></td>
                        <td><?php echo $row["id_admin"] ?></td>
                        <td><?php echo $row["nam_depart"] ?></td>
                        <td>
                            <button class="btn btn-primary" onclick="openEditModal(<?php echo $row['id_depart'] ?>, '<?php echo addslashes($row['nam_depart']) ?>')">Edit</button>
                            <button class="link-dark button" onclick="confirmDelete(<?php echo $row['id_depart']; ?>, 'delete.php')">
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

    <!-- The Modal -->
    <div id="editModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeEditModal()">&times;</span>
            <form id="editForm">
                <input type="hidden" id="edit_id_depart" name="id_depart">
                <div>
                    <label for="edit_nam_depart">Department Name:</label>
                    <input type="text" id="edit_nam_depart" name="nam_depart" required>
                </div>
                <button type="button" onclick="closeEditModal()">Cancel</button>
            </form>
        </div>
    </div>

    <script>
        // Get the modal
        var modal = document.getElementById("editModal");
        const updateDepartment1 = document.getElementById("editForm")
        updateDepartment1.addEventListener("submit", (e) => {
            e.preventDefault();
            updateDepartment(e)
        })
        console.log(updateDepartment1)

        // Open the modal and populate data
        function openEditModal(id_depart, nam_depart) {
            console.log("openEditModal called with id:", id_depart, "and name:", nam_depart);
            document.getElementById('edit_id_depart').value = id_depart;
            document.getElementById('edit_nam_depart').value = nam_depart;
            modal.style.display = "block";
        }

        // Close the modal
        function closeEditModal() {
            modal.style.display = "none";
        }

        // Handle form submission with AJAX
        function updateDepartment(event) {
            // console.log(event)

            // event.preventDefault();
            var id_depart = document.getElementById('edit_id_depart').value;
            var nam_depart = document.getElementById('edit_nam_depart').value;

            console.log("updateDepartment called with id:", id_depart, "and name:", nam_depart);

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'edit.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log("Response from server:", xhr.responseText);
                        modal.style.display = "none";
                        // location.reload();
                    } else {
                        console.error("Request failed. Status:", xhr.status, "Response:", xhr.responseText);
                    }
                }
            };
            xhr.send('id_depart=' + id_depart + '&nam_depart=' + encodeURIComponent(nam_depart));
        }
    </script>

</body>

</html>