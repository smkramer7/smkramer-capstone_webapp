<!DOCTYPE html>
<html>
<head>
<meta charset='utf-8' />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="./css/rivet.min.css">
    <title>Calendar</title>
<link href='fullcalendar/lib/main.css' rel='stylesheet' />
<script src='fullcalendar/lib/main.js'></script>

<?php
    	$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
//echo var_dump($_POST);

		// EDITING AVAILABILITY
		
foreach($_POST as $key => $value) {
	if (!$value) {continue;}
	
	if (strpos($key, "start")===0) {
		$aid = str_replace("start", "", $key);
		//echo $aid;
		$foundmatch = false;

		foreach($_POST as $key2 => $value2) {

		
			if (strpos($key2, "end")===0) {
				$aid2 = str_replace("end", "", $key2);
				
				if ($aid == $aid2) {
					$foundmatch = true;
					break;
				}
			}
		}
		if ($foundmatch){
		//	echo $value;
		//	echo $value2;
		}
    	if ($value and $value2) {
    	
    		// Editing current availability blocks 
			$availability_update = 'update availability 
			set start_time ="'.$value.'", end_time = "'.$value2.'" 
			where aID='.$aid.';';
			
			$conn->query($availability_update);
		}
	}
}
	if ($_POST["new_start"] and $_POST["new_end"]) {
		$value = $_POST["new_start"];
		$value2 = $_POST["new_end"];
		
		//Getting the sprint that is associated with the availability blocks
		$sprint_query = 'select sprint.SprintID from availability, sprint 
		where availability.sprintID = sprint.SprintID and sprint.start_date <= "'.$_POST["new_date"].'" 
		and sprint.end_date >= "'.$_POST["new_date"].'" limit 1;';

		$sprint_result = $conn->query($sprint_query);

		if ($sprint_result->num_rows > 0) {
			$sprint = $sprint_result->fetch_assoc();}
			
		if ($sprint) {
			//Adding new availability blocks
			$availability_update = 'insert into availability 
									(sprintID, adate, start_time, end_time) 
									VALUES ('.$sprint["SprintID"].',"'.$_POST["new_date"].'","'.$value.'","'.$value2.'");';
			$conn->query($availability_update);
		}
		else {echo "Could not add availability. Sprint not found.";
		}
	}
		

		//Adding a new sprint to the calendar
			
			$success = false;
			$failure = false;
		
		if ($_POST["sprint_start_date"] and $_POST["sprint_end_date"]){
		
			$sprint_update = 'insert into sprint 
									(start_date, end_date) 
									VALUES ("'.$_POST["sprint_start_date"].'","'.$_POST["sprint_end_date"].'");';
			$conn->query($sprint_update);
	
	function date_range($first, $last, $step = '+1 day', $output_format = 'Y-m-d' ) {

    $dates = array();
    $current = strtotime($first);
    $last = strtotime($last);

    while( $current <= $last ) {

        $dates[] = date($output_format, $current);
        $current = strtotime($step, $current);
    }

    return $dates;
	}
	
	$date_range = date_range($_POST["sprint_start_date"],$_POST["sprint_end_date"]);
	
			$sprint_query = 'select sprint.SprintID from sprint 
		where sprint.start_date = "'.$_POST["sprint_start_date"].'" 
		and sprint.end_date = "'.$_POST["sprint_end_date"].'" limit 1;';

		$sprint_result = $conn->query($sprint_query);
		
		if ($sprint_result->num_rows > 0) {
			$sprint = $sprint_result->fetch_assoc();}
			
		if ($sprint) {
		
     		foreach ($date_range as $key => $value) {  
     		// Added default meeting availability times
    				 $availability_update = 'insert into availability 
									(sprintID, adate, start_time, end_time) 
									VALUES ('.$sprint["SprintID"].',"'.$value.'","06:00:00","17:00:00");';
					 $conn->query($availability_update);	   
			}
		}
		$success = true;}
		
		
		elseif ($_POST["sprint_start_date"] or $_POST["sprint_end_date"]){

		$failure = true;}
		
		
// Team Name, meeting date, meeting time Query

$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID, mt.sprintID
from meeting as mt;"; 



$meeting_result = $conn->query($meeting_query);


$recent_meeting_query = "Select mt.meeting_date from meeting as mt ORDER BY mt.meeting_date DESC limit 1;"; 


$recent_meeting_result = $conn->query($recent_meeting_query);

if ($recent_meeting_result->num_rows > 0) {
	$recent_meeting = $recent_meeting_result->fetch_assoc();
	$recent_meeting = $recent_meeting["meeting_date"];
}
else {$recent_meeting = date("Y-m-d");}


$meetings = array();

