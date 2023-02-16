<?php
include_once 'includes/dbh.inc.php';
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Sales by Month</title>
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
        <h1>Sales by Month</h1>
        <table>
            <tr>
                <th>Year</th>
                <th>Month</th>
                <th>Total Sales</th>
                
            </tr>
            <?php
                $sum=0;
                $sql = "select year(Time)as year,month(Time) AS Month,SUM(P.quantity*B.price) as total from Purchases P INNER JOIN Books B on P.Book_ISBN=B.ISBN group by year(Time),month(Time) order by 1,2;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $year = $row['year'];
                    $month = $row['Month'];
                    $sale = $row['total'];
                    echo "<tr><td>$year</td><td>$month</td><td>$$sale</td></tr>";
                    $sum=$sum+$sale;
                }
                }
                echo "</table>";
                echo "<br>";
                echo  "<table>";
                echo "<tr>";
                echo "<th>Average Monthly Sales for the Current Year</th>";
                $sum=$sum/12;
                echo "</tr>";
                echo "<tr><td>$sum</td></tr>";
                echo "</table>";
                ?>
            
       
    </body>
</html>