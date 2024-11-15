<?php include_once('controller/session.php'); ?>
<?php

include('config/connection.php');
use Shuchkin\SimpleXLSX;
ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once __DIR__.'/src/SimpleXLSX.php';



// Handle POST request from JavaScript to insert data into MySQL

// Check if form is submitted


if (isset($_POST['submit']) && $_POST['submit'] == 'Submit') {

    if (isset($_FILES['file'])) {
        // Retrieve month and year from the form
        $month = $_POST['month'] ?? '';
        $year = $_POST['year'] ?? '';

        // Validate the month and year (additional check if needed)
        if (empty($month) || empty($year)) {
            echo "<script>alert('Month and Year are required.');</script>";
            exit();
        }

        // Prepare database insert SQL statement with ? placeholders (for mysqli)
        $sql = "INSERT INTO attendance 
                (employee_code, employee_name, present_days, absent_days, pay_days, 
                normal_work_hrs, ot_hours, late_coming_days, late_coming_hours, 
                early_going_days, early_going_hours,weekly_off_present,holidays, month, year) 
                VALUES 
                (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?)";

        // Prepare the statement
        $stmt = $conn->prepare($sql);

        // Check if file is valid and parse using SimpleXLSX
        if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {

            $rowCount = 0;
            $duplicateFound = false; // Flag to track if any duplicate is found

            foreach ($xlsx->readRows() as $k => $row) {
                // Skip the first row (headers)
                if ($k == 0) continue;

                // Extract the data for the current row
                $employee_code = $row[0] ?? '';
                $employee_name = $row[1] ?? '';
                $present_days = $row[2] ?? '';
                $absent_days = $row[3] ?? '';
                $pay_days = $row[4] ?? '';
                $normal_work_hrs = $row[5] ?? '';
                $ot_hours = $row[6] ?? '';
                $late_coming_days = $row[14] ?? '';
                $late_coming_hours = $row[15] ?? '';
                $early_going_days = $row[16] ?? '';
                $early_going_hours = $row[17] ?? '';
                $weekly_off_present = $row[19] ?? '';
                $holiday = $row[20] ?? '';

                // Check if record already exists for this employee code, month, and year
                $checkSql = "SELECT 1 FROM attendance WHERE employee_code = ? AND month = ? AND year = ?";
                $checkStmt = $conn->prepare($checkSql);
                $checkStmt->bind_param('sss', $employee_code, $month, $year);
                $checkStmt->execute();
                $checkStmt->store_result();

                if ($checkStmt->num_rows > 0) {
                    // Duplicate found, set the flag and break out of the loop
                    $duplicateFound = true;
                    break; // Stop processing further rows
                }

                // Bind the parameters to the statement
                $stmt->bind_param(
                    'sssssssssssssss', // Data types for the parameters (all are strings, so 's' is used for each)
                    $employee_code,
                    $employee_name,
                    $present_days,
                    $absent_days,
                    $pay_days,
                    $normal_work_hrs,
                    $ot_hours,
                    $late_coming_days,
                    $late_coming_hours,
                    $early_going_days,
                    $early_going_hours,
                    $weekly_off_present,
                    $holiday,
                    $month,
                    $year
                );

                // Execute the insert statement for the current row
                if ($stmt->execute()) {
                    $rowCount++;
                }
            }

            // Check if any duplicate was found
            if ($duplicateFound) {
                echo "<script>alert('Duplicate entry found for Employee Code $employee_code, Month $month, and Year $year. No records were uploaded.')</script>";
            } else {
                // If no duplicate found, show the success message
                if ($rowCount > 0) {
                    echo "<script>alert('Successfully uploaded $rowCount attendance records.')</script>";
                } else {
                    echo "<script>alert('No records were uploaded.')</script>";
                }
            }

        } else {
            // Handle case where file can't be parsed
            echo "<script>alert('Failed to parse the uploaded file. Please check the file format and try again.')</script>";
        }

    } else {
        // Handle case where no file is attached
        echo "<script>alert('Please attach a file.')</script>";
    }

} else {
    // Handle case where form is not submitted correctly
    // echo "<script>alert('Form not submitted.')</script>";
}
?>







