<?php include_once('controller/session.php'); ?>
<?php

use Shuchkin\SimpleXLSX;

ini_set('error_reporting', E_ALL);
ini_set('display_errors', true);
require_once __DIR__.'/src/SimpleXLSX.php';
echo '<h1>System</h1>';

if (isset($_FILES['file'])) {
 
    if ($xlsx = SimpleXLSX::parse($_FILES['file']['tmp_name'])) {

        echo '<h2>Parsing Result</h2>';
        echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';
        echo "<tr>
         <td>Employee Code </td>0
         <td>Employee Name </td>1
         <td>Present Days </td>2
         <td>Absent Days </td>3
         <td>Pay Days </td>4
         <td>Normal Work </td>5
         <td>OT Hrs </td>6
         <td>Holiday </td>20
         <td>Actual Salary</td>
         <td>OT Salary</td>
         <td>Cal Salary </td>
         <td>OT + Salary</td>
         </tr>";
         
        // $dim = $xlsx->dimension();
        // $cols = $dim[0];

        // print_r($xlsx->readRows());
        foreach ($xlsx->readRows() as $k => $r) {
            
            $extra_days = 0;
            if ($k == 0) continue; // skip first row
           
            echo '<tr>';
            echo "<td>". $r[0]."</td>"; // 
            echo "<td>". $r[1]."</td>";
            echo "<td>". $r[2]."</td>";
            echo "<td>". $r[3]."</td>";
            echo "<td>". $r[4]."</td>";
            echo "<td>". $r[5]."</td>";
            echo "<td>". $r[6]."</td>";
            echo "<td>". $r[20]."</td>";
            echo "<td>". $r[22]."</td>";
            
            if($r[3] != "0") { $extra_days = 1 ; }
           
            $totalMonthDays = $r[4] + $r[3]; 
            $perDayPay = $r[22] / ($totalMonthDays );
            $salary = ($perDayPay) * ( $r[4] + $extra_days );
            $perHoursPay = $perDayPay / 9;
            $totalOT = 0;

            if($r[6] > 0.3 ) {  $totalOT = $perHoursPay * $r[6]; }

            echo "<td>". round($totalOT)."</td>";
            echo "<td>". round($salary)."</td>";
            echo "<td>". round($salary + $totalOT)."</td>";
            echo '</tr>';
            
            // echo '<tr>';
            // for ($i = 0; $i < $cols; $i ++) {
            //     // echo '<td>' . ( isset($r[ $i ]) ? $r[ $i ] : '&nbsp;' ) . '</td>';
            //     echo "<p>". ( isset($r[ $i ]) ? $r[ $i ] : '&nbsp;' )."</p>";
            // }
            // echo '</tr>';
                        
        }
        echo '</table>';

    } else {

        echo SimpleXLSX::parseError();

    }
}

echo '<h2>Upload form</h2>
<form method="post" enctype="multipart/form-data">
*.XLSX <input type="file" name="file"  />&nbsp;&nbsp;<input type="submit" value="Parse" />
</form>';
