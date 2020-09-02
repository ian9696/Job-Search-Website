<?php

	session_start();

	require("accessDB.php");
	require("CheckField.php");

	if(isset($_SESSION['login_as']) && $_SESSION['login_as']=="employer" && isset($_POST['jobID']) && jobEmployerMatch($_POST['jobID'], $_SESSION['id']) && isset($_POST['occupation_id']))
	{
		if (preg_match('/^[0-9]+$/', $_POST['salary']) && $_POST['salary']<=2147483647 && CheckExperience($_POST['experience']) && CheckWorkingTime($_POST['working_time']) && CheckEducation($_POST['education']))
		{
			$db = connectToDB();
			$sql= "UPDATE recruit SET occupation_id=?, location_id=?, working_time=?, education=?, experience=?, salary=? WHERE id=?";
			$sth= $db->prepare($sql);
			$sth->execute(array($_POST['occupation_id'], $_POST['location_id'], $_POST['working_time'],
								$_POST['education'], $_POST['experience'], $_POST['salary'], $_POST['jobID']));
			header('Location: HomePage.php');
		}
		else
		{
			echo "salary must be an integer between 0 and 2147483647!<br>";
		}
	}
	
	if(isset($_SESSION['login_as']) && $_SESSION['login_as']=="employer" && isset($_POST['jobID']) && jobEmployerMatch($_POST['jobID'], $_SESSION['id']))
	{
		displayGreeting();
		displayJobVacancyForEdit();
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
	else if(isset($_SESSION['login_as']) && $_SESSION['login_as']=="employer")
	{
		echo "please choose a job to edit!<br>";
	}
	else
	{
		echo "please log in as employer!<br>";
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
	
	function displayJobVacancyForEdit()
	{
		echo	"<table width=\"100%\">".
					"<tr>".
						"<td align=\"center\">Job Vacancy</td>".
					"</tr>".
				"</table>";
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
			
			if($row['id']!=$_POST['jobID'])
			{
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
			else
			{

				$occupation = accessTable($db, "occupation");
				$location = accessTable($db, "location");

		echo		"<tr bgcolor=\"F098FF\">";
		echo	"<form action=\"EditJob.php\" method=\"POST\" id=\"EditJobForm\" style=\"width: 100%\">";
		echo			"<td>".
							$row['id'].
							"<input type=\"hidden\" name=\"jobID\" value=\"".$_POST['jobID']."\" form=\"EditJobForm\"></input>".
						"</td>".
						"<td>".
							"<select name=\"occupation_id\" form=\"EditJobForm\">";
		foreach($occupation as $rowTemp)
		{
			if($row['occupation']!=$rowTemp['occupation'])
				echo			"<option value=\"".$rowTemp['id']."\">".$rowTemp['occupation']."</option>";
			else
				echo			"<option value=\"".$rowTemp['id']."\" selected=\"selected\">".$rowTemp['occupation']."</option>";
		}
		echo				"</select>".
						"</td>".
						"<td>".
							"<select name=\"location_id\" form=\"EditJobForm\">";
		foreach($location as $rowTemp)
		{
			if($row['location']!=$rowTemp['location'])
				echo			"<option value=\"".$rowTemp['id']."\">".$rowTemp['location']."</option>";
			else
				echo			"<option value=\"".$rowTemp['id']."\" selected=\"selected\">".$rowTemp['location']."</option>";
		}
		echo				"</select>".
						"</td>".
						"<td>".
							"<select name=\"working_time\" form=\"EditJobForm\">".
								"<option value=\"Morning\"".($row['working_time']=="Morning"?" selected=\"selected\"":"").">Morning</option>".
								"<option value=\"Afternoon\"".($row['working_time']=="Afternoon"?" selected=\"selected\"":"").">Afternoon</option>".
								"<option value=\"Night\"".($row['working_time']=="Night"?" selected=\"selected\"":"").">Night</option>".
							"</select>".
						"</td>".
						"<td>".
							"<select name=\"education\" form=\"EditJobForm\">".
								"<option value=\"Elementary School\"".($row['education']=="Elementary School"?" selected=\"selected\"":"").">Elementary School</option>".
								"<option value=\"High School\"".($row['education']=="High School"?" selected=\"selected\"":"").">High School</option>".
								"<option value=\"UnderGraduate School\"".($row['education']=="UnderGraduate School"?" selected=\"selected\"":"").">UnderGraduate School</option>".
								"<option value=\"Graduate School\"".($row['education']=="Graduate School"?" selected=\"selected\"":"").">Graduate School</option>".
							"</select>".
						"</td>".
						"<td>".
							"<select name=\"experience\" form=\"EditJobForm\">".
								"<option value=\"0\"".($row['experience']=="0"?" selected=\"selected\"":"").">No experience required</option>".
								"<option value=\"1\"".($row['experience']=="1"?" selected=\"selected\"":"").">1 year</option>".
								"<option value=\"2\"".($row['experience']=="2"?" selected=\"selected\"":"").">2 years</option>".
								"<option value=\"3\"".($row['experience']=="3"?" selected=\"selected\"":"").">3 years</option>".
							"</select>".
						"</td>".
						"<td>".
							"<input type=\"text\" name=\"salary\" value=\"".$row['salary']."\" form=\"EditJobForm\"></input>".
						"</td>".
						"<td align=\"center\">".
							"<input type=\"submit\" value=\"Update\" form=\"EditJobForm\"/>".
						"</td>";
				echo	"</form>";
				echo	"<td align=\"center\">".
							"<a href=\"HomePage.php\"><input type=\"button\" value=\"Cancel\" /></a>".
						"</td>".
					"</tr>";
			}
		}
		echo	"</table>";
		echo	"</form>";
	}
?>