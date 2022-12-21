<?php

// include constant.php file here

include('../config/constants.php');

// 1.Get the id of Admin to delete

$id = $_GET['id'];


// 2.Create SQL Query to delete Admin

$sql = "DELETE  FROM tbl_admin WHERE id=$id";

//Execute the Query

$res = mysqli_query( $conn,$sql);

//check whether query executed succesfully or not.

if($res == true){

    //Query Executed succesfully and Admin 
    //echo "Admin Deleted successfully";
    //Create Session variable to Dispaly Message

    $_SESSION['delete'] = "<div class='success'> Admin Deleted Successfuly.</div>";
    //Rederiect to Mannage Admin Page
    header('location:'.SITEURL.'admin/manage-admin.php');


}
else
{
    // Failed delete admin
    //echo "Failed to deleted Admin";
    

    $_SESSION['delete'] = "Failed Deleted Admin. Try Again Later";
    header('location:'.SITEURL.'manage-admin.php');
   

}


// 3.Rederect to manage-admin page with message(success or error)

?>