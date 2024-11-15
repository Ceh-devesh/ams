<?php
session_start();

if(empty($_SESSION['user_id'])) {
    header("Location: login.php");  // Redirect to the dashboard
    exit();
   
}else {
   
}