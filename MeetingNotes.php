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
                    <a href="MeetingView.php">View Meetings</a>
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
//echo var_dump($_POST);

// Team Name, meeting date, meeting time Query

$meeting_query = "Select time_format(mt.meeting_time,'%h:%i %p') as meeting_time,
mt.meeting_date, mt.teamID, mt.MeetingID, date_format(mt.meeting_date,'%b %d %Y') as display_date
from meeting as mt where mt.MeetingID = ".$_GET["meeting"]." ORDER BY MeetingID desc;"; 



$meeting_result = $conn->query($meeting_query);


if ($meeting_result->num_rows > 0) {
    // output data of each row
    
    
$row = $meeting_result->fetch_assoc();}
else {echo "Failed to retrieve MeetingID";}


reset($_POST);
foreach($_POST as $key => $value) {
	if (!$value) {continue;}
	
	if (strpos($key, "student")===0) {
		$sid = str_replace("student", "", $key);
		
	// Student Post Query

    	$student_query = 'Select * from student_attendance
where studentID = '.$sid.'
and meetingID = '.$row["MeetingID"].';';

		
		$student_result = $conn->query($student_query);
		if ($student_result->num_rows > 0) {
    // output data of each row
    
    
			$student_row = $student_result->fetch_assoc();
			$attendance_update = 'update student_attendance 
			set attendance="'.$value.'" where studentID='.$sid.' and meetingID='.$row["MeetingID"].';';
			
		 	
			}
			
		else {$attendance_update = 'insert into student_attendance 
									(attendance, studentID, meetingID) 
									VALUES ("'.$value.'",'.$sid.','.$row["MeetingID"].');';
									}
		$conn->query($attendance_update);
			
			}

	if ($key == "text_note") {
		$note_update = 'insert into note 
									(content, meetingID) 
									VALUES ("'.$value.'",'.$row["MeetingID"].');';
		
		$conn->query($note_update); }
		
	if ($key == "text_task") {
		$task_update = 'insert into task 
									(content, assigned_date, teamID, meetingID) 
									VALUES ("'.$value.'","'.$row["meeting_date"].'",'.$row["teamID"].','.$row["MeetingID"].');';
		
		$conn->query($task_update); }
		
		
	if (strpos($key, "task")===0)  {
		$tid = str_replace("task", "", $key);
		$task_update = 'update task set completion_date = "'.$row["meeting_date"].'"
						where TaskID = '.$tid.';';
		
		
		$conn->query($task_update); }

		
		
	if (strpos($key, "rating")===0) {
		$rid = str_replace("rating", "", $key);
		
		
			// Rating Post Query

    	$rating_query = 'Select * from meeting_rating
where ratingID = '.$rid.'
and meetingID = '.$row["MeetingID"].';';

		
		$rating_result = $conn->query($rating_query);
		if ($rating_result->num_rows > 0) {
    // output data of each row
    
    
			$rating_row = $rating_result->fetch_assoc();
			$rating_update = 'update meeting_rating 
			set value="'.$value.'" where ratingID='.$rid.' and meetingID='.$row["MeetingID"].';';
			
		 	
			}
			
		else {$rating_update = 'insert into meeting_rating 
									(value, ratingID, meetingID) 
									VALUES ('.$value.','.$rid.','.$row["MeetingID"].');';
									}
		$conn->query($rating_update);
			
			}
			
		
		
	// next($_POST);
}





//Form 
echo 
' <form id="meetingform" name = "meetingform" action="" method = "POST">

 <div class="rvt-container"> 
<div class="rvt-grid">
	<div class="rvt-grid__item-3">
		<div class="rvt-grid">
			<div class="rvt-grid__item">
			<h1 class="rvt-ts-md rvt-ts-xl-md-up">Team '.$row["teamID"].'</h1>
			</div> 
		</div>


    	<div class="rvt-grid">
			<div class="rvt-grid__item"> <p class="rvt-ts-sm">'.$row["display_date"].', '.$row["meeting_time"].'</p></div>
		</div>
	</div>';

// Student Query

    	$student_query = 'Select s.first_name, s.last_name, sa.attendance, s.StudentID
from meeting as mt, student as s, student_attendance as sa
where mt.teamID = s.teamID and sa.meetingID = mt.MeetingID and sa.studentID = s.StudentID
and mt.MeetingID = '.$row["MeetingID"].';';

		
		$student_result = $conn->query($student_query);

