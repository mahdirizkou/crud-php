<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;

// Fetch data from the database
require 'connect.php';
$sql = "SELECT * FROM `departement`";
$result = mysqli_query($conn, $sql);

// Define the HTML content
$html = '
<h2 align="center">liste de stagaire departement</h2>
<h4 align="center">my crud php</h4>
<div style="text-align: center;">
<table border="1" cellspacing="0" cellpadding="3" style="margin: 0 auto;">
    <tr>
        <th width="5%">id departement</th>
        <th width="20%">id admin</th>
        <th width="20%">name departement</th>
    </tr>';
        

// Append table rows with data fetched from the database
while ($row = mysqli_fetch_assoc($result)) {
    $html .= '
        <tr>
            <td>' . $row["id_depart"] . '</td>
            <td>' . $row["id_admin"] . '</td>
            <td>' . $row["nam_depart"] . '</td>
        </tr>';
}

// Close the table and finalize the HTML content
$html .= '</table>';

// Instantiate the Dompdf class
$dompdf = new Dompdf();

// Load HTML content
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream("crud.pdf", array("Attachment" => false));
?>

