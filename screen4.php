

<?php
	include_once 'includes/dbh.inc.php';
	$url = $_SERVER['REQUEST_URI'];
	$parts = parse_url($url);
	parse_str($parts['query'], $query);
	$isbn = $query['isbn'];
	$title = $query['title'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Book Reviews - 3-B.com</title>
<style>
.field_set
{
	border-style: inset;
	border-width:4px;
}
.reviews_text td {
	border: 1px solid blue;
}
</style>
</head>
<body>
	<table align="center" style="border:1px solid blue;">
		<tr>
			<td align="center">
				<h5> Reviews For:</h5>
			</td>
			<td align="left">
				<?php
				echo '<h5>'.$title.'</h5>';
				?>
			</td>
		</tr>
			
		<tr>
			<td colspan="2">
			<div id="bookdetails" style="overflow:scroll;height:200px;width:300px;border:1px solid black;">
			<table class="reviews_text">
				<?php
				$sql = "SELECT * FROM Reviews WHERE Book_ISBN = '$isbn';";
				$result = mysqli_query($conn, $sql);
				$resultCheck = mysqli_num_rows($result);
				if ($resultCheck > 0) {
					while ($row = mysqli_fetch_assoc($result)) {
						echo '<tr><td>'. $row['Review_text'] .'</td></tr>';
					}
				}
				?>
			</table>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="2" align="center">
				<form action="screen2.php" method="post">
					<input type="submit" value="Done">
				</form>
			</td>
		</tr>
	</table>
</body>

</html>
