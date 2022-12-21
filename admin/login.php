<?php include('../config/constants.php')?>


<html>
    <head>
        <title>Login - food Order system</title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>


<body>
    <div class="login">
        <h2 class="text-center">Login</h2>
        <br>

        <?php
        if(isset($_SESSION['login'])){
            
            echo $_SESSION['login'];
            unset ($_SESSION['login']);
        }

        if(isset($_SESSION['no-login-message']))
        {
            echo $_SESSION['no-login-message'];  
            unset($_SESSION['no-login-message']);  

        }


        ?>
        <br><br>

        <!-- Login form start here -->
        <form action="" method="POST" >
            <br>
            Username : 
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            Password : 
            <input type="text" name="password" placeholder="Enter Password"> <br><br>
            &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            <input type="submit" name="submit" value="Login" class="btn-login" >
            <br><br>
        </form>
        <p class="text-center">Created By - <a href="www.google.com"> Kanchana Madhuranga</a></p>
    </div>
</body>
</html>

<?php
 // check whether submit button clicked or not
 if(isset($_POST['submit']))
 {
    // Precess for login 
    //1.Get the Data form Login form

     $username = $_POST['username'];
     $password =$_POST['password'];

     //2. sql to check whether the  user and passwod exists or not

     $sql = "SELECT *FROM tbl_admin WHERE username='$username' AND password ='$password'";

     //3.execute the query
     $res = mysqli_query($conn, $sql);

     //4. count rows to check whether the uesr exists or not 
     $count=mysqli_num_rows($res);

     if($count==1)
     {
        //user Avaliable and login success
        $_SESSION['login'] = "Login Successfull";
        $_SESSION['user'] = $username; // To check whether the user is logged in or not and loogout will unset it.



        //Rederect to homepage / dashboard
        header('location:'.SITEURL.'admin/index.php');

     }
     else
     {
        //User not avaliable and login fail
        $_SESSION['login'] = "<div class='text-center'> Username or Password did not match.</div>";
        //Rederect to homepage / dashboard
        header('location:'.SITEURL.'admin/login.php');
    
    }



 }
?>

