
<?php

include('config/connection.php');
include('utiles/salaryCalculate.php');



function countSundays($monthName, $year) {
    // Convert month name to month number (1 = January, 2 = February, ..., 12 = December)
    $month = date('m', strtotime($monthName));

    // Get the total number of days in the month
    $totalDays = cal_days_in_month(CAL_GREGORIAN, $month, $year);

    // Initialize a counter for Sundays
    $sundayCount = 0;

    // Loop through all the days in the month
    for ($day = 1; $day <= $totalDays; $day++) {
        // Check if the current day is a Sunday
        $date = strtotime("$year-$month-$day");
        if (date('w', $date) == 0) { // 'w' returns 0 for Sunday
            $sundayCount++;
        }
    }

    return $sundayCount;
}

// Example usage:


?><!DOCTYPE html>
<html lang="en">
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
  <head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Anideaz Attendance management system</title>
    <!-- General CSS Files -->
    <link rel="stylesheet" href="assets/css/app.min.css">
    <!-- Template CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/components.css">
    <!-- Custom style CSS -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel='shortcut icon' type='image/x-icon' href='assets/img/favicon.png' />
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
            <div class="">
              <!-- Selection Form Card --    
              <!-- Data Display Card -->
              <div class="card col-md-12 " >
                      <div class="card-header">
                    <h4>Export Table 
                   
                    </h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table  class="table table-striped table-hover" id="tableExport" style="width:100%;">
                      <thead>
            <tr>
                <th>Employee Code</th>
                <th>Employee Name</th>
                <th>Present</th>
                <th>Absent</th>
                <td>Actual Salary</td>
                <td>OT hours</td>
                <td>OT Salary</td>
                <td>Salary Without OT</td>
                <td>Final ( OT + Salary )</td>
                <td>All Sunday Cancel</td>
              
                
            </tr>
        </thead>
        <tbody>
            <?php

            if(isset($_POST['month'])   && isset($_POST['year'])) {
              $sMonth  = $_POST['month'];
              $sYear = $_POST['year'];
              $query = "SELECT a.month,a.normal_work_hrs, a.year, a.ot_hours,a.employee_code,a.employee_name,a.pay_days,a.absent_days,e.employee_salary,a.ot_hours,a.weekly_off_present,a.holidays FROM attendance a JOIN employees e WHERE a.month='$sMonth' AND a.year='$sYear' AND a.employee_code = e.employee_code ORDER BY a.employee_name";
              $result = $conn->query($query);
  
              // Check if there are any records
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {

                    try {
                      $absent_days = $row['absent_days'] ; 
                      $totalMonthDays = $row['pay_days'] +  $absent_days ;
                      $totalSunday = countSundays($row['month'], $row['year']);
                    
                      //Call construct
                      $salaryCalculator = new SalaryCalculator($row['employee_salary']
                      ,$totalMonthDays
                      , $totalSunday, 
                      $row['holidays'],
                      $row['normal_work_hrs'],
                       2,
                       $row['ot_hours'],
                       0,
                       $row['weekly_off_present']);
                       
                       if($absent_days > 4 ) {
                         echo "<tr style=' background-color: #F8CFCF;border-bottom:1px solid grey;'>";
                       }else {
                         echo "<tr style=' border-bottom:1px solid grey;'>";
                       }
      
                       echo "<td>" . $row['employee_code'] . "</td>";
                       echo "<td>" . $row['employee_name'] . "</td>";
                       echo "<td>" . $row['pay_days'] . " Days </td>";
                       echo "<td>" .  $absent_days  . " Days </td>";
                       echo "<td > ₹ " . $row['employee_salary'] . "</td>";
                       echo "<td>" . $row['ot_hours'] . " hr </td>";
                       echo "<td > ₹ ". round($salaryCalculator->calculateOT())."</td>";
                       echo "<td > ₹ ". round($salaryCalculator->calculateTotalSalary())."</td>";
                       echo "<td style='color:green'> ₹ ". round($salaryCalculator->calculateTotalSalaryWithOT())."</td>";

                       if($absent_days > 4 ) {
                         echo "<td style='color:red'> ₹ ". round($salaryCalculator->cancelSunday())."</td>";
                       }else {
                          echo "<td style='color:green'> ₹ ". round($salaryCalculator->calculateTotalSalary())."</td>";
                       }
                      
          
                  } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                    // echo "<tr><td colspan='13' class='text-center'>No records found.</td></tr>";
                  }
                  
                
                         
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='13' class='text-center'>No records found.</td></tr>";
              }
              
            }else {
              echo "<tr><td colspan='13' class='text-center'>No records found.</td></tr>";
            }
            // Query to fetch all records from the attendance table
        
            ?>
        </tbody>
                      </table>
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
  </body>
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>