<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
	$id = (isset($_GET['id']) ? $_GET['id'] : '');
	require_once ('process/dbh.php');
	 $sql1 = "SELECT * FROM `employee` where id = '$id'";

	 $result1 = mysqli_query($conn, $sql1);
	 $employeen = mysqli_fetch_array($result1);
	 $empName = ($employeen['firstName']);
	 $empid = ($employeen['id']);
	 $employee_id = ($employeen['employee_id']);

	$sql = "SELECT id, firstName, lastName,  points FROM employee, rank WHERE rank.eid = employee.id order by rank.points desc";
	// echo($sql1);
	// $sql1 = "SELECT `pname`, `duedate` FROM `project` WHERE eid = $id and status = 'Due'";

	$sql2 = "Select * From employee, employee_leave Where employee.id = $id and employee_leave.id = $id order by employee_leave.token";

	$sql3 = "SELECT * FROM `salary` WHERE id = $id";

//echo "$sql";
$result = mysqli_query($conn, $sql);
$result1 = mysqli_query($conn, $sql1);
$result2 = mysqli_query($conn, $sql2);
$result3 = mysqli_query($conn, $sql3);





?>



<html>
<head>
	<title>Employee Panel | HRMS | SFP</title>
	<link rel="stylesheet" type="text/css" href="styleemplogin.css">
	<link href="https://fonts.googleapis.com/css?family=Lobster|Montserrat" rel="stylesheet">
	<STYle>
		 table {
      width: 1000px;
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

	/* Styles for the card */
    .card {
	  margin-left: 15%;
	  width: 1050px;
      height: 1050px;
      background-color: white;
      color: black;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 4px 6px rgba(0.6, 0.6, 0.6, 0.6);
    }

    /* Styles for the text inside the card */
    .card-text {
		font-size: 18px;
      line-height: 1.5;
    }
	</STYle>
	<script>
        // Function to display the logout time alert
        function showLogoutAlert() {
            var currentTime = new Date();
            var formattedTime = currentTime.toLocaleString('en-US', {
                hour: 'numeric',
                minute: 'numeric',
                second: 'numeric',
                hour12: true
            });

            alert('You will be logged out at ' + formattedTime);
        }
    </script>
</head>
<body>
	
	<header>
		<nav>
			<h1>Sankalp Food Products</h1>
			<ul id="navli">
				<li><a class="homered" href="eloginwel.php?id=<?php echo $id?>"">Home</a></li>
				<li><a class="homeblack" href="myprofile.php?id=<?php echo $id?>"">My Profile</a></li>
				<!-- <li><a class="homeblack" href="empproject.php?id=<?php echo $id?>"">My Projects</a></li> -->
				<li><a class="homeblack" href="applyleave.php?id=<?php echo $id?>"">Leave</a></li>
				<li><a class="homeblack" href="javascript:showLogoutAlert(); window.location.href='logout.php?id=<?php echo $id; ?>&sfp_emp_id=<?php echo $employee_id; ?>'">Log Out</a></li>
			</ul>
		</nav>
	</header>
	 
	<div class="divider"></div>
	<div id="divimg">
	<div>
		<?php  ?>
		<center><h4>Welcome <?php echo "$empName", "  "; ?> </h4></center>
		<center><h4>Your Employee Id is: <?php echo "$employee_id", "  "; ?> </h4></center>

		    	<!-- <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Empolyee Leaderboard </h2>
    	<table>

			<tr bgcolor="#000">
				<th align = "center">Seq.</th>
				<th align = "center">Emp. ID</th>
				<th align = "center">Name</th>
				<th align = "center">Points</th>
				

			</tr>

			

			<?php
				$seq = 1;
				while ($employee = mysqli_fetch_assoc($result)) {
					echo "<tr>";
					echo "<td>".$seq."</td>";
					echo "<td>".$employee['id']."</td>";
					
					echo "<td>".$employee['firstName']." ".$employee['lastName']."</td>";
					
					echo "<td>".$employee['points']."</td>";
					
					$seq+=1;
				}


			?>

		</table> -->
   
    	<!-- <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Due Projects</h2>
    	

    	<table>

			<tr>
				<th align = "center">Project Name</th>
				<th align = "center">Due Date</th>
				
			</tr>

			

			<?php
				while ($employee1 = mysqli_fetch_assoc($result1)) {
					echo "<tr>";
					
					echo "<td>".$employee1['pname']."</td>";
					
					echo "<td>".$employee1['duedate']."</td>";

				}


			?>

		</table> -->



		<!-- <h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Salary Info</h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Base Salary</th>
				
				<th align = "center">PF</th>
				<th align = "center">Total Salary</th>
				
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result3)) {
					

					echo "<tr>";
					
					
					echo "<td>".$employee['base']."</td>";
					
					echo "<td>".$employee['pf']."</td>";
					echo "<td>".$employee['base']-$employee['pf']."</td>";
					
				}


				


			?>

		</table> -->










		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">Leave Satus</h2>
    	

    	<table>

			<tr>
				
				<th align = "center">Start Date</th>
				<th align = "center">End Date</th>
				<th align = "center">Total Days</th>
				<th align = "center">Reason</th>
				<th align = "center">Status</th>
			</tr>

			

			<?php
				while ($employee = mysqli_fetch_assoc($result2)) {
					$date1 = new DateTime($employee['start']);
					$date2 = new DateTime($employee['end']);
					$interval = $date1->diff($date2);
					$interval = $date1->diff($date2);

					echo "<tr>";
					
					
					echo "<td>".$employee['start']."</td>";
					echo "<td>".$employee['end']."</td>";
					echo "<td>".$interval->days."</td>";
					echo "<td>".$employee['reason']."</td>";
					echo "<td>".$employee['status']."</td>";
					
				}


				


			?>

		</table>
				<br>
		<h2 style="font-family: 'Montserrat', sans-serif; font-size: 25px; text-align: center;">About ZTP</h2>

		<div class="card">
    <p class="card-text">
	<b>Introduction:</b><br>
