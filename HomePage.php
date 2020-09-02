<?php

	session_start();
	
	require('accessDB.php');

?>

<html>
	<head>
		<title>HomePage</title>
	</head>
	
	<body>
		<table width= "100%">
			<tr>
			<td>
			<img src="c.png" width= "80%"/>
			</td>
			</tr>
		</table>
	</body>
	
	<body>
<?php
	
	if(isset($_SESSION['account']) && $_SESSION['login_as']=="employer" && !isset($_POST['salary_search']) && !isset($_POST['Search_pressed']))
	{
		displayJobVacancyForEmployer();
	}
	else if(isset($_SESSION['account']) && $_SESSION['login_as']=="user" && !isset($_POST['salary_search']) && !isset($_POST['Search_pressed']))
	{
		displayJobVacancyForUser();
	}
	else if(isset($_POST['salary_search']) || isset($_POST['Search_pressed']))
	{
		displayJobVacancyForSearch();
	}
	else
	{
		displayJobVacancy();
	}
	if(!isset($_SESSION['account']))
		displayLoginForm();
	displayGreeting();
?>
	</body>
	<body>
		<table width= "100%">
			<tr>
			<td>
			<img src="b2.gif" width= "50%"/>
			</td>
			</tr>
		</table>
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

	function displayJobVacancyForUser()
	{
		ShowForm();
?>

		<table width="100%" cellpadding="12" cellspacing="0" border="1">
			<tr bgcolor="#BFFFBF">
				<td>ID</td>
				<td>Occupation</td>
				<td>Location</td>
				<td>Work Time</td>
				<td>Education Required</td>
				<td>Minimum of Working Experience</td>
				<td>Salary per Month
					<br> 
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Asc">
							<input type= "submit" value= "Ascending">
						</form>
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Desc">
							<input type= "submit" value= "Descending">
						</form>
				</td>
				<td align="center">Operation 1</td>
				<td align="center">Operation 2</td>
			</tr>
<?php
		$db = connectToDB();
		
		if(isset($_POST['Asc']))
			$table = accessTableAsc($db, "recruit");
		else if(isset($_POST['Desc']))
			$table = accessTableDes($db, "recruit");
		else
			$table = accessTable($db, "recruit");
		
		foreach($table as $row)
		{
			PrintTable($db, $row);
			showUserCommand($db, $row);
			echo "</tr>";
		}
?>
		</table>
		<table width="15%">
			<tr>
				<td align="center">
					<form action="FavoriteList.php" method="POST">
						<input type="submit" value="Favorite List" />
					</form>
				</td>
			</tr>
		</table>
<?php
	}
		
	function displayJobVacancyForEmployer()
	{
		ShowForm();
?>

		<table width="100%" cellpadding="12" cellspacing="0" border="1">
			<tr bgcolor="#BFFFBF">
				<td>ID</td>
				<td>Occupation</td>
				<td>Location</td>
				<td>Work Time</td>
				<td>Education Required</td>
				<td>Minimum of Working Experience</td>
				<td>Salary per Month
					<br> 
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Asc">
							<input type= "submit" value= "Ascending">
						</form>
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Desc">
							<input type= "submit" value= "Descending">
						</form>
				</td>
				<td>Operation 1</td>
				<td>Operation 2</td>
			</tr>
<?php
		$db = connectToDB();
		if(isset($_POST['Asc']))
		{
			foreach(accessTableAsc($db, "recruit") as $row)
			{
				PrintTable($db, $row);
				if($row['employer_id']==$_SESSION['id'])
				{
					ShowEmployerCommand($row);
				}
				else
				{
					echo "<td></td>";
					echo "<td></td>";
				}
				echo "</tr>";
			}
		}
		else if(isset($_POST['Desc']))
		{
			foreach(accessTableDes($db, "recruit") as $row)
			{
				PrintTable($db, $row);
				if($row['employer_id']==$_SESSION['id'])
				{
					ShowEmployerCommand($row);
				}
				else
				{
					echo "<td></td>";
					echo "<td></td>";
				}
				echo "</tr>";
			}
		}
		else
		{
			foreach(accessTable($db, "recruit") as $row)
			{
				PrintTable($db, $row);
				if($row['employer_id']==$_SESSION['id'])
				{
					ShowEmployerCommand($row);
				}
				else
				{
					echo "<td></td>";
					echo "<td></td>";
				}
				echo "</tr>";
			}
		}
?>
		</table>
		<table width="35%">
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
				<td align="center">
					<form action="JobApplicationList.php" method="POST">
						<input type="submit" value="Who Applies Your Job" />
					</form>
				</td>
			</tr>
		</table>
<?php
	}
	
	function displayJobVacancy()
	{
		ShowForm();
?>
		<table width="100%" cellpadding="12" cellspacing="0" border="1">
			<tr bgcolor="#BFFFBF">
				<td>ID</td>
				<td>Occupation</td>
				<td>Location</td>
				<td>Work Time</td>
				<td>Education Required</td>
				<td>Minimum of Working Experience</td>
				<td>Salary per Month
					<br> 
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Asc">
							<input type= "submit" value= "Ascending">
						</form>
						<form action= "HomePage.php" method= "POST">
							<input type= "hidden" name= "Desc">
							<input type= "submit" value= "Descending">
						</form>
				</td>
			</tr>
<?php
		$db = connectToDB();
			if(isset($_POST['Asc']))
			{
				foreach(accessTableAsc($db, "recruit") as $row)
				{
					PrintTable($db, $row);
					echo "</tr>";
				}
			}
			else if(isset($_POST['Desc']))
			{
				foreach(accessTableDes($db, "recruit") as $row)
				{
					PrintTable($db, $row);
					echo "</tr>";
				}
			}
			else
			{
				foreach(accessTable($db, "recruit") as $row)
				{
					PrintTable($db, $row);
					echo "</tr>";
				}
			}
?>
		</table>
<?php
	}

	function displayLoginForm()
	{
?>
		<table width="100%" cellpadding="0" cellspacing="0" border="0">
			<tr bgcolor="#8EF3FF">
				<td align="center">
					<form action="Login.php" method="POST">
						<br>
						<font size="4">Employer</font><br>
						<font size="4">Looking for a staff?</font><br><br>
						<input type="text" name="account_employer" placeholder="Account" size="20" /><br><br>
						<input type="password" name="password_employer" placeholder="Password" size="20" /><br><br>
						<input type="submit" value="         Log in         " /><br>
					</form>
					<form action="SignUpEmployer.php" method="POST">
						<input type="submit" value="    Sign up now    " /> 
					</form>
				</td>
				<td align="center">
					<form action="Login.php" method="POST">
						<br>
						<font size="4">Job Seeker</font><br>
						<font size="4">Fill in your resume right now!</font><br><br>
						<input type="text" name="account_user" placeholder="Account" size="20" /><br><br>
						<input type="password" name="password_user" placeholder="Password" size="20" /><br><br>
						<input type="submit" value="         Log in         " /><br>
					</form>
					<form action="SignUpUser.php" method="POST">
						<input type="submit" value="    Sign up now    " /> 
					</form>
				</td>
			</tr>
		</table>
<?php
	}
	
	function displayJobVacancyForSearch()
	{	
		$occupation_id= 0;
		$location_id= 0;
		$newarray = array();

		if(isset($_POST['Search_pressed']))
		{
			foreach($_POST['Search_pressed'] as $value)
			{
				if(preg_match("/^([0-9]+)$/", $value))
					array_push($newarray, (int)$value);
				else
					array_push($newarray, $value);
			}
				
		}
		
		$db= connectToDB();
		
		ShowForm();
		
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
<?php
				if($_SESSION['login_as']=="employer" || $_SESSION['login_as']=="user")
				{
?>
					<td>Operation1</td>
					<td>Operation2</td>
<?php
				}
?>
			</tr>
<?php
		
		
		if(isset($_POST['Asc']))
		{
			//$sql2 = $sql." ORDER BY salary ASC";
			
			foreach(accessRowVar2($db, "recruit", $newarray) as $row)
			{
				PrintTable($db, $row);
				if($_SESSION['login_as']=="employer")
				{
					if($row['employer_id']==$_SESSION['id'])
					{
						ShowEmployerCommand($row);
					}
					else
					{
						echo "<td></td>";
						echo "<td></td>";
					}
				}
				else if($_SESSION['login_as']=="user")
				{
					ShowUserCommand($db, $row);
				}
				echo "</tr>";
			}
		}
		else if(isset($_POST['Desc']))
		{
			//$sql2 = $sql." ORDER BY salary DESC";

			foreach(accessRowVar2($db, "recruit", $newarray) as $row)
			{
				PrintTable($db, $row);
				if($_SESSION['login_as']=="employer")
				{
					if($row['employer_id']==$_SESSION['id'])
					{
						ShowEmployerCommand($row);
					}
					else
					{
						echo "<td></td>";
						echo "<td></td>";
					}
				}
				else if($_SESSION['login_as']=="user")
				{
					ShowUserCommand($db, $row);
				}
				echo "</tr>";
			}
		}
		else
		{
            $occupation_id = GetOccupationID($db);
            $location_id = GetLocationID($db);
            
			$newarray = inputarray($newarray, $occupation_id, $location_id, $_POST['worktime_search'], $_POST['education_search'], $_POST['experience_search'], $_POST['salary_search']);
			
			//$sql= GetSqlCommand("recruit", $newarray);
			
			foreach(accessRowVar2($db, "recruit", $newarray) as $row)
			{
				PrintTable($db, $row);
				if($_SESSION['login_as']=="employer")
				{
					if($row['employer_id']==$_SESSION['id'])
					{
						ShowEmployerCommand($row);
					}
					else
					{
						echo "<td></td>";
						echo "<td></td>";
					}
				}
				else if($_SESSION['login_as']=="user")
				{
					ShowUserCommand($db, $row);
				}
				echo "</tr>";
			}
		}
		
?>
		</table>
		<br> 
			<form action= "HomePage.php" method= "POST">
				<input type= "hidden" name= "Asc">
<?php
				foreach($newarray as $value)
					echo "<input type= \"hidden\" name= \"Search_pressed[]\" value= \"$value\">";
?>
				<input type= "submit" value= "Ascending">
			</form>
			<form action= "HomePage.php" method= "POST">
				<input type= "hidden" name= "Desc">
<?php
				foreach($newarray as $value)
					echo "<input type= \"hidden\" name= \"Search_pressed[]\" value= \"$value\">";
?>
				<input type= "submit" value= "Descending">
			</form>
<?php
		if($_SESSION['login_as']=="employer")
		{
?>
		<table width="35%">
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
				<td align="center">
					<form action="JobApplicationList.php" method="POST">
						<input type="submit" value="Who Applies Your Job" />
					</form>
				</td>
			</tr>
		</table>

<?php
		}
		else if($_SESSION['login_as']=="user")
		{
?>
		<table width="15%">
			<tr>
				<td align="center">
					<form action="FavoriteList.php" method="POST">
						<input type="submit" value="Favorite List" />
					</form>
				</td>
			</tr>
		</table>
<?php
		}
	}

	function PrintTable($db, $row)
	{
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
	}
	
	function inputarray($newarray, $occupation_id, $location_id, $worktime_search, $education_search, $experience_search, $salary_search)
	{
		if($_POST['occupation_search'] != "")
			array_push($newarray, "occupation_id", (int)$occupation_id);
		if($_POST['location_search'] != "")
			array_push($newarray, "location_id", (int)$location_id);
		if($worktime_search !== "")
			array_push($newarray, "working_time", $worktime_search);
		if($education_search !== "")
			array_push($newarray, "education", $education_search);
		if(preg_match("/^([0-3])$/", $_POST['experience_search']))
			array_push($newarray, "experience", (int)$experience_search);
		else if($_POST['experience_search'] !== "")
			array_push($newarray, "experience", -1);
		if(preg_match("/^([0-9]+)$/", $_POST['salary_search']))
			array_push($newarray, "salary", (int)$salary_search);
		else if($_POST['salary_search'] !== "")
			array_push($newarray, "salary", -1);
		
		return $newarray;
	}
	
	function ShowEmployerCommand($row)
	{
?>
		<form action="EditJob.php" method="POST">
			<td align="center">
				<input type="submit" value="Edit" /> 
				<input type="hidden" name="jobID" value="<?php echo $row['id'] ?>" />
			</td>
		</form>
		<form action="DeleteJob.php" method="POST">
			<td align="center">
				<input type="submit" value="Delete" />
				<input type="hidden" name="jobID" value="<?php echo $row['id'] ?>" />
			</td>
		</form>
<?php
	}
	
	function ShowUserCommand($db, $row)
	{
			$temp = accessRow2($db, "application", "user_id", $_SESSION['id'], "recruit_id", $row['id']);
			if(isset($temp[0]))
				echo "<td align=\"center\">Waiting for employer</td>";
			else
			{
?>
					<form action="ApplyJob.php" method="POST">
						<td align="center">
							<input type="submit" value="Apply" /> 
							<input type="hidden" name="jobID" value="<?php echo $row['id'] ?>" />
						</td>
					</form>
<?php
			}

			$temp = accessRow2($db, "favorite", "user_id", $_SESSION['id'], "recruit_id", $row['id']);
			if(isset($temp[0]))
				echo "<td align=\"center\">Already in favorite list</td>";
			else
			{
?>
					<form action="AddFavorite.php" method="POST">
						<td align="center">
							<input type="submit" value="Favorite" />
							<input type="hidden" name="jobID" value="<?php echo $row['id'] ?>" />
						</td>
					</form>
<?php
			}
	}

	function ShowForm()
	{
		echo	"<table width=\"100%\">".
					"<tr>".
						"<td align=\"center\">Job Vacancy</td>".
					"</tr>".
				"</table>";
				
		echo 	"<table width= \"100%\">".
					"<tr>".
						"<form action= \"HomePage.php\" method= \"POST\">".
							"<td>".
								"<input type= \"text\" name= \"occupation_search\" placeholder= \"Occupation\" size= \"20\">".
							"</td>".
							"<td>".
								"<input type= \"text\" name= \"location_search\" placeholder= \"Location\" size= \"20\">".
							"</td>".
							"<td>".
								"<input type= \"text\" name= \"worktime_search\" placeholder= \"Work Time\" size= \"20\">".
							"</td>".
							"<td>".
								"<input type= \"text\" name= \"education_search\" placeholder= \"Education Required\" size= \"20\">".
							"</td>".
							"<td>".
								"<input type= \"text\" name= \"experience_search\" placeholder= \"Working Experience\" size= \"20\">".
							"</td>".
							"<td>".
								"<select name= \"salary_search\">".
									"<option value= \"2147483647\"> not limited </option>".
									"<option value= \"10000\"> <=10000 </option>".
									"<option value= \"40000\"> <=40000 </option>".
									"<option value= \"70000\"> <=70000 </option>".
									"<option value= \"100000\"> <=100000 </option>".
								"</select>".
							"</td>".
							"<td>".
								"<input type= \"submit\" value= \"Search\" />".
							"</td>".
						"</form>".
					"</tr>".
				"</table>";
	}
?>
