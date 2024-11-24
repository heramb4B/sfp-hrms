<?php

require_once ('dbh.php');

$email = $_POST['mailuid'];
$password = $_POST['pwd'];

$sql = "SELECT * from `employee` WHERE email = '$email' AND password = '$password'";
$sqlid = "SELECT id from `employee` WHERE email = '$email' AND password = '$password'";
$sqlid2 = "SELECT employee_id from `employee` WHERE email = '$email' AND password = '$password'";

$result = mysqli_query($conn, $sql);
$id = mysqli_query($conn , $sqlid);
$id2 = mysqli_query($conn , $sqlid2);

$empid = "";

if (isset($_POST['mailuid']) && isset($_POST['pwd'])) {
    // User is attempting to log in

    $email = $_POST['mailuid'];
    $password = $_POST['pwd'];

    $sql = "SELECT * FROM `employee` WHERE email = '$email' AND password = '$password'";
    $sqlid = "SELECT id FROM `employee` WHERE email = '$email' AND password = '$password'";
    $sqlid2 = "SELECT employee_id FROM `employee` WHERE email = '$email' AND password = '$password'";

    // $setLoginTime = "INSERT INTO `employee_attendance` (employee_id, login_date_time) VALUES ()"

    $result = mysqli_query($conn, $sql);
    $id = mysqli_query($conn, $sqlid);
    $employee_id = mysqli_query($conn, $sqlid2);


    if (mysqli_num_rows($result) == 1) {

        $employee = mysqli_fetch_array($id);
        $empid = ($employee['id']);
        $sfp_emp_id = ($employee['employee_id']);

        // Save login time in the database
		date_default_timezone_set('Asia/Kolkata');
        $loginTime = time();
        $loginDateTime = date('Y-m-d H:i:s', $loginTime);
        $sfp_emp_id = ($employee['employee_id']);
        $loginSql = "INSERT INTO employee_attendance (employee_id, sfp_emp_id, login_time) VALUES ('$empid', '$sfp_emp_id', '$loginDateTime')";
        mysqli_query($conn, $loginSql);


        //debugh 
      
            echo "empid: " . $empid . "<br>";
            echo "sfp_emp_id: " . $sfp_emp_id . "<br>";
          // Check for errors in the INSERT query
            if ($insertResult === false) {
                echo "Error inserting login data: " . mysqli_error($conn) . "<br>";
            } else {
                echo "Login data inserted successfully.<br>";
            }


        header("Location: ..//eloginwel.php?id=$empid");
        exit();
    } else {
        echo ("<SCRIPT LANGUAGE='JavaScript'>
        window.alert('Invalid Email or Password')
        window.location.href='javascript:history.go(-1)';
        </SCRIPT>");
        exit();
    }
} 

// elseif (isset($_GET['logout']) && $_GET['logout'] == true) {
    // User is attempting to log out

    // Assuming you are passing empid as a query parameter in the URL when logging out.
	log($empid);
	$message = "This is a log message.";
	file_put_contents("logs.txt", $message . PHP_EOL, FILE_APPEND);
	if (isset($_GET['empid'])) {
		var_dump($empid);
        $empid = $_GET['empid'];
        echo "EmpID: " . $empid . "<br>";
    } else {
        echo "EmpID not found in the URL.<br>";
    }

	date_default_timezone_set('Asia/Kolkata');
	$logoutTime = time();
	$logOutDateTime = date('Y-m-d H:i:s', $logoutTime);
    $logoutSql = "INSERT INTO employee_attendance (employee_id, logout_data_time) VALUES ('$empid', '$logOutDateTime')";
    $logoutResult = mysqli_query($conn, $logoutSql);

    // Debugging: Check if the query is executed successfully
    if ($logoutResult) {
        echo "<script>alert('Logout time updated successfully.');</script>";
		var_dump("successful");
    } else {
        echo "Error updating logout time: " . mysqli_error($conn) . "<br>";
    }
// }
?>	