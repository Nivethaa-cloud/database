<?php
include_once 'includes/dbh.inc.php';
session_start();
$username = $_SESSION["username"];
if ($_POST["cardgroup"] == "new_card") {
	$ccType = $_POST["credit_card"];
	$ccNumber = $_POST["card_number"];
	$ccExpDate = $_POST["expiration"];
	$query="UPDATE Customers SET ccType = '$ccType', ccNumber = '$ccNumber', ccExpDate = '$ccExpDate' WHERE username = '$username';";
	$result= mysqli_query($conn,$query);
}

$sql = "SELECT * FROM Customers WHERE username = '$username';";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
	$row = mysqli_fetch_assoc($result);
	$name = $row["FirstName"]." ".$row["LastName"];
	$streetAddress = $row["Address"];
	$city = $row["City"];
	$state = $row["State"];
	$zip = $row["ZipCode"];
	$ccType = $row["ccType"];
	$ccNumber = $row["ccNumber"];
	$ccExpDate = $row["ccExpDate"];
}

$currentTime = new DateTime('now');
$time = date_format($currentTime, "Y-m-d H:i:s");
foreach ($_SESSION["shoppingCart"] as $isbn => $quantity) {
	$sql = "INSERT INTO Purchases (Time, Book_ISBN, Username, Quantity) VALUES ('$time', '$isbn', '$username', $quantity);";
	$result = mysqli_query($conn, $sql);
}
?>
<!DOCTYPE HTML>
<head>
	<title>Proof purchase</title>
	<header align="center">Proof purchase</header> 
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2"><?php print "$name" ?></td>
	<td rowspan="3" colspan="2">
		<b>UserID:</b><?php print "$username" ?><br />
		<b>Date:</b>2019-10-03<br />
		<b>Time:</b>16:34:46<br />
		<b>Card Info:</b><?php print "$ccType" ?><br /><?php print "$ccExpDate - $ccNumber" ?></td>
	<tr>
	<td colspan="2"><?php print "$streetAddress" ?></td>
	</tr>
	<tr>
	<td colspan="2"><?php print "$city" ?></td>
	</tr>
	<tr>
	<td colspan="2"><?php print "$state, $zip" ?></td>
	</tr>
	<tr>
	<td colspan="3" align="center">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:520px;border:1px solid black;">
	<table border='1'>
		<th>Book Description</th><th>Qty</th><th>Price</th>
		<?php
		$subtotal = 0;
		$shipping_handling = 0;
		$total = 0;
		foreach ($_SESSION["shoppingCart"] as $isbn => $quantity) {
			$sql = "SELECT * FROM Books WHERE ISBN = '$isbn';";
			$result = mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if ($resultCheck > 0) {
				$row = mysqli_fetch_assoc($result);
				$title = $row["title"];
				$author = $row["Author"];
				$publisher = $row["Publisher"];
				$price = $row["Price"];
				print "<tr><td>$title</br><b>By </b>$author</br><b>Publisher: </b>$publisher</td>";
				print "<td>$quantity</td><td>$price</td></tr>";
				$subtotal += $quantity*$price;
				$shipping_handling += 2*$quantity;
				$total = $total + $subtotal + $shipping_handling;
			}
		}
		unset($_SESSION["shoppingCart"]);
		$_SESSION["shoppingCart"] = array();
		?>
	</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The book will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		SubTotal:$<?php print "$subtotal" ?></br>Shipping_Handling:$<?php print "$shipping_handling" ?></br>_______</br>Total:$<?php print "$total" ?></div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="Print" disabled>
		</td>
		</form>
		<td align="right">
			<form id="update" action="screen2.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="New Search">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="exit" name="exit" value="EXIT 3-B.com">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
