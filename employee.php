<?php include_once('controller/session.php'); ?>
<?php
include('config/connection.php');

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
  body{
    font-family: "Outfit";
  }
</style>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</head>

<body>

<?php

// Submit Employee Data

if(isset($_POST['submit'] ) && $_POST['submit'] == 'Add Employee') {

    // Capture Details
    $employee_name = $_REQUEST['employee_name'] ?? '';
    $employee_code = $_REQUEST['employee_code'] ?? '';
    // $employee_gender = $_REQUEST['employee_gender'] ?? '';
    $employee_salary = $_REQUEST['employee_salary'] ?? '';
    $employee_department = $_REQUEST['employee_department'] ?? '';
    $error = [];
    $date = date("Y-m-d H:i:s");
    
    //validation 
    if(strlen($employee_name) < 3){
        $error['name'] = "Please enter valid name";
      }
      
      if(strlen($employee_code) < 1){
        $error['code'] = "Please enter valid code";
      }
      if(strlen($employee_salary) < 1){
        $error['salary'] = "Please enter valid Salary";
      }

      


    if(sizeof($error) < 1 ){
    // Check for duplicate employee_code
    $check_stmt = $conn->prepare("SELECT 1 FROM employees WHERE employee_code = ?");
    $check_stmt->bind_param("s", $employee_code);
    $check_stmt->execute();
    $check_stmt->store_result();

    if ($check_stmt->num_rows > 0) {
        // Duplicate employee_code found
        echo "<script>alert('Employee is already added.')</script>";
        // $check_stmt->close();
        $check_stmt->close();
    }else {
   

    // Prepare and execute insert query
    $stmt = $conn->prepare("INSERT INTO employees (employee_name, employee_code, employee_salary,employee_department, date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $employee_name, $employee_code, $employee_salary,$employee_department, $date);
    echo  $stmt->execute() ?   "<script>alert('Employee is add successfully.')</script>" :   "<script>alert('Employee is failed to add.')</script>";
    $stmt->close();
    
    }
  }

}else if (isset($_GET['delete']) && !empty($_GET['delete'])) {
  $employee_code = $_GET['delete'];

  // Delete the employee record
  $delete_stmt = $conn->prepare("DELETE FROM employees WHERE employee_code = ?");
  $delete_stmt->bind_param("s", $employee_code);
  if ($delete_stmt->execute()) {
      echo "<script>alert('Employee deleted successfully.')</script>";
  } else {
      echo "<script>alert('Failed to delete employee.')</script>";
  }
  $delete_stmt->close();
} else if (isset($_POST['update']) && $_POST['update'] == 'Update Employee') {
  $employee_name = $_POST['employee_name'] ?? '';
  $employee_code = $_POST['employee_code'] ?? '';
  $employee_department = $_POST['employee_department'] ?? '';
  $employee_salary = $_POST['employee_salary'] ?? '';
  $error = [];

  if (strlen($employee_name) < 3) {
      $error['name'] = "Please enter a valid name";
  }

  if (strlen($employee_code) < 1) {
      $error['code'] = "Please enter a valid code";
  }
  if (strlen($employee_salary) < 1) {
      $error['salary'] = "Please enter valid Salary";
  }

  

  if (sizeof($error) < 1) {
      // Update the employee details
      $update_stmt = $conn->prepare("UPDATE employees SET employee_name = ?, employee_department = ?, employee_salary = ? WHERE employee_code = ?");
      $update_stmt->bind_param("ssss", $employee_name, $employee_department, $employee_salary, $employee_code);
      if ($update_stmt->execute()) {
          echo "<script>alert('Employee updated successfully.')</script>";
      } else {
          echo "<script>alert('Failed to update employee.')</script>";
      }
      $update_stmt->close();
  }
}

// Fetch employee details for update
if (isset($_GET['edit']) && !empty($_GET['edit'])) {
  $employee_code = $_GET['edit'];
  $result = $conn->query("SELECT * FROM employees WHERE employee_code = '$employee_code'");
  $employee = $result->fetch_assoc();
}

?>



  <div class="loader"></div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">
    <div class="navbar-bg"></div>
        <?php include_once('header.php'); ?>
        <?php include_once('nav.php'); ?>

      </div>
      <div class="main-content">
        <section class="section">
          <div class="row">
            <!-- Employee Form Card -->
            <div class="col-6 col-md-6 col-lg-6">
              <div class="card">
                <div class="card-header">
                <h4><?php echo isset($employee) ? 'Edit Employee' : 'Add Employee'; ?></h4>
                </div>
                <div class="card-body">
                  <form action="" method="POST">
               
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Name</label>
                    <div class="col-sm-9">
                      <p style="color: red;"><?php if(isset($error['name'])) { echo $error['name']; } ?></p>
                      <input type="text" class="form-control" name="employee_name" id="inputEmail3" placeholder="Name" value="<?php 
                      echo isset($employee) ? $employee['employee_name'] : '';
                      if(isset($_REQUEST['employee_name'])) { echo $_REQUEST['employee_name']; } ?>" >
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Employee Code</label>
                    <div class="col-sm-9">
                    <p style="color: red;"><?php 
                   
                      if(isset($error['code'])) { echo $error['code']; } ?></p>
                      <input type="number" name="employee_code" class="form-control" id="inputPassword3" placeholder="Enter Employee Code" value="<?php if(isset($_REQUEST['employee_name'])) { echo $_REQUEST['employee_code']; }  echo isset($employee) ? $employee['employee_code'] : ''; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword3" class="col-sm-3 col-form-label">Employee Salary</label>
                    <div class="col-sm-9">
                    <p style="color: red;"><?php
                  
                    if(isset($error['salary'])) { echo $error['salary']; } ?></p>
                      <input type="text" name="employee_salary" class="form-control" id="inputPassword3" placeholder="Enter Employee Salary" value="<?php if(isset($_REQUEST['salary'])) { echo $_REQUEST['salary']; }    echo isset($employee) ? $employee['employee_salary'] : '';?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-3 col-form-label">Department</label>
                    <div class="col-sm-9">
                  
                      <select id="department" name="employee_department" class="form-control" >
                        <option value="">Select an option</option>
                        <option value="studio">Studio</option>
                        <option value="animation">Animation</option>
                        <option value="coloring">Coloring</option>
                        <option value="designer">Designer</option>
                        <option value="Hr">HR</option>
                        <option value="teachers">Teachers</option>
                        <option value="editor">Editor</option>
                        <option value="video editor">Video Editor</option>
                        <option value="it">IT</option>
                        <option value="Operation">Operation</option>
                        <option value="marketing seo">Marketing/SEO</option>
                        <option value="data operator">Data Operator</option>
                        <option value="art sketch">Art and Sketch</option>
                        <option value="pantry">Pantry</option>
                      </select>
                
                    </div>
                  </div>
                  <fieldset class="form-group" style="display:none">
                    <div class="row">
                      <div class="col-form-label col-sm-3 pt-0">Gender</div>
                      <div class="col-sm-9">
                        <div class="form-check">
                        <p style="color: red;"><?php if(isset($error['gender'])) { echo $error['gender']; } ?></p>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="employee_gender" name="employee_gender" value="male" class="" <?php if(isset($_REQUEST['employee_gender']) && $_REQUEST['employee_gender'] == "male") { echo "checked"; } ?>>
                            <label class=""  for="customRadio3">Male</label>
                          </div>
                          <div class="custom-control custom-radio">
                            <input type="radio" id="employee_gender" name="employee_gender" value="female" class="" <?php if(isset($_REQUEST['employee_gender']) && $_REQUEST['employee_gender'] == "female") { echo "checked"; } ?> >
                            <label class="" for="customRadio2">Female</label>
                          </div>
                        </div>
                      </div>
                    </div>
                  </fieldset>
               
                </div>
                <div class="card-footer">
                <label >
             
                </label>
                  <input type="submit" class="btn btn-primary" name="update" value="Update Employee" <?php echo isset($employee) ? '' : 'disabled'; ?>>
                  <input type="submit" class="btn btn-primary" name="submit" value="Add Employee">
                  <input type="reset" style="float:right" class="btn btn-warn" name="reset" value="Reset">
                </div>
                </form>
              </div>
            </div>
      
            <!-- Simple Table Card -->
            <div class="col-12 col-md-12 col-lg-12">
              <div class="card">
                <div class="card-header">
                  <h4>Simple Table</h4>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered table-md">
                      <tr>
                        <th>Employee Code</th>
                        <th>Employee Name</th>
                        <th>Employee Salary</th>
                        <th>Employee Department</th>
                        <th>date</th>
                        <th>Action</th>
                      </tr>
                      <?php

                      $table = "SELECT * FROM employees ORDER BY employee_code";
                      $tableResult = $conn->query($table);
                      $row = mysqli_num_rows($tableResult);
                      if($row > 0 ) {
                         while($data = $tableResult->fetch_assoc()) {

                          ?>
                          <tr>
                            <td> <?php echo $data['employee_code']; ?></td>
                            <td> <?php echo $data['employee_name']; ?></td>
                            <td> <?php echo $data['employee_salary']; ?></td>
                            <td style="text-transform: capitalize;"> <?php echo $data['employee_department']; ?></td>
                            <td> <?php echo $data['date']; ?></td>
                            <td>
                              <a href="?edit=<?php echo $data['employee_code']; ?>" class="btn btn-warning">Edit</a>
                              <a href="?delete=<?php echo $data['employee_code']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete?')">Delete</a>
                            </td>
                          </tr>  
                          <?php

                         }
                      }

                      ?>
                    </table>
                  </div>
                </div>
                <!-- <div class="card-footer text-right">
                  <nav class="d-inline-block">
                    <ul class="pagination mb-0">
                      <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1"><i class="fas fa-chevron-left"></i></a>
                      </li>
                      <li class="page-item active"><a class="page-link" href="#">1 <span class="sr-only">(current)</span></a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a></li>
                    </ul>
                  </nav>
                </div> -->
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