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


if ($_POST["new_start"] and $_POST["new_date"] and $_POST["sprint"]) {
		$meeting_time = $_POST["new_start"];
		$meeting_date = $_POST["new_date"];
		
		$meeting_update = 'INSERT INTO meeting (meeting_time, meeting_date, teamID, sprintID) VALUES 
			("'.$meeting_time.'", "'.$meeting_date.'", '.$_GET["team"].', '.$_POST["sprint"].'); ';
			
		$conn->query($meeting_update);
	
	// Recovering meeting just added to the database

	$added_meeting_query = "Select MeetingID from meeting
	where teamID = ".$_GET["team"]." and sprintID = ".$_POST["sprint"].";"; 


	$added_meeting_result = $conn->query($added_meeting_query);

	if ($added_meeting_result->num_rows > 0) {
		$added_meeting = $added_meeting_result->fetch_assoc();
		
	
	//Team query is returning what students are on the team then stored in $teamresults
		$team_query = "Select StudentID from student
		where teamID = ".$_GET["team"].";"; 


		$team_result = $conn->query($team_query);

	//Checking what students are on this team. 

		if ($team_result->num_rows > 0) {
			while ($student = $team_result->fetch_assoc()){
			
				// Query is changing the database to update attendance
	
				$attendance_update = 'INSERT INTO student_attendance (studentID, meetingID) VALUES 
				('.$student["StudentID"].', '.$added_meeting["MeetingID"].');';
			
				$conn->query($attendance_update);
			}
		}
	}

}
elseif ($_POST["new_start"] or $_POST["new_date"]){
echo "Failed to save meeting in the database, due to incomplete information";}

// Meeting query is getting all the meetings for that team to show up.

$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID, mt.sprintID
from meeting as mt
where mt.teamID = ".$_GET["team"].";"; 



$meeting_result = $conn->query($meeting_query);


$recent_meeting_query = "Select mt.meeting_date from meeting as mt
where mt.teamID = ".$_GET["team"]." ORDER BY mt.meeting_date DESC limit 1;"; 


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
        "url" => "#",//'MeetingNotes.php?meeting='.$row["MeetingID"]
        ));
        
    
    }
}
// Sprint Query

//Gets all scheduled sprints in which the team does NOT have a meeting scheduled. Eliminates availability blocks for the other sprints.

$scheduled_sprints_query = 'select SprintID from sprint where SprintID not in
(select sprint.SprintID from sprint, meeting 
where sprint.SprintID = meeting.sprintID and meeting.teamID = '.$_GET["team"].');';

$scheduled_sprints_results = $conn->query($scheduled_sprints_query);


if ($scheduled_sprints_results->num_rows > 0) {
    // output data of each row
    
	while ($row = $scheduled_sprints_results->fetch_assoc()){

		$a_query = "Select aID, sprintID, adate, start_time, end_time
from availability
where sprintID = ".$row["SprintID"].";"; 

		$a_result = $conn->query($a_query);

		if ($a_result->num_rows > 0) {
    // output data of each row
    
    
    	while($arow = $a_result->fetch_assoc()) {
   			array_push($meetings, array(
       		"title" => "Select Meeting for Sprint ".$row["SprintID"],
       	 	"start" => $arow["adate"].'T'.$arow["start_time"],
        	"end" => $arow["adate"].'T'.$arow["end_time"],
        	"backgroundColor" => "darkgrey",
        	"textColor" => "blue",
        	"display" => "block"));
    
		}
		}	

	}
}




//echo var_dump($meetings);  
    
    
    
    
?>


<script>

  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
	var meetings = JSON.parse( '<?php echo json_encode($meetings); ?>' );
	var initial_date = JSON.parse( '<?php echo json_encode($recent_meeting); ?>' );
	
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
	
	  Modal.open("select_meeting");
	  document.getElementById("selected_date").innerHTML=info.event.start; 
	  document.getElementById("modal-title").innerHTML=info.event.title; 
	  var date = info.event.start;
	  const dateTimeFormat = new Intl.DateTimeFormat('en', { year: 'numeric', month: '2-digit', day: '2-digit',
	  hour: 'numeric', minute: 'numeric', second: 'numeric', hour12: false, });
	  const [{ value: month },,{ value: day },,{ value: year }] = dateTimeFormat .formatToParts(date);
	  date=`${year}-${month}-${day }`;
	  const [{ value: month2 },,{ value: day2 },,{ value: year2 },,{ value: hour },,{ value: minute },,{ value: second }] = dateTimeFormat .formatToParts(info.event.start);
	  var start_time =`${hour}:${minute}:${second }`;
	  const [{ value: month3 },,{ value: day3 },,{ value: year3 },,{ value: hour2 },,{ value: minute2 },,{ value: second2 }] = dateTimeFormat .formatToParts(info.event.end);
	  var end_time =`${hour2}:${minute2}:${second2 }`;
	  
	  var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
      	if (this.readyState == 4 && this.status == 200) {
        	document.getElementById("current_date").innerHTML = this.responseText;
            }
      };
      // Creating variables in the URL
	  xmlhttp.open("GET", "EditMeeting.php?date=" + date + "&start_time=" + start_time + "&end_time=" + end_time, true);
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
                	<?php echo '<a href="StudentMeetingView.php?team='.$_GET["team"].'">View Meetings</a>';?>
                </li>
                
                <li>
                    <a href="" >Calendar</a>
                </li>
            </ul>
        </nav>
        <!-- ID menu w/ dropdown -->
        <div class="rvt-header-id">
            <div href="#0" class="rvt-header-id__profile">
                <span class="rvt-header-id__avatar" aria-hidden="true"><?php echo "T".$_GET["team"];?></span>
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
     id="select_meeting"
     role="dialog"
     aria-labelledby="modal-example-title"
     aria-hidden="true"
     tabindex=-1>
     <div class="rvt-modal__inner">
        <header class="rvt-modal__header">
            <h1 class="rvt-modal__title" id="modal-title">Select Meeting</h1>
            <h3 id="selected_date">date</h3>
        </header>
        <form id="add_meeting" action="" method="POST">
        <div class="rvt-modal__body">
	<div id="current_date"></div>       

        </div>
        <div class="rvt-modal__controls">
            <button type="submit" class="rvt-button">Save Changes</button>
            <button type="submit" class="rvt-button rvt-button--secondary" data-modal-close="select_meeting">Cancel</button>
        </div>
        <button type="button" class="rvt-button rvt-modal__close" data-modal-close="select_meeting">
            <span class="rvt-sr-only">Close</span>
            <svg aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16">
                <path fill="currentColor" d="M9.41,8l5.29-5.29a1,1,0,0,0-1.41-1.41L8,6.59,2.71,1.29A1,1,0,0,0,1.29,2.71L6.59,8,1.29,13.29a1,1,0,1,0,1.41,1.41L8,9.41l5.29,5.29a1,1,0,0,0,1.41-1.41Z"/>
            </svg>
        </button>
        </form>
    </div>
</div> 



  <div id='calendar'></div>
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
