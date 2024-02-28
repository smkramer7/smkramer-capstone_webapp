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
                   <?php echo '<a href="StudentCalendarView.php?team='.$_GET["team"].'">Calendar</a>';?>
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
    <div>
 <?php
    	$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
		

//$section = mysqli_real_escape_string($conn, $_POST['section']);





 // Meeting query
 
$meeting_query = "Select mt.meeting_time, mt.meeting_date, mt.teamID, mt.MeetingID
from meeting as mt where mt.teamID = ".$_GET["team"]." ORDER BY MeetingID desc;";



$meeting_result = $conn->query($meeting_query);
echo 
'<div>
 <table>
    <caption class="sr-only">Meeting Table 1</caption>
    <thead>
        <tr>
            <th scope="col">Meeting Time</th>
            <th scope="col">Meeting Date</th>
            <th scope="col">Student Participants</th>
            <th scope="col">Assigned Tasks</th>
            <th scope="col">Completion Date</th>
        </tr>
    </thead> 
    <tbody> 
    
    ';
    

if ($meeting_result->num_rows > 0) {
    // output data of each row
    
    
    while($row = $meeting_result->fetch_assoc()) {
    
    	echo "<tr><td>".$row["meeting_time"].
        "</td><td>".$row["meeting_date"]."</td>";
        
        
        //Student query
        
    	$student_query = 'Select s.first_name, s.last_name, sa.attendance
from meeting as mt, student as s, student_attendance as sa
where mt.teamID = s.teamID and sa.meetingID = mt.MeetingID and sa.studentID = s.StudentID
and mt.MeetingID = '.$row["MeetingID"].';';

		
		$student_result = $conn->query($student_query);
        
        
        echo "<td>"; 
        
		if ($student_result->num_rows > 0) {
       		while($student_row = $student_result->fetch_assoc()) {
        		echo nl2br( $student_row["first_name"]." ".$student_row["last_name"]." ( ".$student_row["attendance"].")\n");
        	}
       } 
        echo "</td>";
        
        
       
          // Task Query
        
   		$task_query = 'Select content
from task 
where meetingID = '.$row['MeetingID'].';';

		
		$task_result = $conn->query($task_query);
		
		          // Task Query
        
   		$task_completion_query = 'Select completion_date
from task 
where meetingID = '.$row['MeetingID'].';';

		
		$task_completion_result = $conn->query($task_completion_query);
       
        echo "<td>"; 
        
		if ($task_result->num_rows > 0) {
       		while($task_row = $task_result->fetch_assoc()) {
        		echo nl2br( $task_row["content"]." \n");
        		echo $task_row["completion_date"];
        	}
       } 
        echo "</td>";   

   		echo "<td>"; 
        
		if ($task_completion_result->num_rows > 0) {
       		while($task_row = $task_completion_result->fetch_assoc()) {
        		echo nl2br( $task_row["completion_date"]." \n");
        	}
       } 
        echo "</td>";     
        echo "</tr>";
     }
} else {
    echo "0 results";
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
