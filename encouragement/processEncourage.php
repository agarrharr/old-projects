<?php
require_once("../includes/session.php");
require_once("../includes/functions.php");
require_once("../includes/connect.php");

class MissionTripEncouragement{
		
	public function getNames(){
		$myFile = "names.txt";
		$fh = fopen($myFile, 'r');
		$theData = fgets($fh);
		while($theData != "end"){
			echo "<option>" . $theData . "</option>";
			$theData = fgets($fh);
		}
		fclose($fh);
	}
		
	public function addEncourage(/*boolean*/ $print = "false"){
		GLOBAL $connection;
		$sql = "INSERT INTO encouragement (`to`, `from`, message, date, viewed, printed) VALUES('".$_POST['To']."','".$_POST['From']."','".$_POST['Message']."','".$date = date( 'Y-m-d H:i:s')."', 0, 0)";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
	}
	
	public function markPrinted(){
		GLOBAL $connection;
		$sql = "UPDATE encouragement SET printed=1 WHERE viewed=1 AND printed=0";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
	}
	
	public function markViewed(){
		GLOBAL $connection;
		$sql = "UPDATE encouragement SET viewed=1 WHERE viewed=0";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
	}
	
	//the purpose of this function is to help you print and cut it out alphabetically
	//you will be able to print exactly 3 encouragements per page
	//it won't look alphabetic until you follow the steps below
	//just print, take a paper cutter and cut into 3 sections
	//and then stack the 3 sections and it will be alphabetic
	public function printAlphaPages(){
		//datas is all data alphabetized
		//data is data that isn't printed yet alphabetized
		GLOBAL $connection;
		$data = array();
		$count = 0;
		$sql = "SELECT * FROM encouragement e WHERE printed=0 ORDER BY e.to";
		$result_set = mysql_query($sql, $connection);
		confirm_query($result_set);
		if(mysql_num_rows($result_set) >= 1){
			$i = 0;
			while ($datas = mysql_fetch_array($result_set)){
				if($datas['printed'] == "0"){
					$data[$count] = array();
					$data[$count][0] = $datas['to'];
					$data[$count][1] = $datas['from'];
					$data[$count][2] = $datas['message'];
					$data[$count][3] = $datas['date'];
					$count++;
				}
				$i++;
			}
		}
		//get the number of pages = # of encouragements/# per pages
		$pages = ceil(count($data)/3);
		echo "<table width ='510' border='0'>";
		for($i = 0; $i < $pages; $i++)
		{
			for($j = 0; $j < 3; $j++)
			{
				//determine which encouragement to print
				$enc = $i + $pages * $j;
				echo "<tr style='height: 2em;'><td colspan='2'>";
				if(($enc >= count($data)))
				{
					echo "<b>&nbsp;</b></td></tr><tr style='height: 1em;'><td>";
					echo "&nbsp;</td><td align='right'>&nbsp;</td></tr><tr style='height: 15em;'><td valign='top' colspan='2'>&nbsp;";
				}
				else
				{
					echo "<b>" . $data[$enc][0] . "</b></td></tr><tr style='height: 1em;'><td>";
					$date = date_create($data[$enc][3]);
					echo " from " . $data[$enc][1] . "</td><td align='right'>" . date_format($date, 'l (m/d/y)') . " at " . date_format($date, 'H:ia') . "</td></tr><tr style='height: 15em;'><td valign='top' colspan='2'>";
					echo $data[$enc][2];
				}
				echo "</td></tr>";
			}
		}
		echo "</table>";
	}
}
?>