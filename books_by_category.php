<?php
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Books by Category</title>
        
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
        <h1>Books by Category</h1>
        <table>
            <tr>
                <th>Category</th>
                <th>Number of Books</th>
            </tr>
            <?php
            $sql = "SELECT Category, Count(ISBN) FROM Books GROUP BY Category ORDER BY Category ASC;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $category = $row['Category'];
                    $number = $row['Count(ISBN)'];
                    echo "<tr><td>$category</td><td>$number</td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>