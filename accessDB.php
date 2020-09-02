<?php

	if(session_id()=="")
	{
?>
		<a href="https://www.youtube.com/channel/UCcvLSRIWJIAGFDyWtzkbiHA"><img src="a.jpg" style="max-width: 100%; height: auto; width: auto\9;"></img></a>
<?php
	}

	function connectToDB()
	{
		$db_host = "127.0.0.1";
		$db_name = "cwliu123_db";
		$db_user = "aaa";
		$db_password = "bbb";

		$dsn = "mysql:host=$db_host;dbname=$db_name";
		$db = new PDO($dsn, $db_user, $db_password);
		if(!$db)
		{
			echo 'connection to database failed!';
			exit;
		}

		return $db;
	}
	
	function accessTable($db, $table)
	{
		$sql = "SELECT * FROM $table";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}
	
	function accessTableDes($db, $table)
	{
		$sql = "SELECT * FROM $table ORDER BY salary DESC";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}
	
	function accessTableAsc($db, $table)
	{
		$sql = "SELECT * FROM $table ORDER BY salary ASC";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}
	
	function accessRow($db, $table, $column, $value)
	{
		$sql = "SELECT * FROM $table WHERE $column='$value'";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}

	function accessRow2($db, $table, $column, $value, $column2, $value2)
	{
		$sql = "SELECT * FROM $table WHERE $column='$value' AND $column2='$value2'";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}
	
	function accessRowVar($db, $table, $arr)
	{
		$sql = "SELECT * FROM $table WHERE";
		$count = 0;
		while(list($column, $value)=each($arr))
		{
			$count++;
			if($count>=2)
				$sql=$sql." AND";
			$sql=$sql." $column='$value'";
		}
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}
		
		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return $temp;
	}
	
	function accessRowVar2($db, $table, $arr)
	{	
		$salary = "salary";
		$sql = "SELECT * FROM $table WHERE";
		$count=0;
		for($i=0;$i<sizeof($arr);$i=$i+2)
		{
			$count++;
			$i_next = $i + 1;
			if($count>=2)
				$sql=$sql." AND";
			if(is_int($arr[$i_next]))
			{
				if($arr[$i] != $salary)
				{
					$sql=$sql." $arr[$i]=$arr[$i_next]";
				}
				else
					$sql=$sql." $arr[$i]<=$arr[$i_next]";
			}
			else
				$sql=$sql." $arr[$i]='$arr[$i_next]'";
		}
		
		if(isset($_POST['Asc']))
			$sql = $sql." ORDER BY salary ASC";
		else if(isset($_POST['Desc']))
			$sql = $sql." ORDER BY salary DESC";
      
		$result = $db->query($sql);
		$temp = $result->fetchAll();

		return $temp;
	}
	
	function JobEmployerMatch($jobID, $employerID)
	{
		$db = connectToDB();
		$sql = "SELECT * FROM recruit WHERE id='$jobID' AND employer_id='$employerID'";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return isset($temp[0]);
	}
	
	function GetOccupationID($db)
	{
		$tmp_occupation = "HUM";
		
		if($_POST['occupation_search'] != "")
			$tmp_occupation = $_POST['occupation_search'];
		$minus= -1;
		
		$sql= "SELECT * FROM occupation WHERE occupation = '$tmp_occupation'";
		$result= $db->query($sql);
		$temp= $result->fetchAll();
		
		if(isset($temp[0]))
			return $temp[0]['id'];
		else
			return $minus;
	}
	
	function GetLocationID($db)
	{
		$tmp_location = "HUM";
		
		if($_POST['location_search'] != "")
			$tmp_location = $_POST['location_search'];
			
		$minus= -1;
		
		$sql= "SELECT * FROM location WHERE location = '$tmp_location'";
		$result= $db->query($sql);
		$temp= $result->fetchAll();
		
		if(isset($temp[0]))
			return $temp[0]['id'];
		else
			return $minus;
	}

	function jobUserApplicationMatch($jobID, $userID)
	{
		$db = connectToDB();
		$sql = "SELECT * FROM application WHERE user_id='$userID' AND recruit_id='$jobID'";
		$result = $db->query($sql);
		if($result===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		$temp = $result->fetchAll();
		if($temp===false)
		{
			echo "database query failed!<br>";
			exit;
		}

		return isset($temp[0]);
	}

?>