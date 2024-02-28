<?php
$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }

if ($_GET["date"]){
	$selected_date = $_GET["date"];
	}
if ($_GET["start_time"]){
	$start_time = $_GET["start_time"];
	}
if ($_GET["end_time"]){
	$end_time = $_GET["end_time"];
	}
	
		//Sprint Query
		
		$sprint_query = 'select SprintID, start_date, end_date from sprint 
		where sprint.start_date <= "'.$_GET["date"].'" 
		and sprint.end_date >= "'.$_GET["date"].'" limit 1;';

		$sprint_result = $conn->query($sprint_query);

		if ($sprint_result->num_rows > 0) {
			$sprint = $sprint_result->fetch_assoc();}
			
		if ($sprint) {
					 

    echo '	        
         <label for="new_start">Choose a date for your meeting:</label> ';
    
    echo '
<input type="date" id="new_date" name="new_date" value="'.$selected_date.'" min="'.$sprint["start_date"].'" max="'.$sprint["end_date"].'"> ';

// Getting the time from the availability block to show up on the editmeeting popup form
	echo '<br>
        
        <div>
        <label for="new_start">Choose a starting time for your meeting:</label>
        <input type="time" id="new_start" name="new_start" value="'.$start_time.'" min="'.$start_time.'" max="'.$end_time.'">
		<p>Meeting availability is between '.$start_time.' and '.$end_time.'</p>
		<p>Meetings may last up to one hour</p>
		<p>Teams may only select one meeting per sprint</p>
		<input type="hidden" name="sprint" value="'.$sprint["SprintID"].'">
        </div> ';
		}
		else {echo "Can not select meeting. No available sprint was found";}

$conn->close();
?> 