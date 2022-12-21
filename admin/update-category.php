<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">
        <h1>Update Category</h1>

        <br><br>


        <?php

        // check whether the id is set or not
        if(isset($_GET['id']))
        {
            // Get the id and all other details
            //echo "Getting the data";
            $id = $_GET['id'];

            // Create the SQL Query to get all other details
            $sql=  "SELECT * FROM tbl_category WHERE id=$id";

            // Execite the query
            $res = mysqli_query($conn, $sql);

            // count the rows check whether the id is valid or not
            $count = mysqli_num_rows($res);

            if($count==1)
            {
                //Get all the data
                $row = mysqli_fetch_assoc($res);
                $title=$row['title'];
                $current_image=$row['image_name'];
                $featured =$row['featured'];
                $active=$row['active'];

            }else
            {
                //redirect to manage category with session message
                $_SESSION['no-category-found']="Category not Found";
                header('location:'.SITEURL.'admin/manage-category.php');

            }

        
        }
        else
        {
            //redirect to manage category
            header('location'.SITEURL.'admin/manage-category.php');
        }
        ?>



         <!-- Add CAtegory form start -->
         <form action="" method="POST" enctype="multipart/form-data">
            <table class ="tbl-addAdmin">
                   <tr>
                    <td>Title:</td> 
                    <td>
                        <input type="text" name="title" value="<?php echo $title ;?>">
                    </td>
                   </tr>
                   <tr>
                   <td>
                       Current Image:</td>
                   <td>
                    <?php 
                    if($current_image != "")
                    {
                        // Display the image
                        ?>
                        <img src="<?php echo SITEURL;?>images/category/<?php echo $current_image ?>"  width="100px">
                        <?php
                    }
                    else
                    {
                        //Display Message
                        echo "Image Is Not Added!";
                    }?>
                   
                   </td>
                   </tr>

                   <tr>
                    <td>New Image:
                    </td>
                    <td>
                    <input type="file" name="image">
                    </td>
                   </tr>

                   <tr>
                    <td>Featurd:</td> 
                    <td>
                    <input <?php if($featured=="Yes"){echo "checked";}?> type="radio" name="featured" value="Yes">Yes
                    <input <?php if($featured=="No"){echo "checked";}?> type="radio" name="featured" value="No">No
                    </td>
                   </tr>

                   <tr>
                        <td>Active:</td> 
                        <td>
                            <input <?php if($active=="Yes"){echo "checked";}?> type="radio" name="active" value="Yes">Yes
                            <input <?php if($active=="No"){echo "checked";}?> type="radio" name="active" value="No">No
                        </td>
                   </tr>

                   <tr>
                    <td>
                    <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                    <input type="hidden" name="id" value="<?php echo $id;?>">
                    <input type="submit" name="submit" value="Update Category" class="btn-update">
                    </td>
                   
                   
                  </tr>

            </table>
        </form>





        <?php 
            if(isset($_POST['submit']))
            {
                //echo "Clicked";
                // 1.Get the value from form
                $id = $_POST['id'];
                $title =$_POST['title'];
                $current_image =$_POST['current_image'];
                $featured = $_POST['featured'];
                $active= $_POST['active'];

                //2.Updating New image if selectd
                //check whether the image is selected or not

                if(isset($_FILES['image']['name']))
                {
                   
                    //Get the image details
                    $image_name = $_FILES['image']['name'];
                 
                    //check whether the image is available or not
                    if( $image_name != "")
                    {
                        //Image Available
                        //upload the new image
                       
                    
                        // Auto rename image
                        //Get the extebtion of our image(jpj, png, gif,etc) e.g: "food1.jpg"

                        $ext = end(explode('.',$image_name));

                        //Rename the Image
                        $image_name ="Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_343.jpg
                        

                        $source_path = $_FILES['image']['tmp_name'];

                        $destination_path = "../images/category/".$image_name;

                        //Finaly upload the image
                        $upload = move_uploaded_file($source_path, $destination_path);
                        

                        //check wheather image is uploaded or not.
                        //if image is not uploaded then stop the process and redirect with error message.

                        if($current_image != "")
                        {
                                                   
                        $remove_path="../images/category/".$current_image;
                        $remove=unlink($remove_path);

                        //check whether the image is remove or not
                        //if failed to remove them display message and stop the process
                        if($remove ==  false)
                        {
                            //Failed to remove iamge
                            $_SESSION['failed-remove']="Failed to remove current image";
                            header('location:'.SITEURL.'admin/manage-category.php');
                            die(); //stop the process

                        }

                        }

                        if($upload==false){
                            //Set message
                            $_SESSION['upload']="Failed to upload the image";

                            //redirect to add catogory page
                            header('location:'.SITEURL.'admin/manage-category.php');
                            //Stop the process
                            die();
                        }
                        //remove the current image if available
 
 

                    }else
                    {
                        $image_name = $current_image;
                    }

                
                }
                else
                {
                    $image_name = $current_image;
                }

                //3.Update the database
                $sql2 ="UPDATE tbl_category SET 
                title = '$title',
                image_name='$image_name',
                featured = '$featured',
                active='$active'
                WHERE id=$id
                ";
                //Execute the query
                $res2 = mysqli_query($conn, $sql2);

                //4.Redirect to manage category page with message

                //check whether executed or not
                if($res2==true)
                {
                    //category update
                    $_SESSION['update']="Category Updated succeesfully!";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }else
                {
                    //failed to update category
                    $_SESSION['update']="Failed to update Category!";
                    header('location:'.SITEURL.'admin/manage-category.php');
                }

                
            }
            
        ?>
    </div>
</div>

<?php include('partials/footer.php');?>