<?php include('./config/constants.php'); ?>

<html>
    <head>
        <title>Login - Food Order System</title>
        <link rel="stylesheet" href="./css/admin.css">
        <style>
body {
    background: url(./images/sushi.jpg) no-repeat fixed center;
    background-size: cover;
}
</style>
    </head>

    <body>
    <div class="login" id="log">
            <h1 class="text-center" id="head">User Registration</h1>
            <br><br>
<form action="" method="POST" class="text-center" id="form">
<p id="formtxt"> Full Name: </P><br>
            <input type="text" name="full_name" placeholder="Enter Full Name" id="box5"><br><br>
           <p id="formtxt"> Username: </P><br>
            <input type="text" name="username" placeholder="Enter Username" id="box5"><br><br>

           <p id="formtxt"> Password: </P><br>
            <input type="password" name="password" placeholder="Enter Password"id="box5" ><br><br>

            <p id="formtxt"> Phone Number: </P><br>
            <input type="number" name="phone_number" placeholder="Enter Phone Number"id="box5" ><br><br>

            <input type="submit" name="submit" value="Sign Up" class="btn-primary" id="btn6">
            <br><br>
            <p>Already have an account? <a href="/onlinefood-order/index.php">Log In.</a></p>
</form>
</div>
</body>
</html>
<?php 
    //Process the Value from Form and Save it in Database

    //Check whether the submit button is clicked or not

    if(isset($_POST['submit']))
    {
        // Button Clicked
        //echo "Button Clicked";

        //1. Get the Data from form
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];
        $password = md5($_POST['password']); //Password Encryption with MD5
        $phone_number = $_POST['phone_number']; //Password Encryption with MD5
        if(preg_match('/^[0-9]{10}+$/', $phone_number)) {
            //2. SQL Query to Save the data into database
        $sql = "INSERT INTO tbl_user SET 
        full_name='$full_name',
        username='$username',
        password='$password',
        phone_number='$phone_number'
    ";

    //3. Executing Query and Saving Data into Datbase
    $res = mysqli_query($conn, $sql) or die(mysqli_error());

    //4. Check whether the (Query is Executed) data is inserted or not and display appropriate message
    if($res==TRUE)
    {
        //Data Inserted
        //echo "Data Inserted";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='success'>User Registration Successful.</div>";
        //Redirect Page to Manage Admin
        header("location:".SITEURL.'index.php');
    }
    else
    {
        //FAiled to Insert DAta
        //echo "Faile to Insert Data";
        //Create a Session Variable to Display Message
        $_SESSION['add'] = "<div class='error'>Failed to Create User.</div>";
        //Redirect Page to Add Admin
        header("location:".SITEURL.'register.php');
    }

        } else {
            $_SESSION['add'] = "<div class='error'>Phone Number Invalid.</div>";
            header("location:".SITEURL.'register.php');

        }
        
    }
    
?>