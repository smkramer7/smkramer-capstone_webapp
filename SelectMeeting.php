<?php
    	$conn=mysqli_connect("db.sice.indiana.edu","i491u20_smkramer","my+sql=i491u20_smkramer", "i491u20_smkramer");
// Check connection
		if (mysqli_connect_errno())
			{echo nl2br("Failed to connect to MySQL: " . mysqli_connect_error() . "\n "); }
		else 
			{echo nl2br("Established Database Connection \n");}

//$section = mysqli_real_escape_string($conn, $_POST['section']);


$sql = "SELECT * FROM meeting;";


$result = $conn->query($sql);
echo 
 '<table>
    <caption class="sr-only">Meeting Table 1</caption>
    <thead>
        <tr>
            <th scope="col">Meeting Time</th>
            <th scope="col">Meeting Date</th>
            <th scope="col">Team</th>
            <th scope="col">Team Attendance</th>
        </tr>
    </thead> ';
    
if ($result->num_rows > 0) {
    // output data of each row
   // while($row = $result->fetch_assoc()) {
       // echo "<tr><td>".$row["FirstName"]."</td><td>".$row["LastName"]."</td></tr>";
    // }
} else {
    echo "0 results";
}
echo "</table>";
$conn->close();
?> 
