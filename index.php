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
            <h1 class="text-center" id="head">User Login</h1>
            <br><br>

            <?php 
                if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }

                if(isset($_SESSION['no-login-message']))
                {
                    echo $_SESSION['no-login-message'];
                    unset($_SESSION['no-login-message']);
                }
            ?>
        

            <!-- Login Form Starts HEre -->
            <form action="" method="POST" class="text-center" id="form">
           <p id="formtxt"> Username: </P><br>
            <input type="text" name="username" placeholder="Enter Username" id="box5"><br><br>

           <p id="formtxt"> Password: </P><br>
            <input type="password" name="password" placeholder="Enter Password"id="box5" ><br><br>

            <input type="submit" name="submit" value="Login" class="btn-primary" id="btn6">
            <br><br>
            <p>Don't have an account? <a href="/onlinefood-order/register.php">Create an Account.</a></p>
            </form>
            <!-- Login Form Ends HEre -->

            
        </div>

    </body>
</html>

<?php 

    //CHeck whether the Submit Button is Clicked or NOt
    if(isset($_POST['submit']))
    {
        //Process for Login
        //1. Get the Data from Login form
        $username = $_POST['username'];
        $password = md5($_POST['password']);

        //2. SQL to check whether the user with username and password exists or not
        $sql = "SELECT * FROM tbl_user WHERE username='$username' AND password='$password'";

        //3. Execute the Query
        $res = mysqli_query($conn, $sql);

        //4. COunt rows to check whether the user exists or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            //User AVailable and Login Success
            $_SESSION['login'] = "<div class='success'>Login Successful.</div>";
            $_SESSION['user'] = $username; //TO check whether the user is logged in or not and logout will unset it

            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'home.php');
        }
        else
        {
            //User not Available and Login FAil
            $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";
            //REdirect to HOme Page/Dashboard
            header('location:'.SITEURL.'./index.php');
        }


    }

?>