echo '
	<div class="rvt-grid__item-3 rvt-grid__item--last">
	
	<table class="rvt-table-plain">
    <caption class="sr-only">Student Attendance</caption>
    
    <thead>
        <tr>
            <th scope="col">Student Attendance</th>
        </tr>
    </thead>
    
	<tbody>';
	if ($student_result->num_rows > 0) {
       		while($student_row = $student_result->fetch_assoc()) {
       			echo '<tr>
            <th scope="row">'.$student_row["first_name"].' '.$student_row["last_name"].'</th>
            <td> <select id="'.$student_row["StudentID"].'" name = "student'.$student_row["StudentID"].'">
    				<option>Choose an option...</option>';
					if ($student_row["attendance"]){
					echo'<option value="" selected>'.$student_row["attendance"].'</option>';}
	
    				echo '<option value="Present">Present</option>
    				<option value="Missed">Missed</option>
    				<option value="Late">Late</option>
				</select>
			</td>
        </tr>';
        	}
       } 

echo'      
    </tbody>
	</table>
    
	</div>
</div>
</div>
<br>
<br>

<div class="rvt-container">
<div class="rvt-grid">
	<div class="rvt-grid__item">
		<div class="rvt-grid">
		<table class="rvt-table-compact">
    	<caption class="sr-only">Meeting Notes</caption>
    	<thead>
        	<tr>
            	<th scope="col">Previous Meeting Notes</th>
        	</tr>
    	</thead>
    	<tbody>';
    	
    	// Current Note Query
    	
    	$note_query = 'Select content 
from note 
where meetingID = '.$row['MeetingID'].';';


		$note_result = $conn->query($note_query);
		
		// Previous Note Query
		
		$prev_meeting_query = 'select MeetingID from meeting where teamID= '.$row['teamID'].'
		and MeetingID < '.$row['MeetingID'].' order by meeting_date desc limit 1;';
		
		$prev_meeting_result = $conn->query($prev_meeting_query);
		
		if ($prev_meeting_result->num_rows > 0) {
       		$prev_meeting = $prev_meeting_result->fetch_assoc(); }
       	
		//Previous Note query 2
		
		$prev_note_query = 'select n.content, n.meetingID from note as n, meeting 
		where n.meetingID = meeting.MeetingID and meeting.teamID = '.$row['teamID'].' and 
		n.meetingID = '.$prev_meeting['MeetingID'].';';

		$prev_note_result = $conn->query($prev_note_query);
		
    	if ($prev_note_result->num_rows > 0) {
       		while($note_row = $prev_note_result->fetch_assoc()) {
        		echo '<tr><td>'.$note_row["content"].'</td></tr>';
        	}
       } 
    	echo '
    	</tbody>
    	</table>
		</div>
		<br>
		<br>
		<div class="rvt-grid">
		<table class="rvt-table-compact">
    	<caption class="sr-only">Meeting Notes</caption>
    	<thead>
        	<tr>
            	<th scope="col">Current Meeting Notes</th>
        	</tr>
    	</thead>
    	<tbody>';
    	
    	if ($note_result->num_rows > 0) {
       		while($note_row = $note_result->fetch_assoc()) {
        		echo '<tr><td>'.$note_row["content"].'</td></tr>';
        	}
       } 
        echo '
        
    	</tbody>
    	</table>
		</div>
		<br>
		
		
		<div class="rvt-grid-5">
		
				<label for ="text_note">Add New Note</label>
		<textarea id= "text_note" form = "meetingform" name = "text_note" class="rvt-m-bottom-md"></textarea>
		</div>
	</div>
	
	<div class="rvt-grid__item">
		<div class="rvt-grid">
		<table class="rvt-table-compact">
    	<caption class="sr-only">Meeting Tasks</caption>
    	<thead>
        	<tr>
            	<th scope="col">Outstanding Tasks</th>
            	<th scope="col">Assigned Date</th>
            	<th scope="col">Completed?</th>
        	</tr>
    	</thead>
    	<tbody>';
    	
    	// Current Task Query
    	
    	$task_query = 'Select content, TaskID, completion_date, date_format(assigned_date,"%b %d %Y") as date
