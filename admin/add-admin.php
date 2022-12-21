<?php include('partials/menu.php')?>
      
<!-- Mian content section start -->
  
<div class="main-content">
    <div class="wrapper">

        <h1>Add Admin</h1>

        <br><br>

        <form action="" method="POST">

            <table class="tbl-addAdmin">

            <tr>
 
            <td>Full Name:</td>
            <td><input type="text" name ="full_name" placeholder="Enter your Name"></td>
            </tr>
            <tr>
                <td>Username:</td>
                <td>
                    <input type="text" name="username" placeholder="your username">
                </td>
            </tr>

            <tr>
                <td>Password:</td>
                <td>
                    <input type="text" name="password" placeholder="your password">
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="submit" value="Add Admin" class="btn-update">

                </td>


            </tr>
            </table>

        </form>
    </div>  
</div>    


<?php include 'partials/footer.php'?>


<?php
//Process the value from form and save it in database

//Check whether the submit button is clicked or not

if(isset($_POST['submit']))
{
    //Button Clicked
    //echo "Button clicked";

    // 1. Get the Data from form

    $full_name = $_POST['full_name'];
    $username = $_POST['username'];
    $password = $_POST['password']; // Password encripted with md5 

    //2. SQL quary to save the data into database
   
        
    $sql ="INSERT INTO tbl_admin SET
    full_name ='$full_name',
    username='$username',
    password='$password'
"; 
    

    //3. Execute Query and save Data a Database


    $res = mysqli_query($conn, $sql) or die(mysqli_error());


    //4.Check wether the (query is executed) data is inserted or not and display appropriate message

    if($res == TRUE)
    {
        //Data inseted
        //echo "Data inserted";
        //Create a Session variable to diaplay Message
        $_SESSION['add'] = "<div class='success'> Admin Added Successfully! </div>";
        // Redirect Page to manage admin
        header("location:".SITEURL.'admin/manage-admin.php');
        
    }
    else
    {

        // Failed to insert data
        //echo"Failed data inserted";
        //Create a Session variable to diaplay Message
        $_SESSION['add'] = "Failed to add Admin";
        // Redirect Page to manage admin
        header("location:".SITEURL.'admin/add-admin.php');
    }


}

?>
