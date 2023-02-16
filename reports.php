<?php
$error = false;
if (!array_key_exists("adminname", $_POST)) {
	$error = true;
}
if (!array_key_exists("pin", $_POST)) {
	$error = true;
}
if ($_POST["adminname"] != "admin" || $_POST["pin"] != 1234) {
	$error = true;
}
?>
<html>
<title>Admin Reports</title>
<head>
	<style>
		table {
			margin: auto;
			width: 30%;
			border: 1px solid blue;
			border-collapse: collapse;
		}
		td {
			border: 1px solid blue;
		}
		p {
			text-align: center;
		}
	</style>
<body>
	<?php
	if ($error) {
		print "Incorrect username or password. Please try again.";
	} else {
		print "<table>";
		print "<tr><td><h2>Admin Reports</h2></td></tr>";
		print "<tr><td><form action=\"\" method=\"post\">";
		print "<input type=\"radio\" name=\"group1\" value=\"registered_customers.php\" onclick=\"document.location.href='registered_customers.php'\">Registered Customers<br/>";
		print "<input type=\"radio\" name=\"group1\" value=\"books_by_category.php\" onclick=\"document.location.href='books_by_category.php'\">Books by Category<br/>";
		print "<input type=\"radio\" name=\"group1\" value=\"sales.php\" onclick=\"document.location.href='sales.php'\">Sales<br/>";
		print "<input type=\"radio\" name=\"group1\" value=\"reviews_per_book.php\" onclick=\"document.location.href='reviews_per_book.php'\">Reviews per Book<br/>";
		print "<input type=\"submit\" name=\"submit\" value=\"ENTER\">";
		print "</form></td></tr>";
		print "<form action=\"index.php\" method=\"post\">";
		print "<td><input type=\"submit\" name=\"exit\" value=\"EXIT 3-B.com\" /></td></form>";
		print "</table>";
	}
	?>
	<table>
</body>
</html>