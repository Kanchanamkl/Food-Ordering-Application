<?php
//echo "Delete Page";

// include constant.php file here

include('../config/constants.php');

if(isset($_GET['id']) AND isset($_GET['image_name']))
{
    // Get the value and Delete
    //echo "Get Value and Delete";
     $id = $_GET['id'];
     $image_name = $_GET['image_name'];

    //   echo $id;
    
    //   echo $image_name;
    //   die();
    

     //remove image from image file
     if($image_name != "")
    {
        //if Image is available remove it
        $path ="../images/category/".$image_name;
        $remove= unlink($path);

       

        if($remove==false)
        {
            //set the session message
            $_SESSION['remove']="Failed to remove category";
            //redirect to manage admin page
            header('location:'.SITEURL.'admin/manage-category.php');
            //Stop the process
            die();

        }


    }
    // Delete data from database

    // SQL Query to Delete Data form Database
    $sql="DELETE FROM tbl_category WHERE id=$id";
    //Execute the Query

    $res = mysqli_query( $conn,$sql);

    // check whether the data is delete from databse or not
    if($res == true)
    {
        //set success message and redirect 
        $_SESSION['delete']="Category Deleted Successfully";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }
    else
    {
        //set success message and redirect 
        $_SESSION['delete']="Failed to delete category";
        //Redirect to Manage Category
        header('location:'.SITEURL.'admin/manage-category.php');
    }

    //Redirect to manage category page with message

}else
{
    //redirect to Manage CAtegory page
    header('locatoin:'.SITEURL.'admin/manage-category.php');
}
?>