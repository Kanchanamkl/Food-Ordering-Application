<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Admin</h1>

        <br><br>

        <?php
        //1.Get the Id of Selected Admin

        $id=$_GET['id'];

        //2.Create SQL Query to Get the Details
        $sql= "SELECT * FROM tbl_admin WHERE id=$id";

        //Execute the Query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not
        if($res==true){

            //Check whether the data is Avaliable or no
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count == 1)
            {
                //Get the details
                //echo "Admin Available";
                $row =mysqli_fetch_assoc($res);

                $full_name= $row['full_name'];
                $username =$row['username'];



                        }
            else
            {
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-admin.php');

            }


        }

        
        
        ?>

        <form action="" method="POST">

       <br>

            <table class="tbl-addAdmin">

           <tr>
           <td>
            Full Name : 
           </td>
            <td>
            <input type="text" name="full_name" value="<?php echo $full_name; ?>"  >
            </td>
            </tr>
             <tr>
            <td>
            Username :  
            </td>
            <td>
            <input type="text" name = "username" value="<?php echo $username; ?>"  >
            </td>

             <tr>
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="submit" name="submit" value="Update Admin" class="btn-update">

            </td>
        </tr>
      </tr>


      </table>
    
    
       <br>
     </form>
    </div>
</div>


<?php
if(isset($_POST['submit']))
{
   // echo "Button Clicked";
   // Get all the value form form
   $id = $_POST['id'];
   $full_name = $_POST['full_name'];
   $username = $_POST['username'];

   //Create a SQL Query to Update Admin

   $sql="UPDATE tbl_admin SET 
   full_name ='$full_name',
   username ='$username' 
   WHERE id='$id'
   ";

   //Execute the Query
   $res = mysqli_query($conn,$sql);

   //Create whether the Query executed successfully or not

   if($res==true){

    //Query Executed and Admin Updated
    $_SESSION['update'] = "Admin updated successfully.";
    //Rederect to Mange Admin Page
    header('location:'.SITEURL.'admin/manage-admin.php');

   }else
   {

    //Failed to update Admin
    $_SESSION['update'] = "<div class='error'> Failed to Delete Admin . <div/>";
    //Rederect to Mange Admin Page  
    header('location:'.SITEURL.'admin/manage-admin.php');

   }

}

?>

<?php include('partials/footer.php');?>