<!DOCTYPE html>
<html lang="en">
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Otika - Admin Dashboard Template</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.ico' />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">
    <style>
      body{
      font-family: "Outfit";
      }
    </style>
  </head>
  <body>

    <div class="loader"></div>
    <div id="app">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
         
        <?php include_once('header.php'); ?>
        <?php include_once('nav.php'); ?>
        
        <!-- Main Content -->
        <div class="main-content">
          <section class="section">
            <div class="section-body">
             

            <div class=" mt-2">
  <div class="d-flex">
    <!-- Selection Form Card -->
    <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h4>Select Options</h4>
        </div>
        <form action="" method="POST"  enctype="multipart/form-data">
        <div class="card-body">
          <!-- Select Month -->
          <div class="form-group">
            <label for="selectMonth">Select Month</label>
            <select class="form-control" id="selectMonth" name="month">
              <option value="" disabled selected>Select a month</option>
              <option value="January">January</option>
              <option value="February">February</option>
              <option value="March">March</option>
              <option value="April">April</option>
              <option value="May">May</option>
              <option value="June">June</option>
              <option value="July">July</option>
              <option value="August">August</option>
              <option value="September">September</option>
              <option value="October">October</option>
              <option value="November">November</option>
              <option value="December">December</option>
            </select>
          </div>

          <!-- Select Year -->
          <div class="form-group">
            <label for="selectYear">Select Year</label>
            <select class="form-control" id="selectYear" name="year">
              <option value="" disabled selected>Select a year</option>
              
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
            </select>
          </div>

          <!-- Select File -->
          <div class="form-group">
            <label for="selectFile">Select Excel or CSV File</label>
            <input type="file" class="form-control-file" id="selectFile" name="file" accept=".xlsx, .xls">
          </div>
        </div>
        
        <!-- Submit Button -->
        <div class="card-footer">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </div>
      </div>
      </form>
    </div>
    
    <!-- Data Display Card -->
    <div class="card col-md-8 ">
                  <div class="card-header">
                    <h4>Export Table</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table  class="table table-striped table-hover" id="tableExport" style="width:100%;">
                      <thead>
            <tr>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Month</th>
                <th>Year</th>
                <th>Present Days</th>
                <th>Absent Days</th>
                <th>Pay Days</th>
                <!-- <th>Normal Work Hours</th>
                <th>OT Hours</th>
                <th>Late Coming Days</th>
                <th>Late Coming Hours</th>
                <th>Early Going Days</th>
                <th>Early Going Hours</th> -->
            </tr>
        </thead>
        <tbody>
            <?php
            // Query to fetch all records from the attendance table
            $query = "SELECT * FROM attendance ORDER BY month, year,employee_code";
            $result = $conn->query($query);

            // Check if there are any records
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                 
                    echo "<td>" . $row['employee_code'] . "</td>";
                    echo "<td>" . $row['employee_name'] . "</td>";
                    echo "<td>" . $row['month'] . "</td>";
                    echo "<td>" . $row['year'] . "</td>";
                    echo "<td>" . $row['present_days'] . "</td>";
                    echo "<td>" . $row['absent_days'] . "</td>";
                    echo "<td>" . $row['pay_days'] . "</td>";
                    // echo "<td>" . $row['normal_work_hrs'] . "</td>";
                    // echo "<td>" . $row['ot_hours'] . "</td>";
                    // echo "<td>" . $row['late_coming_days'] . "</td>";
                    // echo "<td>" . $row['late_coming_hours'] . "</td>";
                    // echo "<td>" . $row['early_going_days'] . "</td>";
                    // echo "<td>" . $row['early_going_hours'] . "</td>";
               
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='13' class='text-center'>No records found.</td></tr>";
            }
            ?>
        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
        </div>
    </div>
  </div>
</div>
            </div>
          </section>  
        </div>
        


        <?php include_once('footer.php'); ?>
      </div>
     
      
        
    </div>
      
      
    <!-- General JS Scripts -->
    <script src="assets/js/app.min.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.0/xlsx.full.min.js"></script>

<script>
  function loadExcelData() {
    const fileInput = document.getElementById('selectFile').files[0];
    
    // Check if a file is selected
    if (!fileInput) {
      alert("Please select a file first.");
      return;
    }

    // Check if the file is an Excel or CSV
    const fileExtension = fileInput.name.split('.').pop().toLowerCase();
    if (!['xlsx', 'xls', 'csv'].includes(fileExtension)) {
      alert("Please upload a valid Excel or CSV file.");
      return;
    }

    const reader = new FileReader();

    // File load handler
    reader.onload = (event) => {
      try {
        const data = new Uint8Array(event.target.result);
        const workbook = XLSX.read(data, { type: 'array' });
        const firstSheetName = workbook.SheetNames[0];
        const worksheet = workbook.Sheets[firstSheetName];
        const jsonData = XLSX.utils.sheet_to_json(worksheet);

        // Debugging: Check the parsed data
        console.log("Parsed Data:", jsonData);

        // Clear existing table rows
        document.getElementById('tableBody').innerHTML = '';

        // Populate table with Excel data
        jsonData.forEach(row => {
          const newRow = document.createElement('tr');
          newRow.innerHTML = `
            <td>${row['Employee Code'] || ''}</td>
            <td>${row['Employee Name'] || ''}</td>
            <td>${row['Present Days'] || ''}</td>
            <td>${row['Normal Working Hours'] || ''}</td>
            <td>${row['Absent Days'] || ''}</td>
            <td>${row['PayDays'] || ''}</td>
            <td>${row['OT Hours'] || ''}</td>
            <td>${row['Holiday'] || ''}</td>
          `;
          document.getElementById('tableBody').appendChild(newRow);
        });
      } catch (error) {
        console.error("Error reading file:", error);
        alert("There was an error processing the file. Please check the console for details.");
      }
    };

    // Read file as array buffer
    reader.readAsArrayBuffer(fileInput);
  }
</script>
  </body>
 
</html>