At <b>Sankalp Food Products,</b> we prioritize creating a safe and inclusive work environment for all our employees. <b><u>To uphold these values, we have implemented a Zero Tolerance Policy.</b></u> This policy ensures that any form of misconduct, discrimination, harassment, or unethical behavior is strictly prohibited and will not be tolerated under any circumstances. Our commitment to maintaining a respectful and supportive workplace is at the core of this policy.

<br><br>
<b><u>Our Zero Tolerance Policy:</b></u>	
<br><br>
<b>Respect and Dignity:</b> We believe in treating every individual with respect and dignity. Any behavior that undermines or violates these principles, such as bullying, discrimination, or harassment based on race, gender, sexual orientation, age, religion, or any other protected characteristic, is strictly prohibited.
<br><br>
<b>Clear Guidelines:</b> Our Zero Tolerance Policy provides clear guidelines on the types of behavior that are considered unacceptable. Employees are expected to familiarize themselves with these guidelines and conduct themselves accordingly.
<br><br>
<b>Reporting Mechanisms:</b> We encourage employees to report any incidents of misconduct or violations of our Zero Tolerance Policy. We have established confidential reporting mechanisms, including dedicated channels and trained personnel, to ensure that individuals feel safe and supported when coming forward with their concerns.
<br><br>
<b>Investigation and Action:</b> All reported incidents will be thoroughly investigated in a prompt, fair, and confidential manner. Appropriate action will be taken against individuals found in violation of the policy, which may include disciplinary measures, up to and including termination of employment.
<br><br>
<b>Support and Confidentiality:</b> We understand that reporting incidents can be challenging, and we are committed to providing support to those who come forward. We maintain confidentiality to the fullest extent possible, taking necessary measures to protect the privacy and well-being of all parties involved.
<br><br>
<b>Training and Awareness:</b> We regularly provide training/motivation sessions and resources to educate employees about our Zero Tolerance Policy, promoting awareness and understanding of expected behavior in the workplace. We believe that fostering a culture of respect and inclusivity requires ongoing education and reinforcement.
<br><br>
<b>Conclusion:</b><br>
At Sankalp Food Products, our Zero Tolerance Policy serves as a cornerstone for fostering a safe, respectful, and inclusive work environment. We are dedicated to upholding the dignity of every employee and ensuring that everyone feels valued, respected, and supported. By adhering to this policy, we strive to create an atmosphere where individuals can thrive and contribute their best, free from any form of misconduct or discrimination. Together, we can build a workplace culture that exemplifies our commitment to integrity, fairness, and equal opportunity for all.
	</p>
  </div>	

   
<br>
<br>
<br>
<br>
<br>







	</div>


		</h2>


		
		
	</div>
</body>
</html>