if ($meeting_result->num_rows > 0) {
    // output data of each row
    
    
    while($row = $meeting_result->fetch_assoc()) {
   		array_push($meetings, array(
       "title" => 'team '.$row["teamID"].', sprint '.$row["sprintID"],
        "start" => $row["meeting_date"].'T'.$row["meeting_time"],
        "url" => 'MeetingNotes.php?meeting='.$row["MeetingID"]));
        
      //$row["MeetingID"];
    
	}
}	

$a_query = "Select aID, sprintID, adate, start_time, end_time
from availability;"; 



$a_result = $conn->query($a_query);

if ($a_result->num_rows > 0) {
    // output data of each row
    
    
    while($row = $a_result->fetch_assoc()) {
   		array_push($meetings, array(
       "title" => "Edit Availability for Sprint ".$row["sprintID"],
        "start" => $row["adate"].'T'.$row["start_time"],
        "end" => $row["adate"].'T'.$row["end_time"],
        "backgroundColor" => "darkgrey",
        "textColor" => "blue",
        "display" => "block"));
        
      //$row["MeetingID"];
    
	}
}	



//echo var_dump($meetings);  
    
?>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
	var meetings = JSON.parse( '<?php echo json_encode($meetings); ?>' );
	
	if (JSON.parse( '<?php echo json_encode($_POST["new_date"]); ?>' )){
		var initial_date = JSON.parse( '<?php echo json_encode($_POST["new_date"]); ?>' );
	}		else { 
	var initial_date = JSON.parse( '<?php echo json_encode($recent_meeting); ?>' );
				 }
				 
    var calendar = new FullCalendar.Calendar(calendarEl, {
      dayMinWidth: 200,
      headerToolbar: {
        left: 'prev,next today',
        center: 'title',
        right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
      },
      initialDate: initial_date,
      initialView: 'timeGridWeek',
      navLinks: true, // can click day/week names to navigate views
      editable: true,
      dayMaxEvents: true, // allow "more" link when too many events
      events: meetings,
      eventClick: function(info) {
	//info.jsEvent.preventDefault(); // don't let the browser navigate
	if (!info.event.url){
	
	Modal.open("edit-availability");
	document.getElementById("availability-date").innerHTML=info.event.start; 
	var date = info.event.start;
	const dateTimeFormat = new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit' });
	const [{ value: month },,{ value: day },,{ value: year }] = dateTimeFormat .formatToParts(date);
	date=`${year}-${month}-${day }`;
	//document.getElementById("selected_date").innerHTML="'; $selected_date='"+date+"'; echo '"; 
	
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("current_availability").innerHTML = this.responseText;
            }
    };
	xmlhttp.open("GET", "EditAvailability.php?date=" + date, true);
	xmlhttp.send();
	}
	},
     
    });

    calendar.render();
  });

</script>
<style>

  body {
    margin: 40px 10px;
    padding: 0;
    font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
    font-size: 14px;
  }

  #calendar {
    max-width: 1100px;
    margin: 0 auto;
  }

