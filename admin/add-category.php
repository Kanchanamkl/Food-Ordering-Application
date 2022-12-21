<?php include('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper">

    <h1>Add Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);

        }

        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);

        }
        
        ?>

        <br><br>


        <!-- Add CAtegory form start -->
        <form action="" method="POST" enctype="multipart/form-data">
            <table class ="tbl-addAdmin">
                   <tr>
                    <td>Title:</td> 
                    <td>
                        <input type="text" name="title" placeholder="category Title">
                    </td>
                   </tr><td>Select Image:</td>
                   <td>
                    <input type="file" name="image">
                   </td>

                   <tr>

                   
                   </tr>

                   <tr>
                    <td>Featurd:</td> 
                    <td>
                    <input type="radio" name="featured" value="Yes">Yes
                    <input type="radio" name="featured" value="No">No
                    </td>
                   </tr>

                   <tr>
                        <td>Active:</td> 
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                   </tr>

                   <tr>
                    <td colspan="2">
                    <input type="submit" name="submit" value="Add Category" class="btn-update">
                    </td>
                   
                   
                  </tr>

            </table>
        </form>


        <!-- Add category form end -->

        <?php 
        // check whether the Submit Button is cliked or not
        if(isset($_POST['submit']))
        {
            //echo "Clicked";
            //1.Get the value form category form
            $title = $_POST['title'];

            //for radio input, we need check whether the button is selected or not

            if(isset($_POST['featured']))
            {
                // get value from form

                $featured = $_POST['featured'];
            }
            else
            {
                //Set the default value
                $featured ="No";
            }

            if(isset($_POST['active']))
            {
                $active = $_POST['active'];

            }
            else
            {
                //set default value
                $active= "No";
            }

            //Check whether the image is selected or not and set the value for image name accordingly

            // print_r($_FILES['image']);

            // die();  // Break the code from here

            if(isset($_FILES['image']['name'])){

                //upload the image
                //To upload image we need to image name, sourse path and destination path
             
                $image_name = $_FILES['image']['name'];

                //upload the image if image is selected
                    if($image_name != "")
                    {

                    // Auto rename image
                    //Get the extebtion of our image(jpj, png, gif,etc) e.g: "food1.jpg"

                    $ext = end(explode('.',$image_name));

                    //Rename the Image
                    $image_name ="Food_Category_".rand(000,999).'.'.$ext; //e.g. Food_Category_343.jpg
                    

                    $source_path = $_FILES['image']['tmp_name'];

                    $destination_path = "../images/category/".$image_name;

            
                    //Finaly upload the image
                    $upload = move_uploaded_file($source_path, $destination_path );

                    //check weather image is uploaded or not.
                    //if image is not uploaded then stop the process and redirect with error message.

                    if($upload==false){
                        //Set message
                        $_SESSION['upload']="Failed to upload the image";

                        //redirect to add catogory page
                        header('location:'.SITEURL.'admin/manage-category.php');
                        //Stop the process
                        die();
                    }
                }

            }  else
            {
                //Dont upload the image and set the image_name value as the blank.
                $image_name="";

            }



            //2. Create SQL Query to insert category to database
            $sql="INSERT INTO tbl_category SET 
                title='$title',
                image_name='$image_name',
                featured='$featured',
                active='$active'
            ";

            //3. Execute the Query and save in darabase
            $res= mysqli_query($conn,$sql);

            //4.check whethre the query executed or not and added or not
            if($res==true)
            {
                //Query Executed and category Added
                $_SESSION['add'] = "CAtegory added successfully! ";
                //redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');

            }
            else
            {
                //Failed to add category
                $_SESSION['add'] = "Failed to Add category.";
                //redirect to manage-category page
                header('location:'.SITEURL.'admin/manage-category.php');
            }
        }
        

        ?>
        
    </div>
</div>

<?php include('partials/footer.php');?>