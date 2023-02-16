<?php
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Registered Customers</title>
        <meta name="author" content="Nivetha Srijayanthi Ravichandran">
        <style>
            h1 {
                text-align: center;
            }
           table {
                margin: auto;
                width: 30%;
                border-collapse: collapse;
            }
            td,th {
                border: 2px solid black;
            }
        </style>
    </head>
    <body>
        <h1>Number of Registered Customers</h1>
        <table>
        
            <?php
            $sql = "SELECT  Count(*) FROM Customers;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $number = $row['Count(*)'];
                    echo "<tr><td>Total number of customers:</td><td>$number</td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>