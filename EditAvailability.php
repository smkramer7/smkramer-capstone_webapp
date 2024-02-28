<?php
$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }

if ($_GET["date"]){
	$selected_date = $_GET["date"];
	}
	
		//Availability Query
		
		$adate_query = "Select aID, sprintID, adate, start_time, end_time
from availability
where adate = '".$selected_date."' ORDER BY start_time;"; 



$adate_result = $conn->query($adate_query);

if ($adate_result->num_rows > 0) {
    // output data of each row
    echo '	        
        <h3>Current Availability</h3>
        <p>Choose a starting and ending time for your meeting:</p> ';
    
    while($adate_row = $adate_result->fetch_assoc()) {
   		echo ' <input type="time" id="start'.$adate_row["aID"].'" name="start'.$adate_row["aID"].'" value='.$adate_row["start_time"].'> ';
   		echo ' <input type="time" id="end'.$adate_row["aID"].'" name="end'.$adate_row["aID"].'" value='.$adate_row["end_time"].'> ';
   		echo '<br>';
	}
}
echo '
<input type="hidden" id="new_date" name="new_date" value="'.$selected_date.'"> ';


$conn->close();
?> 