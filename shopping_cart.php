<?php
	include_once 'includes/dbh.inc.php';
	session_start();
	if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		foreach($_SESSION['shoppingCart'] as $isbn => $qty) {
			$_SESSION['shoppingCart'][$isbn] = $_POST[$isbn];
		}
	} else {
		$url = $_SERVER['REQUEST_URI'];
		$parts = parse_url($url);
		if (array_key_exists('query', $parts)) {
			parse_str($parts['query'], $query);
			if (array_key_exists('delIsbn', $query)) {
				$isbn = $query['delIsbn'];
				if (array_key_exists($isbn, $_SESSION['shoppingCart'])) {
					unset($_SESSION['shoppingCart'][$isbn]);
				}
			}
		}
	}
?>
<!DOCTYPE HTML>
<head>
	<title>Shopping Cart</title>
	<script>
	//remove from cart
	function del(isbn){
		window.location.href="shopping_cart.php?delIsbn="+ isbn;
	}
	</script>
</head>
<body>
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="center">
				<form id="checkout" action="confirm_order.php" method="get">
					<input type="submit" name="checkout_submit" id="checkout_submit" value="Proceed to Checkout">
				</form>
			</td>
			<td align="center">
				<form id="new_search" action="screen2.php" method="post">
					<input type="submit" name="search" id="search" value="New Search">
				</form>
			</td>
			<td align="center">
				<form id="exit" action="index.php" method="post">
					<input type="submit" name="exit" id="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
		<form id="recalculate" name="recalculate" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
		<tr>
			<td  colspan="3">
				<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solid black;">
					<table align="center" BORDER="2" CELLPADDING="2" CELLSPACING="2" WIDTH="100%">
						<th width='10%'>Remove</th><th width='60%'>Book Description</th><th width='10%'>Qty</th><th width='10%'>Price</th>
						<?php
							$isbns = "'".implode("', '", array_keys($_SESSION['shoppingCart']))."'";
							$sql = "SELECT * FROM Books WHERE ISBN IN ($isbns);";
							$result = mysqli_query($conn, $sql);
							$resultCheck = mysqli_num_rows($result);
							$subtotal = 0;
							if ($resultCheck > 0) {
								while ($row = mysqli_fetch_assoc($result)) {
									$isbn = $row['ISBN'];
									$qty = $_SESSION['shoppingCart'][$isbn];
									echo "<tr>";
									echo "<td>";
									echo "<button name='delete' id='delete' onClick='del(\"".$isbn."\"); return false;'>Delete Item</button>";
									echo "</td>";

									echo "<td>".$row['Title']."</br>";
									echo "<b>By</b> ".$row['Author']."</br>";
									echo "<b>Publisher:</b> ".$row['Publisher']."</td>";
									echo "<td><input name='".$isbn."' value='".$qty."' size='1' /></td>";
									echo "<td>".$row['Price']."</td>";
									echo "</tr>";
									$subtotal += (float)$row['Price'] * $qty;
								}
							}
							?>
					</table>
				</div>
			</td>
		</tr>
		<tr>
			<td align="center">
				<input type="submit" name="recalculate_payment" id="recalculate_payment" value="Recalculate Payment">
			</td>
			<td align="center">
				&nbsp;
			</td>
			<?php
			echo "<td align=\"center\">Subtotal:  $".number_format($subtotal, 2)."</td>";
			?>
		</tr>
	</table>
	</form>
</body>
