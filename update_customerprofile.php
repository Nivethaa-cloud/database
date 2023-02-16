<script>alert('Please enter all values')</script><!DOCTYPE HTML>
<?php
session_start();
?>
<head>
<title>UPDATE CUSTOMER PROFILE</title>
<script type="text/javascript">
      function checkError(){
  
        
		var error2 = document.getElementById('new_pin').value;
		var error3 = document.getElementById('retypenew_pin').value;
	
		if(error2!=error3)
		  {
			alert('Pins do not match');
			 return false;
		   }
		
		else{
		    return true;
	      }
    }

</script>
</head>
<body>

<?php
 include_once 'includes/dbh.inc.php';
	
 if(isset($_POST['update_submit'])){
		$PIN=$_POST['new_pin'];
		$Firstname=$_POST['firstname'];
		$Lastname=$_POST['lastname'];
		$Address=$_POST['address'];
		$City=$_POST['city'];
		$State=$_POST['state'];
		$Zip=$_POST['zip'];
		$CreditCard=$_POST['credit_card'];
		$cardnumber=$_POST["card_number"];
		$ExpirationDate=$_POST['expiration_date'];
        $username = $_SESSION['username'];
	  
	  
	  $sql = "UPDATE Customers SET Pin=$PIN ,FirstName = '$Firstname',LastName = '$Lastname',Address = '$Address',City = '$City',State = '$State',ZipCode = $Zip, ccType= '$CreditCard',ccNumber = '$cardnumber', ccExpDate = '$ExpirationDate' where Username = '$username' ";
		  
		$sql_run= mysqli_query($conn, $sql);
       
              if($sql_run== true){
                           echo '<script type="text/javascript"> alert("Data Updated")</script>';
						   header("Location: confirm_order.php");
                           }	
             else{
                   echo '<script type="text/javascript"> alert("Data Not Updated")</script>';
				   header("Location:update_customerprofile.php");
                  }
         }
		
		  
	  ?>
	  
	<form id="update_profile" action="" method="post" onsubmit="return checkError()">
	<table align="center" style="border:2px solid blue;">
		<tr>
			<td align="right">
				Username: 
			</td>
			<td colspan="3" align="center">
							</td>
		</tr>
		<tr>
			<td align="right">
				New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="new_pin" name="new_pin">
			</td>
			<td align="right">
				Re-type New PIN<span style="color:red">*</span>:
			</td>
			<td>
				<input type="text" id="retypenew_pin" name="retypenew_pin">
			</td>
		</tr>
		<tr>
			<td align="right">
				First Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="firstname" name="firstname">
			</td>
		</tr>
		<tr>
			<td align="right"> 
				Last Name<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="lastname" name="lastname">
			</td>
		</tr>
		<tr>
			<td align="right">
				Address<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="address" name="address">
			</td>
		</tr>
		<tr>
			<td align="right">
				City<span style="color:red">*</span>:
			</td>
			<td colspan="3">
				<input type="text" id="city" name="city">
			</td>
		</tr>
		<tr>
			<td align="right">
				State<span style="color:red">*</span>:
			</td>
			<td>
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
			<td>
				<input type="text" id="zip" name="zip">
			</td>
		</tr>
		<tr>
			<td align="right">
				Credit Card<span style="color:red">*</span>:
			</td>
			<td>
				<select id="credit_card" name="credit_card">
				<option selected disabled>select a card type</option>
				<option>VISA</option>
				<option>MASTER</option>
				<option>DISCOVER</option>
				</select>
			</td>
			<td align="left" colspan="2">
				<input type="text" id="card_number" name="card_number" placeholder="Credit card number">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				Expiration Date<span style="color:red">*</span>:
			</td>
			<td colspan="2" align="left">
				<input type="text" id="expiration_date" name="expiration_date" placeholder="MM/YY">
			</td>
		</tr>
		<tr>
			<td align="right" colspan="2">
				<input type="submit" id="update_submit" name="update_submit" value="Update">
			</td>
			</form>
		<form id="cancel" action="confirm_order.php" method="post">	
			<td align="left" colspan="2">
				<input type="submit" id="cancel_submit" name="cancel_submit" value="Cancel">
			</td>
		</tr>
	</table>
	</form>
</body>
</html>