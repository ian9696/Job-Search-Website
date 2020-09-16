<?php

	session_start();
	
	require('accessDB.php');

?>

<html>
	<head>
		<title>Who Applies For Your Job</title>
	</head>
	
	<body>
<?php
	if(isset($_SESSION['account']) && $_SESSION['login_as']=="employer")
	{
		displayGreeting();
		displayJobApplicationList();
?>
		</table>
		<table width="25%">
			<tr>
				<td align="center">
					<form action="AddJob.php" method="POST">
						<input type="submit" value="Add a New Job" />
					</form>
				</td>
				<td align="center">
					<form action="JobSeekerList.php" method="POST">
						<input type="submit" value="Job Seeker List" />
					</form>
				</td>
			</tr>
		</table>
<?php
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

	
	function displayJobApplicationList()
	{
		echo	"<table width=\"100%\">".
					"<tr>".
						"<td align=\"center\">Who Applies For Your Job</td>".
					"</tr>".
				"</table>";

		$db = connectToDB();
		foreach(accessRow($db, "recruit", "employer_id", $_SESSION['id']) as $row)
		{
			$temp = accessRow($db, "occupation", "id", $row['occupation_id']);
			$row['occupation'] = $temp[0]['occupation'];
			$temp = accessRow($db, "location", "id", $row['location_id']);
			$row['location'] = $temp[0]['location'];
		
			echo "<table width=\"100%\" cellpadding=\"12\" cellspacing=\"0\" border=\"1\">".
					"<tr bgcolor=\"#D7FFFF\">".
						"<td style=\"width:7%\">".$row['occupation']."</td>".
						"<td style=\"width:7%\">".$row['location']."</td>".
						"<td style=\"width:7%\">".$row['working_time']."</td>".
						"<td style=\"width:15%\">".$row['education']."</td>".
						"<td style=\"width:10%\">".$row['salary']."</td>".
						"<td style=\"width:13%\">".($row['experience']==0?"No experience required":$row['experience']." year".($row['experience']>=2?"s":""))."</td>".
						"<td style=\"width:17%\"></td>".
						"<td style=\"width:13%\"></td>".
						"<td style=\"width:11%\"></td>".
					"</tr>";
			foreach(accessRow($db, "application", "recruit_id", $row['id']) as $applicationTemp)
			{
				$userTemp = accessRow($db, "user", "id", $applicationTemp['user_id']);
				$userTemp = $userTemp[0];
				$specialty = accessRow($db, "user_specialty", "user_id", $userTemp['id']);
				
				echo	"<tr bgcolor=\"#FFF9F2\">".
							"<td>".$userTemp['account']."</td>".
							"<td>".$userTemp['gender']."</td>".
							"<td>".$userTemp['age']."</td>".
							"<td>".$userTemp['education']."</td>".
							"<td>".$userTemp['expected_salary']."</td>".
							"<td>".$userTemp['phone']."</td>".
							"<td>".$userTemp['email']."</td>".
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
				echo		"</td>";
				echo		"<form action=\"HireUser.php\" method=\"POST\">".
								"<td align=\"center\">".
									"<input type=\"submit\" value=\"Hire\" />".
									"<input type=\"hidden\" name=\"jobID\" value=\"".$row['id']."\" />".
									"<input type=\"hidden\" name=\"userID\" value=\"".$userTemp['id']."\" />".
								"</td>".
							"</form>";
				echo	"</tr>";
			}
			echo "</table><br>";
		}
	}
	
?>