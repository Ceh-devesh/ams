<?php include_once('controller/session.php'); ?>
<?php
// Database connection details

 include('config/connection.php');

 // Assuming the PDO connection is already established and stored in $pdo
 
 try {
 
     $query = "
         SELECT 
             employee_department,
             SUM(employee_salary) AS department_total_salary,
             (SUM(employee_salary) / total_salary) * 100 AS salary_expenditure_ratio
         FROM 
             employees,
             (SELECT SUM(employee_salary) AS total_salary FROM employees) AS total

             

         GROUP BY 
             employee_department
    
     ";
 
     // Execute the query
     $stmt = $conn->query($query);
 
     // Fetch all the results into an associative array

 
     // Initialize an array to store department data
     $departments = [];
     $total_salary = 0;  // To store the overall total salary (if needed separately)
 
     // Loop through the results and store them in the $departments array
    while($row = $stmt->fetch_assoc()) {
         // Store each department's data in an associative array
         $departments[] = [
             'department' => $row['employee_department'],
             'total_salary' => $row['department_total_salary'],
             'salary_expenditure_ratio' => $row['salary_expenditure_ratio']
         ];
 
         // Also calculate the total salary if needed
         if ($row['employee_department'] == 'Total') {
             $total_salary = $row['department_total_salary']; // Store total salary if necessary
         }
     }
 
    
 
 } catch (PDOException $e) {
     // If an error occurs, display the error message
     echo "Error: " . $e->getMessage();
 }
 ?>
 

<!DOCTYPE html>
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
      body, *{
      font-family: "Outfit";
      }
    </style>
    <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
      title:{
        text: "Total Monthly Expenditure"
      },
      data: [
      {
       type: "doughnut",
       dataPoints: [
        <?php
     
            foreach ($departments as $row) {
               
                echo ' { y:'.number_format($row['salary_expenditure_ratio'], 2).', 
                indexLabel: "'.strtoupper($row['department']).' | ₹ '.$row['total_salary'].' | '.number_format($row['salary_expenditure_ratio']).'% " } ,';
        


            }    
        ?>
    //    {  y: 53.37, indexLabel: "Android" },
    //    {  y: 35.0, indexLabel: "Apple iOS" },
    //    {  y: 7, indexLabel: "Blackberry" },
    //    {  y: 2, indexLabel: "Windows Phone" },
    //    {  y: 5, indexLabel: "Others" }
       ]
     }
     ]
   });

    chart.render();
  }
  </script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
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

            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
                <div class="card">
                  <div class="card-header">
                    <!-- <h4>Salary Expenditure/h4> -->
                  </div>
                  <div class="card-body">
                  <div id="chartContainer" style="height: 600px; width: 100%;margin:20px;">
                  </div>
                  </div>

                  <div class=""card-body>
<!-- <?php
//  echo "<table border='1'>";
//  echo "<thead><tr><th>Department</th><th>Total Salary</th><th>Salary Expenditure Ratio (%)</th></tr></thead>";
//  echo "<tbody>";

//  foreach ($departments as $row) {
//      echo "<tr>";
//      echo "<td>" . htmlspecialchars($row['department']) . "</td>";
//      echo "<td>" . number_format($row['total_salary'], 2) . "</td>";
//      echo "<td>" . number_format($row['salary_expenditure_ratio'], 2) . "%</td>";
//      echo "</tr>";
//  }

//  echo "</tbody></table>";
?> -->
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
    <script src="assets/bundles/amcharts4/core.js"></script>
  <script src="assets/bundles/amcharts4/charts.js"></script>
    <!-- JS Libraies -->
    <!-- Page Specific JS File -->
    <!-- Template JS File -->
    <script src="assets/js/scripts.js"></script>

    <script src="assets/js/page/chart-amchart.js" ></script>
    <!-- Custom JS File -->
    <script src="assets/js/custom.js"></script>
  </body>
  <!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>