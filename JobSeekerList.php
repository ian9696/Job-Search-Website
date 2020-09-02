<?php

	session_start();

	require("accessDB.php");

	displayGreeting();
	
	if(isset($_SESSION['account']) && $_SESSION['login_as']=="employer")
	{
		displayJobSeeker();
		
		echo	"<table width=\"25%\">".
						"<tr>".
							"<td align=\"center\">".
								"<form action=\"AddJob.php\" method=\"POST\">".
									"<input type=\"submit\" value=\"Add a New Job\" />".
								"</form>".
							"</td>".
							"<td align=\"center\">".
								"<form action=\"JobApplicationList.php\" method=\"POST\">".
									"<input type=\"submit\" value=\"Who Applies Your Job\" />".
								"</form>".
							"</td>".
						"</tr>".
					"</table>";
	}
	else
	{
		echo "To view Job Seeker List, please log in as employer first!<br>";
	}
	
	
	echo '<a href="HomePage.php"><input type="button" value="Back to Home Page" /></a><br>';
	
?>

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
	
	function displayJobSeeker()
	{
?>
		<table width="100%">
			<tr>
				<td align="center">Job Seeker List</td>
			</tr>
		</table>
		<table width="100%" cellpadding="12" cellspacing="0" border="1">
			<tr bgcolor="#A4FFFD">
				<td>ID</td>
				<td>Name</td>
				<td>Gender</td>
				<td>Age</td>
				<td>Education</td>
				<td>Expected Salary per Month</td>
				<td>Phone Number</td>
				<td>Email</td>
				<td>Specialty</td>
			</tr>
<?php
		$db = connectToDB();
		foreach(accessTable($db, "user") as $row)
		{
			$specialty = accessRow($db, "user_specialty", "user_id", $row['id']);
		
			echo "<tr bgcolor=\"#FFF9C3\">".
					"<td>".$row['id']."</td>".
					"<td>".$row['account']."</td>".
					"<td>".$row['gender']."</td>".
					"<td>".$row['age']."</td>".
					"<td>".$row['education']."</td>".
					"<td>".$row['expected_salary']."</td>".
					"<td>".$row['phone']."</td>".
					"<td>".$row['email']."</td>".
					"<td>";
			$i = 1;
			foreach($specialty as $specialtyRow)
			{
				if($i>=2)
					echo "<br>";
				$i++;

				$specialtyTemp = accessRow($db, "specialty", "id", $specialtyRow['specialty_id']);
				echo $specialtyTemp[0]['specialty'];
			}
			echo	"</td>".
				 "</tr>";
		}
?>
		</table>
<?php
	}

?>