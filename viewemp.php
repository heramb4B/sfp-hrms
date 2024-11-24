<?php

require_once ('process/dbh.php');
$sql = "SELECT * from `employee` , `rank` WHERE employee.id = rank.eid";

//echo "$sql";
$result = mysqli_query($conn, $sql);

?>



<html>
<head>
	<title>Employee List |  Admin Panel | Employee Management System</title>
	<link rel="stylesheet" type="text/css" href="styleview.css">
	<style>
	table {
      width: 1200px;
      margin: 0 auto;
      background-color: #fff;
      border-collapse: collapse;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    th, td {
      padding: 10px;
      text-align: center;
    }

    th {
      background-color: #187bcd;
      color: #fff;
      font-weight: bold;
    }

    tr:nth-child(even) {
      background-color: #e6f7ff;
    }
	</style>
</head>
<body>
	<header>
		<nav>
		<h1>SFP | HRMS Admin</h1>
			<ul id="navli">
				<li><a class="homeblack" href="aloginwel.php">HOME</a></li>
				<li><a class="homeblack" href="addemp.php">Add Employee</a></li>
				<li><a class="homered" href="viewemp.php">Employee List</a></li>
				<li><a class="homeblack" href="empattendance.php">Attendance</a></li>

				<!-- <li><a class="homeblack" href="assign.php">Assign Project</a></li>
				<li><a class="homeblack" href="assignproject.php">Project Status</a></li> -->
				<!-- <li><a class="homeblack" href="salaryemp.php">Salary </a></li> -->
				<li><a class="homeblack" href="empleave.php">Employee Leave</a></li>
				<li><a class="homeblack" href="alogin.html">Log Out</a></li>
			</ul>
		</nav>
	</header>
	
	<div class="divider"></div>

		<table style="margin-top: 15px">
			<tr>

				<th align = "center">ID</th>
				<!-- <th align = "center">Picture</th> -->
				<th align = "center">Name</th>
				<th align = "center">Gender</th>
				<th align = "center">Address</th>
				<th align = "center">Contact</th>
				<th align = "center">Email</th>
				<!-- <th align = "center">DoB</th> -->
				<th align = "center">Aadhar</th>
				<th align = "center">Employee ID</th>
				<!-- <th align = "center">PAN</th> -->
				<th align = "center">Department</th>
				<!-- <th align = "center">Degree</th> -->
				<!-- <th align = "center">Point</th> -->
				
				
				<th align = "center">Options</th>
			</tr>

			<?php
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$employee['id']."</td>";
					// echo "<td><img src='process/".$employee['pic']."' height = 60px width = 60px></td>";
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['gender']."</td>";
					echo "<td>".$employee['address']."</td>";
					echo "<td>".$employee['contact']."</td>";
					echo "<td>".$employee['email']."</td>";
					// echo "<td>".$employee['birthday']."</td>";
					echo "<td>".$employee['aadhar']."</td>";
					echo "<td>".$employee['employee_id']."</td>";
					// echo "<td>".$employee['pan']."</td>";
					echo "<td>".$employee['dept']."</td>";
					// echo "<td>".$employee['degree']."</td>";
					// echo "<td>".$employee['points']."</td>";

					echo "<td>  <a href=\"delete.php?id=$employee[id]\" onClick=\"return confirm('Are you sure you want to delete?')\">Delete</a>&nbsp;&nbsp;<a href=\"edit.php?id=$employee[id]\">Edit</a></td>";
				
				}


			?>

		</table>
		
	
</body>
</html>