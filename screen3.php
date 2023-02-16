
<?php
	include_once 'includes/dbh.inc.php';
	session_start();
	$url = $_SERVER['REQUEST_URI'];
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	if (array_key_exists('cartisbn', $query)) {
		$isbn = $query['cartisbn'];
		if (array_key_exists($isbn, $_SESSION['shoppingCart'])) {
			$_SESSION['shoppingCart'][$isbn]++;
		} else {
			$_SESSION['shoppingCart'][$isbn] = 1;
		}
	}
?>

<html>
<head>
	<title> Search Result - 3-B.com </title>
	<script>

	//redirect to reviews page
	function review(isbn, title){
		window.location.href="screen4.php?isbn="+ isbn + "&title=" + title;
	}
	//add to cart
	function cart(isbn, searchfor, searchon, category)
	{
		let searchon_array = searchon.split(',');
		let window_location = "screen3.php?cartisbn=" + isbn + "&searchfor=" + searchfor + "&search=Search";
		for (let i = 0; i < searchon_array.length; i++) {
			window_location += "&searchon[]=" + searchon_array[i];
		}
		window_location += "&category=" + category;
		console.log('window location: ' + window_location);
		window.location.href=window_location;
	}

</script>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="left">
				<h6> <fieldset>
				<?php
					$count = 0;
					if (array_key_exists('shoppingCart', $_SESSION)) {
						foreach($_SESSION['shoppingCart'] as $isbn => $num) {
							$count += $num;
						}
					}
					echo "Your Shopping Cart has ".$count." items";
				?>
				</fieldset></h6>
			</td>
			<td>
				&nbsp
			</td>
			<td align="right">
				<form action="shopping_cart.php" method="get">
					<input type="submit" value="Manage Shopping Cart">
				</form>
			</td>
		</tr>	
		<tr>
		<td style="width: 350px" colspan="3" align="center">
			<div id="bookdetails" style="overflow:scroll;height:180px;width:400px;border:1px solidCosc571F@ll
			 black;background-color:LightBlue">
			
<?php 
   include_once 'includes/dbh.inc.php';  
   $searchfor=$_GET['searchfor'];
   $category=$_GET['category'];
   $search=explode(',',$searchfor);
   $searchon=$_GET['searchon'];
   $i=0;
   $flag1=0;
   $flag2=0;
   $flag3=0;
   $flag4=0;
   $flag5=0;
   $sql="SELECT * FROM `Books` WHERE ( ";
 
   foreach($search as $keys)
   {
	
	   $keys=trim($keys);
	   foreach($searchon as $searchkey)
	   {
		   if($searchkey=="title")
		   {
			   if($i==0)
			   {
				   $sql.="`Title` LIKE '%".$keys."%'";
				   $i++;
			   }
			   else{
			   $sql.="OR `Title` LIKE '%".$keys."%'";
			}
		   }
		   elseif($searchkey=="author")
		   {
			   if($i==0)
			   {
				   $sql.="`Author` LIKE '%".$keys."%'";
				   $i++;
			   }
			   else{
			 $sql.="OR  `Author` LIKE '%".$keys."%'";
			}
		   }
		   elseif($searchkey=="publisher")
		   {
			   if($i==0)
			   {
				   $sql.="`Publisher` LIKE '%".$keys."%'";
				   $i++;
			   }
			   else{
			  $sql.="OR `Publisher` LIKE '%".$keys."%'";
			}
		   }
		   elseif($searchkey=="isbn")
		   {
			   if($i==0)
			   {
				   $sql.="`ISBN` LIKE '%".$keys."%'";
				   $i++;
			   }
			   else{
			   $sql.="OR `ISBN` LIKE '%".$keys."%'";
			}
		   }
		   else   
		   {
			   if($i==0)
			   {
				   $sql.="`Title` LIKE '%".$keys."%' OR `Author` LIKE '%".$keys."%' OR `Publisher` LIKE '%".$keys."%' OR `ISBN` LIKE '%".$keys."%'";
				   $i++;
			   }
			   else{
			   $sql.=" OR `Title` LIKE '%".$keys."%' OR `Author` LIKE '%".$keys."%' OR `Publisher` LIKE '%".$keys."%' OR `ISBN` LIKE '%".$keys."%'";
			}
		   }
	   }
   }
   $i=0;
       $sql.= ")";
	   if($category=='1')
	   {
		$sql.="AND (`Category`='Fantasy');";
		$result=mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
		  $flag1=1;
		}
	}
	   
	   elseif($category=='2')
	   {
		$sql.="AND (`Category`='Adventure');";
		$result=mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
		   $flag2=1 ;    
	   }
			 
		}
	   
	   elseif($category=='3')
	   {
		 $sql.="AND (`Category`='Fiction');";
		 $result=mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
		   $flag3=1 ;
	   }
			 
		}
	   
	   elseif($category=='4')
	   {
		 $sql.="AND (`Category`='Horror');";
		 $result=mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
		   $flag4=1 ;
	   }
			 
		}
	   
	   else{
		 $sql.="AND (`Category` IN ('Fiction','Horror','Adventure','Fantasy'));";
		 $result=mysqli_query($conn,$sql);
		$resultCheck = mysqli_num_rows($result);
		if($resultCheck > 0){
		   $flag5=1;
		  
	   }
			 
		}
		
   print "<table>";
   if($flag1==1||$flag2==1||$flag3==1||$flag4==1||$flag5==1)
    {
     while ($row = mysqli_fetch_assoc($result))
	 {
		$title=$row["Title"];
		$isbn=$row["ISBN"];
		$publisher=$row["Publisher"];
		$price=$row["Price"];
		$author=$row["Author"];
		
		$searchon_string = implode(',', $searchon);
	   print "<tr><td align='left'><button name='btnCart' id='btnCart' onClick='cart(\"$isbn\",\"$searchfor\",\"$searchon_string\",\"$category\")'>Add to Cart</button></td>";
       print "<td rowspan='2' align='left'>$title</br><b>By:</b>$author</br><b>Publisher:</b>$publisher</br><b>ISBN:</b>$isbn&nbsp<b>Price:</b>$price</td></tr>";
       print "<tr><td align='left'><button name='review' id='review' onClick='review(\"$isbn\",\"$title\")'>Reviews</button></td></tr>";
	   print "<tr><td colspan='2'><p>_______________________________________________</p></td></tr>";
       
    }
   } 	
   else
   {
	print "<tr><td>No results found</td></tr>";	
   }
  print "</table>"; 
?>
			
			</div>
			
			</td>
		</tr>
		<tr>
			<td align= "center">
				<form action="confirm_order.php" method="get">
					<input type="submit" value="Proceed To Checkout" id="checkout" name="checkout">
				</form>
			</td>
			<td align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="New Search">
				</form>
			</td>
			<td align="center">
				<form action="index.php" method="post">
					<input type="submit" name="exit" value="EXIT 3-B.com">
				</form>
			</td>
		</tr>
	</table>
</body>
</html>
