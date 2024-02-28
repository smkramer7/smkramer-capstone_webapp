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
        <a href="#">Meeting Manager</a>
    </span>
    <!-- Wrapper for header interactive elements -->
    
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

 $all_team_query = "Select TeamID
from team;";

$all_team_result = $conn->query($all_team_query);


 echo
 '<div class="rvt-container">
<div class="rvt-grid">
	<div class="rvt-grid__item-8 rvt-grid__item--last">
		<h1 class="rvt-ts-md rvt-ts-xl-md-up">Login Options</h1>
	</div> 
</div>
<br>
<br>
<div class="rvt-grid">
	<div class="rvt-grid__item-3"></div>
	<div class="rvt-grid__item-2">
		<h2 class="rvt-ts-md rvt-ts-l-md-up">Student Login</h2>
	</div> 
	<div class="rvt-grid__item-5 rvt-grid__item--last">
		<h2 class="rvt-ts-md rvt-ts-l-md-up">Instructor Login</h2>
	</div> 
</div>

<div class="rvt-grid">
	<div class="rvt-grid__item-3"></div>
	<div class="rvt-grid__item-2">';
	
//echo '<form id="filterselect" action="login.php?team='.$_GET["team"].'" method="GET">
//echo '<form id="filterselect" action="https://cas.iu.edu/cas/login?cassvc=IU&casurl=https://cgi.soic.indiana.edu/~smkramer/i491/smkramer/StudentMeetingView.php?team='.$_GET["team"].'" method="GET">
echo '<form id="filterselect" action="StudentMeetingView.php?team='.$_GET["team"].'" method="GET">
<label for="select-team">Select Team:</label>
<select id="select-team"  name="team" onchange="this.form.submit()">
<option value="">Choose a team...</option>';

if ($all_team_result->num_rows > 0) {
    // output data of each row
    
    
    while($team_row = $all_team_result->fetch_assoc()) {
    		echo "<option value=".$team_row["TeamID"].'>'.$team_row["TeamID"]."</option>";
    }
}

echo '</select>
</div>
<div class="rvt-grid__item-5 rvt-grid__item--last">
		<a href="https://cas.iu.edu/cas/login?cassvc=IU&casurl=https://cgi.soic.indiana.edu/~smkramer/i491/smkramer/MeetingView.php">Login</a>
</div>
</div>
</div> ';

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
