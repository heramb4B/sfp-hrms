<?php 
// Start the session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if the user is authenticated and the empid is available in the session
if (isset($_SESSION['empid'])) {
    $employee_id = $_SESSION['empid'];
} else {
    // If empid is not available in the session, check if it is available in the URL
    $employee_id = (isset($_GET['id']) ? $_GET['id'] : '');
}

// Check if sfp_emp_id is available in the URL
$sfp_employee_id = (isset($_GET['sfp_emp_id']) ? $_GET['sfp_emp_id'] : '');

// Proceed with the logout process only if the employee_id is not empty
if (!empty($employee_id)) {
    // Set the timezone and get the logout time
    date_default_timezone_set('Asia/Kolkata');
    $logoutTime = date('Y-m-d H:i:s'); // Current date and time in 'Y-m-d H:i:s' format

    // Prepare the SQL statement with a prepared statement
    require_once('process/dbh.php'); // Assuming this file contains the database connection code

    // Check if sfp_emp_id is not empty before using it in the query
    if (!empty($sfp_employee_id)) {
        $logoutSql = "INSERT INTO `employee_attendance` (employee_id, sfp_emp_id, logout_time) VALUES (?, ?, ?)";
        $stmt = mysqli_prepare($conn, $logoutSql);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind the parameters and execute the query
            mysqli_stmt_bind_param($stmt, 'iis', $employee_id, $sfp_employee_id, $logoutTime);
            $logoutResult = mysqli_stmt_execute($stmt);

            // Check if the query was successful
            if ($logoutResult) {
                // Destroy the session after recording the logout time
                session_unset();
                session_destroy();
                // Redirect the user to the login page or any other desired page
                header("Location: contact.html"); // Replace "login.php" with the desired destination after logout
                exit();
            } else {
                // Handle the case where the database insert failed
                // You might want to log the error or display an error message to the user
                // It's essential to handle database errors gracefully in a production environment
                die("Database insert failed: " . mysqli_error($conn));
            }
        } else {
            // Handle the case where the statement preparation failed
            // You might want to log the error or display an error message to the user
            die("Statement preparation failed: " . mysqli_error($conn));
        }
    } else {
        // Handle the case where sfp_emp_id is empty or not set
        die("sfp_emp_id is empty or not set.");
    }
} else {
    // Redirect the user to the login page or any other appropriate page if employee_id is not available
    header("Location: index.html"); // Replace "login.php" with the login page or any other appropriate destination
    exit();
}