</style>
</head>
<body>
<header class="rvt-header" role="banner">
    <a class="rvt-skip-link" href="#main-content">Skip to content</a>
    <!-- Trident -->
    <div class="rvt-header__trident">
        <svg class="rvt-header__trident-logo" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 41 48" aria-hidden="true">
            <title id="iu-logo">Indiana University Logo</title>
            <rect width="41" height="48" fill="#900"/>
            <polygon points="24.59 12.64 24.59 14.98 26.34 14.98 26.34 27.78 22.84 27.78 22.84 10.9 24.59 10.9 24.59 8.57 16.41 8.57 16.41 10.9 18.16 10.9 18.16 27.78 14.66 27.78 14.66 14.98 16.41 14.98 16.41 12.64 8.22 12.64 8.22 14.98 9.97 14.98 9.97 30.03 12.77 33.02 18.16 33.02 18.16 36.52 16.41 36.52 16.41 39.43 24.59 39.43 24.59 36.52 22.84 36.52 22.84 33.02 28 33.02 31.01 30.03 31.01 14.98 32.78 14.98 32.78 12.64 24.59 12.64" fill="#fff"/>
        </svg>
    </div>
    <!-- App title -->
    <span class="rvt-header__title">
        <a href="index.php">Meeting Manager</a>
    </span>
    <!-- Wrapper for header interactive elements -->
    <div class="rvt-header__controls">
        <!-- Main inline nav element -->
        <nav class="rvt-header__main-nav" role="navigation">
            <ul>
                <li>
                    <a href="MeetingView.php">View Meetings</a>
                </li>
                
                <li>
                    <a href="" >Calendar</a>
                </li>
            </ul>
        </nav>
        <!-- ID menu w/ dropdown -->
        <div class="rvt-header-id">
            <div href="#0" class="rvt-header-id__profile">
                <span class="rvt-header-id__avatar" aria-hidden="true">I</span>
                <span class="rvt-header-id__user"></span>
            </div>
            <a href="index.php" class="rvt-header-id__log-out">Log out</a>
        </div>
        <!-- Drawer close button - shows on small screens -->
        <button type="button" class="rvt-drawer-button" aria-haspopup="true" aria-expanded="false" data-drawer-toggle="mobile-drawer-3">
            <span class="sr-only">Toggle menu</span>
            <svg aria-hidden="true" class="rvt-drawer-button-open" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <g fill="currentColor">
                    <path d="M15,3H1A1,1,0,0,1,1,1H15a1,1,0,0,1,0,2Z"/>
                    <path d="M15,9H1A1,1,0,0,1,1,7H15a1,1,0,0,1,0,2Z"/>
                    <path d="M15,15H1a1,1,0,0,1,0-2H15a1,1,0,0,1,0,2Z"/>
                </g>
            </svg>
            <svg aria-hidden="true" class="rvt-drawer-button-close" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16">
                <path fill="currentColor" d="M9.41,8l5.29-5.29a1,1,0,0,0-1.41-1.41L8,6.59,2.71,1.29A1,1,0,0,0,1.29,2.71L6.59,8,1.29,13.29a1,1,0,1,0,1.41,1.41L8,9.41l5.29,5.29a1,1,0,0,0,1.41-1.41Z"/>
            </svg>
        </button>
    </div>
    <!--
        Drawer - small screens only
        NOTE: If we are going to give people the option to use the drawer
        on desktop as well, a combo of duplicating markup and showing/hiding
        is probably the best way to handle that kind of flexibility.
        We'll just need to be clear about it in the documentation.
    -->
    <div class="rvt-drawer" aria-hidden="true" id="mobile-drawer-3">
        <!-- Drawer nav -->
        <nav class="rvt-drawer__nav" role="navigation">
            <ul>
                <li>
                    <div class="rvt-header-id__profile rvt-header-id__profile--drawer">
                        <span class="rvt-header-id__avatar" aria-hidden="true">rs</span>
                        <span class="rvt-header-id__user">rswanson</span>
                        <a href="#0" class="rvt-header-id__log-out">Log out</a>
                    </div>
                </li>
                <li>
                    <a href="#">Nav one</a>
                </li>
                <li class="has-children">
                    <button type="button" data-subnav-toggle="subnav-simple-1" aria-haspopup="true" aria-expanded="false">Nav two</button>
                    <div id="subnav-simple-1" role="menu" aria-hidden="true">
                        <ul>
                            <li>
                                <a href="#">Subnav one</a>
                            </li>
                            <li>
                                <a href="#">Subnav two</a>
                            </li>
                            <li>
                                <a href="#">Subnav three</a>
                            </li>
                        </ul>
                    </div>
                </li>
                <li>
                    <a href="#" aria-current="page">Nav three</a>
                </li>
            </ul>
            <button type="button" class="rvt-drawer__bottom-close">Close nav</button>
        </nav>
    </div>
</header>
<main role="main" id="main-content">

<div class="rvt-modal"
     id="edit-availability"
     role="dialog"
     aria-labelledby="modal-example-title"
     aria-hidden="true"
     tabindex=-1>
     <div class="rvt-modal__inner">
        <header class="rvt-modal__header">
            <h1 class="rvt-modal__title" id="modal-example-title">Edit Availability</h1>
            <h3 id="availability-date">date</h3>
        </header>
        <form id="change-availability" action="" method="POST">
        <div class="rvt-modal__body">
	<div id="current_availability"></div>       

    <br>
        
        <div>
        <h3>Add New Availability</h3>
        <label for="new_start">Choose a starting time for your meeting:</label>
        <input type="time" id="new_start" name="new_start">
       	<label for="new_end">Choose an ending time for your meeting:</label>
        <input type="time" id="new_end" name="new_end">
        </div> 
        </div> 

        <div class="rvt-modal__controls">
            <button type="submit" class="rvt-button">Save Changes</button>
            <button type="button" class="rvt-button rvt-button--secondary" data-modal-close="edit-availability">Cancel</button>
        </div>
        <button type="button" class="rvt-button rvt-modal__close" data-modal-close="edit-availability">
            <span class="rvt-sr-only">Close</span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path fill="currentColor" d="M9.41,8l5.29-5.29a1,1,0,0,0-1.41-1.41L8,6.59,2.71,1.29A1,1,0,0,0,1.29,2.71L6.59,8,1.29,13.29a1,1,0,1,0,1.41,1.41L8,9.41l5.29,5.29a1,1,0,0,0,1.41-1.41Z"/>
            </svg>
        </button>
        </form>
    </div>
