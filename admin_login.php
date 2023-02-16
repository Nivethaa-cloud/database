
<!DOCTYPE HTML>
<head>
<title>Admin Login</title>
</head>

<body>
	<form action="reports.php" method="post" id="adminlogin_screen">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Adminname<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" name="adminname" id="adminname">
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
			<td align="right">
				<input type="reset" name="cancel" id="cancel" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
</body>



</html>
