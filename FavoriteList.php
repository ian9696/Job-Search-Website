<?php

	session_start();
	
	require('accessDB.php');

?>

<html>
	<head>
		<title>Favorite List</title>
	</head>

	<body>
<?php
	if(isset($_SESSION['account']) && $_SESSION['login_as']=="user")
	{
		displayGreeting();
		displayFavoriteList();
	}
	else
	{
		echo "invalid access!<br>";
	}
	
	echo '<a href="HomePage.php"><input type="button" value="Back to Home Page" /></a><br>';
?>
	</body>
</html>

<?php

	function displayGreeting()
	{
		if(isset($_SESSION['account']))
		{
			$account = $_SESSION['account'];
			echo "Hello! $account<br>";
			echo '<a href="Logout.php"><input type="button" value="Log out" /></a><br>';
		}
		else
		{
			echo "Hello!<br>";
		}
	}

	function displayFavoriteList()
	{
		echo	"<table width=\"100%\">".
					"<tr>".
						"<td align=\"center\">Favorite List</td>".
					"</tr>".
				"</table>";
?>

		<table width="100%" cellpadding="12" cellspacing="0" border="1">
			<tr bgcolor="#BFFFBF">
				<td>ID</td>
				<td>Occupation</td>
				<td>Location</td>
				<td>Work Time</td>
				<td>Education Required</td>
				<td>Minimum of Working Experience</td>
				<td>Salary per Month</td>
				<td align="center">Operation</td>
			</tr>
<?php
		$db = connectToDB();
		foreach(accessRow($db, "favorite", "user_id", $_SESSION['id']) as $row)
		{
			$temp = accessRow($db, "recruit", "id", $row['recruit_id']);
			$row = $temp[0];
			$temp = accessRow($db, "occupation", "id", $row['occupation_id']);
			$row['occupation'] = $temp[0]['occupation'];
			$temp = accessRow($db, "location", "id", $row['location_id']);
			$row['location'] = $temp[0]['location'];
		
			echo "<tr bgcolor=\"#FFF9C3\">".
					"<td>".$row['id']."</td>".
					"<td>".$row['occupation']."</td>".
					"<td>".$row['location']."</td>".
					"<td>".$row['working_time']."</td>".
					"<td>".$row['education']."</td>".
					"<td>".($row['experience']==0?"No experience required":$row['experience']." year".($row['experience']>=2?"s":""))."</td>".
					"<td>".$row['salary']."</td>";
?>
					<form action="DeleteFavorite.php" method="POST">
						<td align="center">
							<input type="submit" value="Delete" /> 
							<input type="hidden" name="jobID" value="<?php echo $row['id'] ?>" />
						</td>
					</form>
<?php
			echo "</tr>";
		}
?>
		</table>
<?php
	}
	
?>