</div> 

<div id='calendar'></div>
<br>
<div class="rvt-container">
<div class="rvt-grid">
	<h2 class="rvt-ts-md rvt-ts-l-md-up">Add Sprint</h2>
</div>
<div class="rvt-grid">
	<form id="addsprint" action="" method="POST">
	<div class="rvt-grid__item">
		<label for="sprint_start_date">Select Starting Date</label>
		<input type = "date" id="sprint_start_date"  name="sprint_start_date">
	</div>
	<div class="rvt-grid__item">
		<label for="sprint_end_date">Select Ending Date</label>
		<input type = "date" id="sprint_end_date"  name="sprint_end_date">
	</div>
	<br>
	<input type="submit">
	
<?php 

 if ($failure == true) { 


	echo ' <div id = "validation_needed" class="rvt-inline-alert rvt-inline-alert--standalone rvt-inline-alert--danger">
            <span class="rvt-inline-alert__icon">
                <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                    <g fill="currentColor">
                        <path d="M8,0a8,8,0,1,0,8,8A8,8,0,0,0,8,0ZM8,14a6,6,0,1,1,6-6A6,6,0,0,1,8,14Z" />
                        <path d="M10.83,5.17a1,1,0,0,0-1.41,0L8,6.59,6.59,5.17A1,1,0,0,0,5.17,6.59L6.59,8,5.17,9.41a1,1,0,1,0,1.41,1.41L8,9.41l1.41,1.41a1,1,0,0,0,1.41-1.41L9.41,8l1.41-1.41A1,1,0,0,0,10.83,5.17Z"/>
                    </g>
                </svg>
            </span>
            <span class="rvt-inline-alert__message" id="radio-list-message">
                All fields are required to add a sprint.
            </span>
    </div>'; } 
    
?>
<?php
	if ($success == true) { 
	
	echo ' <div id = "success_message" class="rvt-inline-alert rvt-inline-alert--standalone rvt-inline-alert--success">
    <span class="rvt-inline-alert__icon">
        <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
            <g fill="currentColor">
                <path d="M10.2,5.4,7.1,9.53,5.67,8.25a1,1,0,1,0-1.34,1.5l2.05,1.82a1.29,1.29,0,0,0,.83.32h.12a1.23,1.23,0,0,0,.88-.49L11.8,6.6a1,1,0,1,0-1.6-1.2Z"/>
                <path d="M8,0a8,8,0,1,0,8,8A8,8,0,0,0,8,0ZM8,14a6,6,0,1,1,6-6A6,6,0,0,1,8,14Z"/>
            </g>
        </svg>
    </span>
    <span class="rvt-inline-alert__message" id="radio-list-message">
        Sprint successfully added.
    		</span>
	</div>'; }
		
?>
	</form>
</div>
</div>
<?php
$conn->close();
?> 
</main>

    <footer class="rvt-footer m-top-xxl" role="contentinfo">
        <div class="rvt-footer__copyright-lockup">
            <div class=rvt-footer__trident>
                <svg role="img" xmlns="http://www.w3.org/2000/svg" width="20" height="25" viewBox="0 0 20 25">
                    <polygon points="13.33 3.32 13.33 5.21 14.76 5.21 14.76 15.64 11.9 15.64 11.9 1.9 13.33 1.9 13.33 0 6.67 0 6.67 1.9 8.09 1.9 8.09 15.64 5.24 15.64 5.24 5.21 6.67 5.21 6.67 3.32 0 3.32 0 5.21 1.43 5.21 1.43 17.47 3.7 19.91 8.09 19.91 8.09 22.76 6.67 22.76 6.67 25.13 13.33 25.13 13.33 22.76 11.9 22.76 11.9 19.91 16.1 19.91 18.56 17.47 18.56 5.21 20 5.21 20 3.32 13.33 3.32" fill="#900"/>
                </svg>
            </div>
            <p><a href="https://www.iu.edu/copyright/index.html">Copyright</a> &copy; 2017 The Trustees of <a href="https://www.iu.edu/">Indiana University</a></p>
        </div>
        <ul class="rvt-footer__aux-links">
            <li class="rvt-footer__aux-item">
                <!-- You can learn more about privacy policies and generate one
                     for your site here:
                     https://protect.iu.edu/online-safety/tools/privacy-notice/index.html -->
                <a href="#0">Privacy Policy</a>
            </li>
            <li class="rvt-footer__aux-item">
                <a href="https://accessibility.iu.edu/">Accessibility help</a>
            </li>
        </ul>
    </footer>
    <script src="./js/rivet.min.js"></script>
</body>

</html>
