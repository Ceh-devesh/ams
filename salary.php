
<?php

include('config/connection.php');
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
    <!-- Selection Form Card -->
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4>Select Options</h4>
        </div>
        <form action="" method="POST"  enctype="multipart/form-data">
        <div class="card-body">
          <!-- Select Month -->
          <div class="form-group" style="width:30%;float:left">
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
          <div class="form-group"  style="margin-left:20px;width:30%;float:left">
            <label for="selectYear">Select Year</label>
            <select class="form-control" id="selectYear" name="year">
              <option value="" disabled selected>Select a year</option>
              <option value="2024">2024</option>
              <option value="2025">2025</option>
              <option value="2026">2026</option>
            </select>
          </div>

          <!-- Select File -->
        </div>
        
        <!-- Submit Button -->
        <div class="card-footer"  style="margin-left:20px;float:left">
          <input type="submit" class="btn btn-primary" name="submit" value="Submit">
        </div>

      </div>
      </form>
    </div>
    
    <!-- Data Display Card -->
    <div class="card col-md-12 " >
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
                <th>Present Days</th>
                <th>Absent Days</th>
                <th>Pay Days</th>
                <th>Normal Work Hours</th>
                <th>OT Hours</th>
                <th>Late Coming Days</th>
                <th>Late Coming Hours</th>
                <th>Early Going Days</th>
                <th>Early Going Hours</th>
                <th>Late more than 4 days</th>
                <th>All Sunday Cancel</th>
              
                
            </tr>
        </thead>
        <tbody>
            <?php

            if(isset($_POST['month'])   && isset($_POST['year'])) {
              $sMonth  = $_POST['month'];
              $sYear = $_POST['year'];
              $query = "SELECT * FROM attendance WHERE month='$sMonth' AND year='$sYear' ORDER BY employee_name";
              $result = $conn->query($query);
  
              // Check if there are any records
              if ($result->num_rows > 0) {
                  while ($row = $result->fetch_assoc()) {
                    if($row['absent_days'] > 4 ) {
                      echo "<tr style=' background-color: #F8CFCF;border-bottom:1px solid grey;'>";
                    }else {
                      echo "<tr style=' border-bottom:1px solid grey;'>";
                    }
                      echo "<td>" . $row['employee_code'] . "</td>";
                      echo "<td>" . $row['employee_name'] . "</td>";
                      echo "<td>" . $row['present_days'] . "</td>";
                      echo "<td>" . $row['absent_days'] . "</td>";
                      echo "<td>" . $row['pay_days'] . "</td>";
                      echo "<td>" . $row['normal_work_hrs'] . "</td>";
                      echo "<td>" . $row['ot_hours'] . "</td>";
                      echo "<td>" . $row['late_coming_days'] . "</td>";
                      echo "<td>" . $row['late_coming_hours'] . "</td>";
                      echo "<td>" . $row['early_going_days'] . "</td>";
                      echo "<td>" . $row['early_going_hours'] . "</td>";
                      echo "<td><input type='checkbox' name='late' value='" . $row['employee_code'] . "'></td>";
                      echo "<td><input type='checkbox' name='sunday' value='" . $row['employee_code'] . "'></td>";
                 
                      echo "</tr>";
                  }
              } else {
                  echo "<tr><td colspan='13' class='text-center'>No records found.</td></tr>";
              }

              ?>

                    <form action="salary_generate2.php" method="POST" >
                         <input type="hidden" name="month" value="<?php echo  $sMonth ?>">
                         <input type="hidden" name="year"  value="<?php echo  $sYear ?>">
                         <input type="submit" class="btn btn-primary" name="submit" value="Salary Generate" style="font-size:23px;padding:5px;float:right;margin:15px;">
                    </form> 
                    
<?php
              
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