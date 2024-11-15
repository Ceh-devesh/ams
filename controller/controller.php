<?php
include_once('../config/connection.php');

// Check if a key is provided
if (!isset($_REQUEST['key'])) {
    echo "Key is missing";
    exit;
}

$key = $_REQUEST['key'];

// Route based on key
switch ($key) {
    case "employee_add":
        employee_add();
        break;
    case "employee_list":
        employee_list();
        break;
    default:
        echo "Please provide a valid key";
        break;
}

// Function to add an employee
function employee_add() {
    global $conn;

    // Capture employee details
    $employee_name = $_REQUEST['employee_name'] ?? '';
    $employee_code = $_REQUEST['employee_code'] ?? '';
    $employee_gender = $_REQUEST['employee_gender'] ?? '';
    $date = date("Y-m-d H:i:s");

    // Check if all required fields are provided
    if (empty($employee_name) || empty($employee_code) || empty($employee_gender)) {
        echo "3";
        return;
    }

    // Check for duplicate employee_code
    $check_stmt = $conn->prepare("SELECT 1 FROM employees WHERE employee_code = ?");
    $check_stmt->bind_param("s", $employee_code);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Duplicate employee_code found
        echo "4";
        $check_stmt->close();
        return;
    }
    $check_stmt->close();

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO employees (employee_name, employee_code, employee_gender, date) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $employee_name, $employee_code, $employee_gender, $date);
    echo $stmt->execute() ? 1 : 0;
    $stmt->close();
}

// Function to list employees
function employee_list() {
    global $conn;

    $result = $conn->query("SELECT * FROM employees");

    if ($result->num_rows > 0) {
        $employees = [];
        while ($row = $result->fetch_assoc()) {
            $employees[] = $row;
        }
        echo json_encode($employees);
    } else {
        echo "No employees found.";
    }
}
?>
