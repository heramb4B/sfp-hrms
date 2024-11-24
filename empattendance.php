<?php 
require_once ('process/dbh.php');
$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
$result = mysqli_query($conn, $sql);
$sql2 = "SELECT ea.id, ea.employee_id, ea.login_time, ea.logout_time, e.firstName, e.lastName, e.employee_id 
        FROM employee_attendance as ea
        INNER JOIN employee as e ON ea.employee_id = e.id";
$result2 = mysqli_query($conn, $sql2);

?>


<html>
<head>
	<title>Admin Panel | HRMS | SFP </title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
    
</head>
<body>
	
	<header>
		<nav>
			<h1>ADMIN | Employee Attendance</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homeblack" href="viewemp.php">Employee List</a></li>
				<li><a class="homered" href="empattendance.php">Attendance</a></li>
				<!-- <li><a class="homeblack" href="salaryemp.php">Salary </a></li> -->
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Empolyee Attendance </h2>
        <table style="width: 90%; margin-left: 50px;">

			<tr bgcolor="#fff">
            <th align = "center">Attendance ID</th>
            <th align = "center">Emp. ID</th>
				<!-- <th align = "center">SFP Emp. ID</th> -->
				<th align = "center">Name</th>
				<th align = "center">Login Time</th>
				<th align = "center">Logout Time</th>
				

			</tr>

			

			<?php
				
				while ($employee_attendance = mysqli_fetch_assoc($result2)) {
					echo "<tr>";
					echo "<td>".$employee_attendance['id']."</td>";
					echo "<td>".$employee_attendance['employee_id']."</td>";
                    echo "<td>".$employee_attendance['firstName']." ".$employee_attendance['lastName']."</td>";
					echo "<td>".$employee_attendance['login_time']."</td>";
					echo "<td>".$employee_attendance['logout_time']."</td>";
					
	
					
					
				}


			?>

           

		</table> 

	
		
	</div>
</body>
</html>