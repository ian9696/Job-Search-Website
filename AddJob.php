<?php

	session_start();

	require("accessDB.php");
	require("CheckField.php");

	if(isset($_SESSION['login_as']) && $_SESSION['login_as']=="employer" && isset($_POST['employer_id']))
	{
		if($_SESSION['id']==$_POST['employer_id'])
		{
			if (preg_match('/^[0-9]+$/', $_POST['salary']) && $_POST['salary']<=2147483647 && CheckExperience($_POST['experience']) && CheckWorkingTime($_POST['working_time']) && CheckEducation($_POST['education']))
			{
				$db = connectToDB();
				$sql= "INSERT INTO recruit(employer_id, occupation_id, location_id, working_time, education, experience, salary)"
						  ."VALUES(?, ?, ?, ?, ?, ?, ?)";
				$sth= $db->prepare($sql);
				$sth->execute(array($_POST['employer_id'], $_POST['occupation_id'], $_POST['location_id'], $_POST['working_time'],
									$_POST['education'], $_POST['experience'], $_POST['salary']));
								
				header('Location: HomePage.php');
			}
			else
			{
				echo "salary must be an integer between 0 and 2147483647!<br>";
			}
		}
		else
		{
			echo "That's not your id!<br>";
		}
	}
	
	displayGreeting();
	
	if(isset($_SESSION['account']) && $_SESSION['login_as']=="employer")
	{
		echo	"<table width=\"100%\">".
					"<tr>".
						"<td align=\"center\">Job Vacancy</td>".
					"</tr>".
				"</table>";
		displayJobVacancyForAdd();
		
		echo	"<table width=\"25%\">".
					"<tr>".
						"<td align=\"center\">".
							"<form action=\"JobSeekerList.php\" method=\"POST\">".
								"<input type=\"submit\" value=\"Job Seeker List\" />".
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
		echo "To add a new job, please log in as employer first!<br>";
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
	
	function displayJobVacancyForAdd()
	{
		echo	"<table width=\"100%\" cellpadding=\"10\" cellspacing=\"0\" border=\"1\">".
					"<tr bgcolor=\"#BFFFBF\">".
						"<td>ID</td>".
						"<td>Occupation</td>".
						"<td>Location</td>".
						"<td>Work Time</td>".
						"<td>Education Required</td>".
						"<td>Minimum of Working Experience</td>".
						"<td>Salary per Month</td>".
						"<td align=\"center\">Operation 1</td>".
						"<td align=\"center\">Operation 2</td>".
					"</tr>";
		$db = connectToDB();
		foreach(accessTable($db, "recruit") as $row)
		{
			$temp = accessRow($db, "occupation", "id", $row['occupation_id']);
			$row['occupation'] = $temp[0]['occupation'];
			$temp = accessRow($db, "location", "id", $row['location_id']);
			$row['location'] = $temp[0]['location'];
		
			echo	"<tr bgcolor=\"#FFF9C3\">".
						"<td>".$row['id']."</td>".
						"<td>".$row['occupation']."</td>".
						"<td>".$row['location']."</td>".
						"<td>".$row['working_time']."</td>".
						"<td>".$row['education']."</td>".
						"<td>".($row['experience']==0?"No experience required":$row['experience']." year".($row['experience']>=2?"s":""))."</td>".
						"<td>".$row['salary']."</td>".
						"<td></td>".
						"<td></td>".
					"</tr>";
		}

		$occupation = accessTable($db, "occupation");
		$location = accessTable($db, "location");

		echo		"<tr bgcolor=\"FFA4D2\">";
		echo	"<form action=\"AddJob.php\" method=\"POST\" id=\"newJobForm\" style=\"width: 100%;\">";
		echo			"<td>".
							"<input type=\"hidden\" name=\"employer_id\" value=\"".$_SESSION['id']."\" form=\"newJobForm\"></input>".
						"</td>".
						"<td>".
							"<select name=\"occupation_id\" form=\"newJobForm\">";
		foreach($occupation as $row)
			echo				"<option value=\"".$row['id']."\">".$row['occupation']."</option>";
		echo				"</select>".
						"</td>".
						"<td>".
							"<select name=\"location_id\" form=\"newJobForm\">";
		foreach($location as $row)
			echo				"<option value=\"".$row['id']."\">".$row['location']."</option>";
		echo				"</select>".
						"</td>".
						"<td>".
							"<select name=\"working_time\" form=\"newJobForm\">".
								"<option value=\"Morning\">Morning</option>".
								"<option value=\"Afternoon\">Afternoon</option>".
								"<option value=\"Night\">Night</option>".
							"</select>".
						"</td>".
						"<td>".
							"<select name=\"education\" form=\"newJobForm\">".
								"<option value=\"Elementary School\">Elementary School</option>".
								"<option value=\"High School\">High School</option>".
								"<option value=\"UnderGraduate School\">UnderGraduate School</option>".
								"<option value=\"Graduate School\">Graduate School</option>".
							"</select>".
						"</td>".
						"<td>".
							"<select name=\"experience\" form=\"newJobForm\">".
								"<option value=\"0\">No experience required</option>".
								"<option value=\"1\">1 year</option>".
								"<option value=\"2\">2 years</option>".
								"<option value=\"3\">3 years</option>".
							"</select>".
						"</td>".
						"<td>".
							"<input type=\"text\" name=\"salary\" form=\"newJobForm\"></input>".
						"</td>".
						"<td align=\"center\">".
							"<input type=\"submit\" value=\"Save\" form=\"newJobForm\"></input>".
						"</td>";
		echo		"</form>";
		echo		"<form action=\"HomePage.php\" method=\"POST\" id=\"HomePageForm\">".
						"<td align=\"center\">".
							"<input type=\"submit\" value=\"Cancel\" form=\"HomePageForm\"></input>".
						"</td>".
					"</form>".
					"</tr>".
				"</table>";
	}
?>