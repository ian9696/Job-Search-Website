<?php
	if(session_id()=="")
	{
?>
		<a href="https://www.youtube.com/channel/UCn-CFRcCkp03U8Xw0_XufdA"><img src="d.jpg" style="max-width: 90%; height: auto; width: auto\9;"></img></a>
<?php
	}
	
	function CheckEducation($education)
	{
		$array= array(
		"Elementary School"=> 1,
		"High School"=> 2,
		"UnderGraduate School"=> 3,
		"Graduate School"=> 4
		);
		
		return isset($array[$education]);
	}
	
	function CheckGender($gender)
	{
		$array= array(
		"male"=> 1,
		"female"=> 2
		);
		
		return isset($array[$gender]);
	}
	
	function CheckWorkingTime($working_time)
	{
		$array= array(
		"Morning"=> 1,
		"Afternoon"=> 2,
		"Night"=> 3
		);
		
		return isset($array[$working_time]);
	}
	
	function CheckExperience($experience)
	{
		$array= array(
		"0"=> 0,
		"1"=> 1,
		"2"=> 2,
		"3"=> 3
		);
		
		return isset($array[$experience]);
	}
?>