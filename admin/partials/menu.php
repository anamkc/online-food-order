<?php 

    include('../config/constants.php'); 
    include('login-check.php');


?>


<html>
    <head>
        <title>Online Food Order</title>
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
    </head>
    
    <body>
        <!-- Menu Section Starts -->
        <div class="menu text-center" id="admin1">
        <div class="logo6">
            Foodly
         </div>
         <input type="checkbox" id="check">

         <label for="check" class="menu-btn1">
         <i class="fas fa-bars"></i>
         </label>
            <div class="wrapper1">
                <ul>
                    <li><a class="activ" href="index.php">Dashboard</a></li>
                    <li><a href="manage-category.php">Category</a></li>
                    <li><a href="manage-food.php">Food Items</a></li>
                    <li><a href="manage-order.php">Order Section</a></li>
                    <li><a href="manage-admin.php">Manage Admin</a></li>
                    <li><a href="manage-user.php">Manage Users</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>
        </div>
        <!-- Menu Section Ends -->
        