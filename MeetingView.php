<!DOCTYPE html>
<html lang="en-US">
<!--https://cas.iu.edu/cas/login?cassvc=IU&casurl=https://cgi.soic.indiana.edu/~smkramer/i491/smkramer/index.html# -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link media="all" rel="stylesheet" href="./css/rivet.min.css">
    <title>Rivet starter file</title>
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
                    <a href="">View Meetings</a>
                </li>
                
                <li>
                    <a href="CalendarView.php" >Calendar</a>
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
    <div>
 <?php
    	$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
		

//$section = mysqli_real_escape_string($conn, $_POST['section']);

 // Team Filter Query
 if ($_GET["team"] == "all" or !$_GET["team"]) {
$filter_team_query = "Select TeamID
from team;";}

else {
  $filter_team_query = "Select TeamID
from team
where TeamID =".$_GET["team"].";";
}

 $all_team_query = "Select TeamID
from team;";

$all_team_result = $conn->query($all_team_query);
$filter_team_result = $conn->query($filter_team_query);

 // Sprint Filter Query

 $sprint_query = "Select SprintID
from sprint;";

$sprint_result = $conn->query($sprint_query);

 echo
 '<div class="rvt-container">
    <div class="rvt-grid">
<div class="rvt-grid__item">
<form id="filterselect" action="" method="GET">
<label for="select-team">Select Team:</label>
<select id="select-team"  name="team" onchange="this.form.submit()">
<option value="">Choose a team...</option>';
if ($all_team_result->num_rows > 0) {
    // output data of each row
    
    
    while($team_row = $all_team_result->fetch_assoc()) {
    	if ($_GET["team"] == $team_row["TeamID"]) {
    		echo "<option value=".$team_row["TeamID"].' selected>'.$team_row["TeamID"]."</option>";}
    	else {
    		echo "<option value=".$team_row["TeamID"].'>'.$team_row["TeamID"]."</option>";}
    }
}
echo '<option value="">All Teams</option>
</select>
</div>
<div class="rvt-grid__item">
<label for="select-sprint">Select Sprint:</label>
<select id="select-sprint"  name="sprint" onchange="this.form.submit()">
<option value="">Choose a sprint...</option> ';

if ($sprint_result->num_rows > 0) {
    // output data of each row
    
    
    while($sprint_row = $sprint_result->fetch_assoc()) {
    	if ($_GET["sprint"] == $sprint_row["SprintID"]) {
    		echo "<option value=".$sprint_row["SprintID"].' selected>'.$sprint_row["SprintID"]."</option>";}
    	else {
    		echo "<option value=".$sprint_row["SprintID"].'>'.$sprint_row["SprintID"]."</option>";}
    		
    }
}
echo '<option value="">All Sprints</option> </select></form> </div></div></div><br><br>';


 // Meeting query
if ($_GET["team"] and $_GET["sprint"]) {$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt where mt.teamID = ".$_GET["team"]." and mt.sprintID =".$_GET["sprint"]." ORDER BY MeetingID desc;";}

elseif ($_GET["team"] and $_GET["team"] != "all" and !$_GET["sprint"]) {$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt where mt.teamID = ".$_GET["team"]." ORDER BY MeetingID desc;";}

elseif ($_GET["sprint"]) {$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt where mt.sprintID = ".$_GET["sprint"]." ORDER BY MeetingID desc;";}

else {
$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt ORDER BY MeetingID desc;"; }




$meeting_result = $conn->query($meeting_query);
echo 
'<div>
 <table>
    <caption class="sr-only">Meeting Table 1</caption>
    <thead>
        <tr>
            <th scope="col"></th>
            <th scope="col">Meeting Time</th>
            <th scope="col">Meeting Date</th>
            <th scope="col">Team</th>
            <th scope="col">Student Participants</th>
            <th scope="col">Ratings</th>
            <th scope="col">Notes</th>
            <th scope="col">Assigned Tasks</th>
        </tr>
    </thead> 
    <tbody> 
    
    ';
    

if ($meeting_result->num_rows > 0) {
    // output data of each row
    
    
    while($row = $meeting_result->fetch_assoc()) {
    
    	echo "<tr><td><a href='MeetingNotes.php?meeting=".$row["MeetingID"]."'>Edit</a></td><td>".$row["meeting_time"].
        "</td><td>".$row["meeting_date"].
        "</td><td>".$row["teamID"]."</td>";
        
        
        //Student query
        
    	$student_query = 'Select s.first_name, s.last_name, sa.attendance
from meeting as mt, student as s, student_attendance as sa
where mt.teamID = s.teamID and sa.meetingID = mt.MeetingID and sa.studentID = s.StudentID
and mt.MeetingID = '.$row["MeetingID"].';';

		
		$student_result = $conn->query($student_query);
        
        
        echo "<td>"; 
        // Attendance Check. Changing the font color to red if the student is marked as "Missed"
		if ($student_result->num_rows > 0) {
       		while($student_row = $student_result->fetch_assoc()) {
       			if ($student_row["attendance"] == "Missed"){
       				echo nl2br('<font color="red">'.$student_row["first_name"]." ".$student_row["last_name"]." ( ".$student_row["attendance"].")</font>\n");}
       			else {
        			echo nl2br( $student_row["first_name"]." ".$student_row["last_name"]." ( ".$student_row["attendance"].")\n");}
        	}
       } 
        echo "</td>";
        
        
        // Rating Query
        
   		$rating_query = 'Select r.rating_name, mr.value
from rating as r, meeting_rating as mr
where r.RatingID = mr.ratingID and mr.meetingID = '.$row['MeetingID'].';';

		
		$rating_result = $conn->query($rating_query);
       
        echo "<td>"; 
        
		if ($rating_result->num_rows > 0) {
       		while($rating_row = $rating_result->fetch_assoc()) {
        		echo nl2br( $rating_row["rating_name"]." (".$rating_row["value"].")\n");
        	}
       } 
        echo "</td>";    
        
        
         // Note Query
        
   		$note_query = 'Select content 
from note 
where meetingID = '.$row['MeetingID'].';';

		
		$note_result = $conn->query($note_query);
       
        echo "<td>"; 
        
		if ($note_result->num_rows > 0) {
       		while($note_row = $note_result->fetch_assoc()) {
        		echo nl2br( $note_row["content"]." \n");
        	}
       } 
        echo "</td>";     
        
          // Task Query
        
   		$task_query = 'Select content 
from task 
where meetingID = '.$row['MeetingID'].';';

		
		$task_result = $conn->query($task_query);
       
        echo "<td>"; 
        
		if ($task_result->num_rows > 0) {
       		while($task_row = $task_result->fetch_assoc()) {
        		echo nl2br( $task_row["content"]." \n");
        	}
       } 
        echo "</td>";     
   
        echo "</tr>";
     }
} else {
   // echo "0 results";
}
echo "</tbody>
	</table>
	</div> ";
$conn->close();
?> 
   

	</div>
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
