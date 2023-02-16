<?php
session_start();
?>

<script>alert('Please enter all values')</script>
<HTML>
<head>
<title> CUSTOMER REGISTRATION </title>
<script type="text/javascript">
      function checkError(){
  
        
		var error2 = document.getElementById('pin').value;
		var error3 = document.getElementById('retype_pin').value;
	
		if(error2!=error3)
		  {
			alert('Pins do not match');
			 return false;
		   }
		
		else{
		    return true;
	      }
    }

	function showAlert(){
	var text= "In order to proceed with the payment, you need to register first!";
	alert(text);
	


}
</script>
</head>
<body>
<?php
	include_once 'includes/dbh.inc.php';
if(isset($_POST['register_submit'])){
$name=$_POST["username"];
$pin=$_POST["pin"];
$firstname=$_POST["firstname"];
$lastname=$_POST["lastname"];
$address=$_POST["address"];
$city=$_POST["city"];
$state=$_POST["state"]; 
$zip=$_POST["zip"];
$creditcard=$_POST["credit_card"];
$cardnumber=$_POST["card_number"];
$expiration=$_POST["expiration"];

$result= mysqli_query($conn,"select * from Customers");
$num_rows=mysqli_num_rows($result);
$flag=0;
for($i=0;$i<$num_rows;$i++) 
 {
     $row=mysqli_fetch_assoc($result);
	 $userid=$row["Username"];
	 if($name==$userid)
	 {
		
	 echo "<script> alert('Username already exists , provide a different Username'); </script>";
	 $flag=1;	

	
    }
}
 if($flag==0)
	 {
	 $query="insert into Customers(Username,Pin,FirstName,LastName,Address,City,State,ZipCode,ccType,ccNumber,ccExpDate)values('$name',$pin,'$firstname','$lastname','$address','$city','$state',$zip,'$creditcard','$cardnumber','$expiration');";
	 $result= mysqli_query($conn,$query);
	 if (!array_key_exists("username", $_SESSION) && !array_key_exists("shoppingCart", $_SESSION)){
		$_SESSION['username'] = $_POST['username'];
		header("Location: screen2.php");
		 }
		 else
		 {
           $_SESSION['username'] = $_POST['username'];
	       header("Location: confirm_order.php");
	     }
	}
 

}
?>  

	<table align="center" style="border:2px solid blue;">	
		<tr>
			<form id="register" onsubmit="return checkError()" action="" method="post">
			<td align="right">
				Username<span style="color:red">*</span>:
			</td>
			<td align="left" colspan="3">
				<input type="text" id="username" name="username" placeholder="Enter your username"  required>
			</td>
		</tr>
		<tr>
			<td align="right">
				PIN<span style="color:red">*</span>:	
			</td>
			<td align="left">
				<input type="password" id="pin" name="pin" required>
			</td>
			<td align="right">
				Re-type PIN<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="password" id="retype_pin" name="retype_pin" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Firstname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="firstname" name="firstname" placeholder="Enter your firstname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Lastname<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="lastname" name="lastname" placeholder="Enter your lastname" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="address" name="address" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3" align="left">
				<input type="text" id="city" name="city" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td align="left">
				<select id="state" name="state">
				<option selected disabled>select a state</option>
				<option>Michigan</option>
				<option>California</option>
				<option>Tennessee</option>
				</select>
			</td>
			<td align="right">
				Zip<span style="color:red">*</span>:
			</td>
			<td align="left">
				<input type="text" id="zip" name="zip" required>
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>
			</td>
			<td align="left">
				<select id="credit_card" name="credit_card" required>
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td colspan="2" align="left">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="right">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration" name="expiration" placeholder="MM/YY" required>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center"> 
				<input type="submit" id="register_submit" name="register_submit" value="Register">
			</td>
			</form>
			<form id="no_registration" action="screen2.php" method="post">
			<td colspan="2" align="center">
				<input type="submit" id="donotregister" name="donotregister" value="Don't Register"  onclick="showAlert()">
			</td>
			
       

		</tr>
</table>
</form>
</body>

</HTML>