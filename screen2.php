

<?php
// Initialize session variables to keep track of shopping cart
session_start();
if (!array_key_exists("username", $_SESSION)){
	if (array_key_exists("username", $_POST)) {
		$_SESSION['username'] = $_POST["username"];
	} else {
		$_SESSION['username'] = "defaultUser";
	}
}
if (!array_key_exists("shoppingCart", $_SESSION)){
	$_SESSION['shoppingCart'] = array();
}
?>
<html>
<head>
	<title>SEARCH - 3-B.com</title>
	<script>
	function EnableDisable(txtsearch) {
        //Reference the Button.
        var btnSubmit = document.getElementById("btnSubmit");
 
        //Verify the TextBox value.
        if (txtsearch.value.trim() != "") {
            //Enable the TextBox when TextBox has value.
            btnSubmit.disabled = false;
        } else {
            //Disable the TextBox when TextBox is empty.
            btnSubmit.disabled = true;
        }
    };
	</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td>Search for: </td>
			<form action="screen3.php" method="get">
				<td><input id="txtsearch" name="searchfor" placeholder="Enter comma separated keywords" onkeyup="EnableDisable(this)"/></td>
				<td><input id="btnSubmit" type="submit" name="search" value="Search" disabled="disabled" /></td>
		</tr>
		<tr>
			<td>Search In: </td>
				<td>
					<select name="searchon[]" multiple>
						<option value="anywhere" selected='selected'>Keyword anywhere</option>
						<option value="title">Title</option>
						<option value="author">Author</option>
						<option value="publisher">Publisher</option>
						<option value="isbn">ISBN</option>				
					</select>
				</td>
				<td><a href="shopping_cart.php"><input type="button" name="manage" value="Manage Shopping Cart" /></a></td>
		</tr>
		<tr>
			<td>Category: </td>
				<td><select name="category">
						<option value='all' selected='selected'>All Categories</option>
						<option value='1'>Fantasy</option><option value='2'>Adventure</option><option value='3'>Fiction</option><option value='4'>Horror</option>				</select></td>
			</form>
	         <form action="index.php" method="post">	
				<td><input type="submit" name="exit" value="EXIT 3-B.com" /></td>
			</form>
		</tr>
	</table>
</body>
</html>
