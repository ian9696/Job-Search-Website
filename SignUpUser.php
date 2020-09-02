<?php
	session_start();
	require("accessDB.php");
	
	if(isset($_SESSION['account']))
	{
		echo "You have already logged in!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
	
	$db= connectToDB();
?>

<html>
	<body>
	
	<h2> USER SIGN UP PAGE </h2>
	<hr/>
	
	<p>
	<img src="img6.png" width= "25%" />
	</p>
	
	<h2> Fill in the blank </h2>
	<br>
	
		<form action= "UserSignUpSuccess.php" method= "POST">
		<table width="60%" cellspacing= "40">
			<tr>
				<td>
					<big><em>account:</em></big>
					<br>
					<input type= "text" name= "account"></input>
				</td>
				<td>
					<big><em>password:</em></big>
					<br>					
					<input type = "password" name= "password"></input>
				</td>
				<td>
					<big><em>education:</em></big> 	
					<br>					
					<select name= "education">
					<option value= "Elementary School">Elementary School</option>
					<option value= "High School">High School</option>
					<option value= "UnderGraduate School">UnderGraduate School</option>
					<option value= "Graduate School">Graduate School</option>
					</select>
				</td>
				<td>
				<big><em>expected salary:</em></big>
				<br>
				<input type= "int" name= "expected_salary"></input>
				<td>
			</tr>
			<tr>
				<td>
					<big><em>phone:</em></big>  
					<br>
					<input type= "text" name= "phone"></input>
				</td>
				<td>
					<big><em>age: </em></big>  		
					<br>
					<input type= "int" name= "age"></input>
				</td>
				<td>
					<big><em>E-mail:</em></big>
					<br>
					<input type= "text" name= "email"></input>
				</td>
				<td>
					<big><em>GENDER:</em></big>
					<br>
					<select name= "gender">
					<option value= "male">male</option>
					<option value= "female">female</option>
					</select>
				</td>
			</tr>	
			
		</table>
			<big><em>What is your specialty?</em></big>
			<br>
			<?php
				foreach(accessTable($db, "specialty") as $row)
				{
					echo "<input type= \"checkbox\" name= \"chk[]\" value= $row[id]>$row[specialty]</input>";
					echo "       ";
				}
			?>
			<br>
			<input type= "submit" value= "enter"></input>
		</form>
	
		<a href="HomePage.php"><input type="button" value="Back to HomePage." /></a><br>
		
	</body>
</html>
	