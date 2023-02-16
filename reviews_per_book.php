<?php
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Reviews Per Book</title>
        
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
        <h1>Reviews Per Book</h1>
        <table>
            <tr>
                <th>Title</th>
                <th>Number of Reviews</th>
            </tr>
            <?php
            $sql = "SELECT Books.Title, COUNT(Reviews.ID) FROM Books JOIN Reviews on Books.ISBN = Reviews.Book_ISBN GROUP BY Books.ISBN;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $category = $row['Title'];
                    $number = $row['COUNT(Reviews.ID)'];
                    echo "<tr><td>$category</td><td>$number</td></tr>";
                }
            }
            ?>
        </table>
    </body>
</html>