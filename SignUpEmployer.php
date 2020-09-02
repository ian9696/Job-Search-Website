<?php
	session_start();
	require("accessDB.php");
	
	if(isset($_SESSION['account']))
	{
		echo "You have already logged in!<br>";
		echo "<a href=\"HomePage.php\"><input type=\"button\" value=\"Back to HomePage.\" /></a><br>";
		exit;
	}
?>
	
<html>
	<body>
	<h2> EMPLOYER SIGN UP PAGE </h2>
	<hr/>
	
	<p>
	<img src="img6.gif" width= "30%" />
	</p>
	
	<h2> Fill in the blank </h2>
	<br>
		<form action= "EmployerSignUpSuccess.php" method= "POST">
		<table cellspacing= "50" >
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
					<big><em>phone:</em></big>
					<br>
					<input type= "text" name= "phone"></input>
				</td>
				<td>
					<big><em>E-mail:</em></big>
					<br>
					<input type= "text" name= "email"></input>
				</td>
			</tr>
		</table>
		<input type= "submit" value= "enter"></input>
		</form>
		
		<a href="HomePage.php"><input type="button" value="Back to HomePage." /></a><br>
		
	</body>
</html>
	