from task 
where meetingID = '.$row['MeetingID'].';';


		$task_result = $conn->query($task_query);
		
		// Outstanding Task Query
		
		$out_task_query = 'Select content, TaskID, date_format(assigned_date,"%b %d %Y") as date
from task 
where completion_date is null and teamID = '.$row['teamID'].';';


		$out_task_result = $conn->query($out_task_query);
    	
    	
    	if ($out_task_result->num_rows > 0) {
       		while($task_row = $out_task_result->fetch_assoc()) {
        		echo '<tr><td>'.$task_row["content"].'</td><td>'.$task_row["date"].'</td><td>
        		<input type="checkbox" name="task'.$task_row["TaskID"].'" id="task'.$task_row["TaskID"].'">
                <label for="task'.$task_row["TaskID"].'" class="rvt-m-right-sm"></label></td></tr>';
        	}
       } 
       
        echo '	
        
    	</tbody>
    	</table>
		</div>
		<br>
		<br>
		<div class="rvt-grid">
		<table class="rvt-table-compact">
    	<caption class="sr-only">Meeting Tasks</caption>
    	<thead>
        	<tr>
            	<th scope="col">Current Tasks</th>
            	<th scope="col">Assigned Date</th>
            	<th scope="col">Completed?</th>
        	</tr>
    	</thead>
    	<tbody>';
    	
        if ($task_result->num_rows > 0) {
       		while($task_row = $task_result->fetch_assoc()) {
        		echo '<tr><td>'.$task_row["content"].'</td><td>'.$task_row["date"].'</td><td>';
    			if ($task_row["completion_date"]){
    				echo '<input type="checkbox" name= "task'.$task_row["TaskID"].'" id="current_task'.$task_row["TaskID"].'" disabled checked>';
        		}
        		else {
        			echo '<input type="checkbox" name= "task'.$task_row["TaskID"].'" id="current_task'.$task_row["TaskID"].'">';
        		}
                echo '<label for="current_task'.$task_row["TaskID"].'" class="rvt-m-right-sm"></label></td></tr>';
        	}
       } 
echo '	</tbody>
    	</table>
		</div>
		<br>
		
		
		
		<div class="rvt-grid-5">
		<label for ="text_task">Add New Task</label>
		<textarea id= "text_task" form = "meetingform" name = "text_task" class="rvt-m-bottom-md"></textarea>
      	
      	</div>
	</div>
</div>
</div>
<br>

<div class="rvt-container"> 

<div class="rvt-grid"> 
	<div class="rvt-grid__item-2">
	<input type = "submit" value = "Save Changes" />
	</div>
</div>

<div class="rvt-grid">
	<div class="rvt-grid__item-2">
				<p class="rvt-ts-sm"> Team Ratings </p>
	</div>
</div>';


// Rating Query
		
		$rating_query = 'select r.RatingID, r.rating_name, r.lowest_rank, r.highest_rank 
		from rating as r;';
		
		$rating_result = $conn->query($rating_query);
		
		if ($rating_result->num_rows > 0) {
       		while($rating_row = $rating_result->fetch_assoc()) {
       		
// Rating Meeting Query
        
   				$rating_meeting_query = 'Select r.RatingID, r.rating_name, mr.value
from rating as r, meeting_rating as mr
where r.RatingID = mr.ratingID and mr.meetingID = '.$row['MeetingID'].' 
and mr.RatingID = '.$rating_row["RatingID"].';';

		
				$rating_meeting_result = $conn->query($rating_meeting_query);
				if ($rating_meeting_result->num_rows > 0) {
				$rating_value = $rating_meeting_result->fetch_assoc();}
        		echo '<div class="rvt-grid">
	<div class="rvt-grid__item-2">
				<p class="rvt-ts-sm-20">'.$rating_row["rating_name"].'</p>
				<select id="'.$rating_row["RatingID"].'" name = "rating'.$rating_row["RatingID"].'">
    				<option>Choose a rating...</option>';
    				foreach (range($rating_row['lowest_rank'], $rating_row['highest_rank']) as $number) {
    					if ($number == $rating_value['value'])
    						{echo '<option value="'.$number.'" selected>'.$number.'</option>';}
    						
    					else {echo '<option value="'.$number.'">'.$number.'</option>';}
    				}
			echo '	</select>
	</div>
</div>';
        	}
       } 
echo '
</div> </form>';
		


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
