<?php include('partials/menu.php')?>


<div class="main-content">
    <div class="wrapper">
        <h1>Change Password</h1>

        <br><br>  

        <?php

        if(isset($_GET['id']))
        {
            $id=$_GET['id'];

        } 
        
        ?>

        


        


        <form action="" method="POST" >

        <table class="tbl-updatepw">
            <tr>
                <td>Old Password: </td>
                <td><input type="password" name="current_password" placeholder="Old Password"></td>

            </tr>
            <tr>
            <td>New Password: </td>
                <td><input type="password" name="new_password" placeholder="New Password"></td>
            </tr>
            <tr>
            <td>Comfirm Password: </td>
                <td><input type="password" name="confirm_password" placeholder="New Password"></td>
            </tr>

            <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id;?>">
                <input type="submit" name="submit" value="Change Password" class="btn-changepw">

            </td>
             </tr>
      

        
        </table>
    </form>
</div>
</div>

 
<?php

// check whether the submit buttin is clicked on not

if(isset($_POST['submit']))
{
   // echo "Button Clicked";
   // 1. Get all the values form form
   
   $id = $_POST['id'];
   $current_password = md5($_POST['current_password']);
   $new_password = md5($_POST['new_password']);
   $confirm_password = md5($_POST['confirm_password']);


   //2.Check whether the user with current ID and current Pasword Exits or not

   $sql ="SELECT * FROM tbl_admin WHERE id= $id AND password ='$current_password'";
   

   //Execute the Query
   $res = mysqli_query($conn,$sql);

   //Create whether the Query executed successfully or not


   if($res==true)
   {
        //Check whether data is avaliable or not
        $count = mysqli_num_rows($res);

        if($count==1)
        {
            // User Exists and password can be changed
            //echo "User Found";

            // Check whether the new password and confirm match or not
            if($new_password == $confirm_password)
            {
                // update the password
                //echo "Password Match";

                $sql2 = "UPDATE tbl_admin SET 
                password ='$new_password'
                WHERE id=$id
                ";

                // Execute the query
                $res2 = mysqli_query($conn , $sql2);
                

                // check whether executed or not
                if($res2 == true)
                {
                    //Display success messege 
                    // Redirect to Manage Page with success Message 
                $_SEESION['cha nge-pwd'] = " Password Change successfully !";
               //Redirect to the user
                header('location:'.SITEURL.'admin/manage-admin.php');
                    

                }
            }
            else
            {
             // Redirect to Manage Page with Error Manage
            $_SEESION['pwd-not-match'] = "Password Did not match !";
            //Redirect to the user
            header('location:'.SITEURL.'admin/manage-admin.php');
            }

        }else
        {
            //User does not exist set message and rediret
            $_SEESION['user-not-found'] = "user not found!";
            //Redirect to the user
            header('location:'.SITEURL.'admin/manage-admin.php');
        }
}

//3. Check whether the new password match or not
//4. Change password if all above is true

}
?>

<?php include('partials/footer.php');?>