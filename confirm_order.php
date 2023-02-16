<?php
include_once 'includes/dbh.inc.php';
session_start();
if ($_SESSION["username"] == "defaultUser") {
	if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on')   
		$urlbase = "https://";
	else
		$urlbase = "http://";
	// Append the host(domain name, ip) to the URL.
	$urlbase.= $_SERVER['HTTP_HOST'];
	$url = $urlbase."/customer_registration.php?checkout=true";
	header("Location: $url");
	exit();
}


// Get user information
$username = $_SESSION['username'];
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
}
?>
<!DOCTYPE HTML>
<head>
	<title>CONFIRM ORDER</title>
	<header align="center">Confirm Order</header> 
</head>
<body>
	<table align="center" style="border:2px solid blue;">
	<form id="buy" action="proof_purchase.php" method="post">
	<tr>
	<td>
	Shipping Address:
	</td>
	</tr>
	<td colspan="2"><?php print "$name" ?></td>
	<td rowspan="3" colspan="2">
		<input type="radio" name="cardgroup" value="profile_card" checked>Use Credit card on file<br /><?php print "$ccType - $ccNumber" ?><br />
		<input type="radio" name="cardgroup" value="new_card">New Credit Card<br />
		<select id="credit_card" name="credit_card">
			<option selected disabled>select a card type</option>
			<option>VISA</option>
			<option>MASTER</option>
			<option>DISCOVER</option>
		</select>
		<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
		<br />Exp date<input type="text" id="card_expiration" name="card_expiration" placeholder="mm/yyyy">
	</td>
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
		?>
		</table>
	</div>
	</td>
	</tr>
	<tr>
	<td align="left" colspan="2">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;background-color:LightBlue">
	<b>Shipping Note:</b> The books will be </br>delivered within 5</br>business days.
	</div>
	</td>
	<td align="right">
	<div id="bookdetails" style="overflow:scroll;height:180px;width:260px;border:1px solid black;">
		SubTotal: $<?php print "$subtotal"; ?></br>Shipping_Handling: $<?php print "$shipping_handling"; ?></br>_______</br>Total: $<?php print "$total"; ?></div>
	</td>
	</tr>
	<tr>
		<td align="right">
			<input type="submit" id="buyit" name="btnbuyit" value="BUY IT!">
		</td>
		</form>
		<td align="right">
			<form id="update" action="update_customerprofile.php" method="post">
			<input type="submit" id="update_customerprofile" name="update_customerprofile" value="Update Customer Profile">
			</form>
		</td>
		<td align="left">
			<form id="cancel" action="index.php" method="post">
			<input type="submit" id="cancel" name="cancel" value="Cancel">
			</form>
		</td>
	</tr>
	</table>
</body>
</HTML>
