<?php

class SalaryCalculator
{
    // Properties
    private $salary;
    private $monthDay;
    private $totalSunday;
    private $totalHoliday;
    private $employeeWorkingHours;
    private $lateComingRelieve;
    private $totalOTHours;
    private $totalLeave;

    private $workOnWeekend;
    private $extraPaidHours = 9;
    private $totalHolday ;

    // Constructor
    public function __construct($salary, $monthDay, $totalSunday, $totalHoliday, $employeeWorkingHours, $lateComingRelieve,$totalOTHours,$totalLeave,$workOnWeekend)
    {
        $this->setSalary($salary);
        $this->setMonthDay($monthDay);
        $this->setTotalSunday($totalSunday);
        $this->setTotalHoliday($totalHoliday);
        $this->setEmployeeWorkingHours($employeeWorkingHours);
        $this->setLateComingRelieve($lateComingRelieve);
        $this->setTotalOTHours($totalOTHours);
        $this->totalLeave = $totalLeave;
        $this->workOnWeekend = $workOnWeekend;
    }

    // Getters
    public function getSalary() { return $this->salary; }
    public function getMonthDay() { return $this->monthDay; }
    public function getTotalSunday() { return $this->totalSunday; }
    public function getTotalHoliday() { return $this->totalHoliday; }
    public function getEmployeeWorkingHours() { return $this->employeeWorkingHours; }
    public function getLateComingRelieve() { return $this->lateComingRelieve; }
    public function getTotalOTHours(){  return $this->totalOTHours; }
    

    // Setters with validation
    public function setSalary($salary) {
        if (filter_var($salary, FILTER_VALIDATE_FLOAT) === false) {
            throw new Exception("Invalid salary: must be a number.");
        }
        $this->salary = $salary;
    }

    public function setMonthDay($monthDay) {
        if (filter_var($monthDay, FILTER_VALIDATE_INT) === false || $monthDay <= 0) {
            throw new Exception("Invalid month days: must be a positive integer.");
        }
        $this->monthDay = $monthDay;
    }

    public function setTotalSunday($totalSunday) {
        if (filter_var($totalSunday, FILTER_VALIDATE_INT) === false || $totalSunday < 0) {
            throw new Exception("Invalid total Sunday: must be a non-negative integer.");
        }
        $this->totalSunday = $totalSunday;
    }

    public function setTotalHoliday($totalHoliday) {
        if ($totalHoliday < 0) {
            throw new Exception("Invalid total holiday: must be a non-negative integer.");
        }
        $this->totalHoliday = $totalHoliday;
    }

    public function setEmployeeWorkingHours($employeeWorkingHours) {

        if ($employeeWorkingHours < 0) {
            throw new Exception("Invalid employee working hours: must be a non-negative integer.");
        }
        $this->employeeWorkingHours = $employeeWorkingHours  + ($this->workOnWeekend * $this->extraPaidHours);

       
    }

    public function setLateComingRelieve($lateComingRelieve) {
        if (filter_var($lateComingRelieve, FILTER_VALIDATE_FLOAT) === false || $lateComingRelieve < 0) {
            throw new Exception("Invalid late coming relieve: must be a non-negative number.");
        }
        $this->lateComingRelieve = $lateComingRelieve;
    }

    public function setTotalOTHours($totalOTHours) {
        if (filter_var($totalOTHours, FILTER_VALIDATE_FLOAT) === false || $totalOTHours < 0) {
            throw new Exception("Invalid late coming relieve: must be a non-negative number.");
        }
        $this->totalOTHours = $totalOTHours;


    }

    // Calculate total working hours
    public function calculateTotalWorkingHours() {
        $totalWorkingDays = ( $this->monthDay - ($this->totalSunday + $this->totalHoliday) )  ;  
        return (($totalWorkingDays * 9 )- $this->extraPaidHours);
    }

    // Calculate salary per hour
    public function calculateSalaryPerHour() {
        $totalWorkingHours = $this->calculateTotalWorkingHours();
        if ($totalWorkingHours <= 0) {
            throw new Exception("Total working hours must be greater than zero.");
        }
        $salaryPerHour = $this->salary / $totalWorkingHours;
        // return ($salaryPerHour - $this->lateComingRelieve);
        return $salaryPerHour;
        // return $totalWorkingHours;
    }

    // Calculate total salary
    public function calculateTotalSalary() {
        $salaryPerHour = $this->calculateSalaryPerHour();
        return $salaryPerHour * $this->employeeWorkingHours ;
    }

    public function calculateOT() {
        if($this->totalOTHours > 0.3 ){
        return $this->totalOTHours * $this->calculateSalaryPerHour(); 
        }else {
            return 0;
        }
    }

    public function calculateTotalSalaryWithOT() {
        
        return $this->calculateOT() + $this->calculateTotalSalary();
    }

    public function cancelSunday() {
        $salaryOT = $this->calculateTotalSalaryWithOT();
        $salaryCut =  ( ($this->totalHolday + $this->totalSunday) * 9 ) * $this->calculateSalaryPerHour();

        return $salaryOT - $salaryCut;

    }
}

// Example usage
// try {
//     $salaryCalculator = new SalaryCalculator(80000.0, 31, 4, 3,183.51, 2,4.54,2,0);

//     echo "Total working Hours ".$salaryCalculator->calculateTotalWorkingHours();
//     echo "<br>Total Salary Per Hours ".$salaryCalculator->calculateSalaryPerHour();
//     echo "<br>Total Salary: ₹" . number_format($salaryCalculator->calculateTotalSalary(), 2);
//     echo "<br>Total Salary + OT : ₹" . number_format($salaryCalculator->calculateTotalSalaryWithOT(), 2);
//     echo "<br>Total after cut: ₹" . number_format($salaryCalculator->cancelSunday(), 2);

// } catch (Exception $e) {
//     echo "Error: " . $e->getMessage();
// }


