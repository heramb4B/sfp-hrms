<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Record</title>
    <link rel="stylesheet" type="text/css" href="styleemplogin.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        .container {
            width: 90%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.3);
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
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
    <h1>Employee Attendance Record</h1>
    <div class="container">
        <?php
        // Retrieve the employee_id from the URL query parameter
        if (isset($_GET['employee_id'])) {
            $employee_id = $_GET['employee_id'];

            // Establish database connection and fetch the selected employee's attendance records
            $db = mysqli_connect("localhost", "root", "", "ems");

            if (!$db) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            // Modify the SQL query to filter records for the selected employee
            $query = "SELECT ea.id, ea.employee_id, ea.login_time, ea.logout_time, e.firstName, e.lastName
                      FROM employee_attendance AS ea
                      INNER JOIN employee AS e ON ea.employee_id = e.id
                      WHERE ea.employee_id = $employee_id";

            $result = mysqli_query($db, $query);

            if (!$result) {
                die("Database query failed: " . mysqli_error($db));
            }

            // Display the records in a table
            echo '<table>';
            echo '<tr>';
            // echo '<th>Attendance ID</th>';
            // echo '<th>Emp. ID</th>';
            echo '<th style="color: black">Name</th>';
            echo '<th style="color: black">Date</th>';
            echo '<th style="color: black">In Time</th>';
            echo '<th style="color: black">Out Time</th>';
            echo '</tr>';

            while ($employee_attendance = mysqli_fetch_assoc($result)) {
                echo "<tr>";
                // echo "<td>".$employee_attendance['id']."</td>";
                // echo "<td>".$employee_attendance['sfp_emp_id']."</td>";
                echo "<td>".$employee_attendance['firstName']." ".$employee_attendance['lastName']."</td>";

                $date_only = date('d-m-Y', strtotime($employee_attendance['login_time']));
                if ($date_only !== "01-01-1970") {
                    echo "<td>".date('d-m-Y', strtotime($employee_attendance['login_time']))."</td>";
                } else {
                    echo "<td> </td>";
                }
                echo "<td>".date('H:i:s', strtotime($employee_attendance['login_time']))."</td>";
                echo "<td>".date('H:i:s', strtotime($employee_attendance['logout_time']))."</td>";
                echo "</tr>";
            }

            echo '</table>';
            
            // Close the database connection
            mysqli_close($db);
        } else {
            echo "<p>Employee ID not provided.</p>";
        }
        ?>
    </div>
</body>
</html>
