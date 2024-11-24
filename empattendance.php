<!DOCTYPE html>
<html>
<head>
    <title>Employee List</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
    <style>
        table {
            width: 90%;
            margin-left: 50px;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        th {
            background-color: #ccc;
        }

        a {
            text-decoration: none;
        }
    </style>
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
    <!-- <h1>Employee List</h1> -->
    <table>
        <tr>
            <th>Emp. ID</th>
            <th>Name</th>
        </tr>

        <?php
        // Establish database connection and fetch employee data
        $db = mysqli_connect("localhost", "root", "", "ems");
        $query = "SELECT * FROM `employee`";
        $result2 = mysqli_query($db, $query);

        while ($employee_attendance = mysqli_fetch_assoc($result2)) {
            echo "<tr>";
            echo "<td>".$employee_attendance['employee_id']."</td>";
            
            // Modify this line to include a link to the employee_record.php page with the employee_id as a query parameter
            echo '<td><a href="employee_record.php?employee_id='.$employee_attendance['id'].'">'.$employee_attendance['firstName'].' '.$employee_attendance['lastName'].'</a></td>';
        }
        ?>
    </table>
</body>
</html>
