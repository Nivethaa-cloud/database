
<!DOCTYPE HTML>
<head>
<title>User Login</title>
</head>
<body>
<?php
    include_once 'includes/dbh.inc.php';
	if(isset($_POST['login']))
	{
	$name=$_POST["username"];
    $pin1=$_POST["pin"];

	$sql = "SELECT * FROM Customers where Username='$name'";
	$query = mysqli_query($conn, $sql);
    $num_rows=mysqli_num_rows($query);
	if($num_rows==0)
	{
		echo "<script>alert('Incorrect username');</script>";
	
	}
	if($num_rows>0)
	{
		$row=mysqli_fetch_assoc($query);
		$pin=$row["Pin"];
		if($pin==$pin1)
		{
			session_start();
	        $_SESSION['username'] = $_POST['username'];
	         header("location:screen2.php");
	   }
		
		else{
			echo "<script>alert('Incorrect pin');</script>";
			
		}

	}
}

?>
	<table align="center" style="border:2px solid blue;">
		<form action="" method="post" id="login_screen">
		<tr>
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="username" id="username">
			</td>
			<td align="right">
				<input type="submit" name="login" id="login" value="Login">
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" name="pin" id="pin">
			</td>
			</form>
			<form action="index.php" method="post" id="login_screen">
			<td align="right">
				<input type="submit" name="cancel" id="cancel" value="Cancel">
			</td>
			</form>
		</tr>
	</table>
</body>

</html>
