<?php include('partials/menu.php');?>

<div class="main-content">
 <div class="wrapper">
    <h1>Add Food</h1>

    <br><br>

    

    <form action="" method="POST" enctype="multipart/form-data">

    <table class="tbl-addAdmin">
        <tr>
            <td>Title:</td>
            <td>
                <input type="text" name="title" placeholder ="Title of the Food">
            </td>
        </tr>

        <tr>
            <td>Description:</td>
            <td><textarea name="description" id="" cols="30" rows="5" placeholder="Description of the Food"></textarea></td>
        </tr>

        <tr>
            <td>Price:</td>
            <td><input type="number" name="price"></td>
        </tr>

        <tr>
            <td>Select Image:</td>
       
        <td>
            
            <input type="file" name="image">
            
        </td>
        </tr>

        <tr>
           <td> Category:</td>
           <td>
            <select name="category" >

            <?php
            //Create PHP to Display category from databse
            //1. Create SQL to get active category from database
            $sql="SELECT * FROM tbl_category WHERE active='Yes'";
            //Execute the Query
            $res=mysqli_query($conn, $sql);
            //Count rows to check whether we have category or not 
            $count =mysqli_num_rows($res);
            //if count is grater than zero , available categories else not available.
            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id=$row['id'];
                    $title=$row['title'];

                    ?>
                    <option value="<?php echo $id?>" ><?php echo $title?></option>


                    <?php

                }
            }
            else
            {
                // category not available on database
                ?>
                <option value="0">No Category Found</option>
                <?php


            }


            
            ?>
            <!-- <option value="1">Food</option>
            <option value="2">Snack</option> -->

            </select>
           </td>
        </tr>


        <tr>
            <td>Featured: </td>
            <td>
                <input type="radio" name="featured" value="Yes">Yes
                <input type="radio" name="featured" value="No">No
            </td>
        </tr>
        <tr>

        <tr>
            <td>Active:</td>
            <td>
                <input type="radio" name="active" value="Yes">Yes
                <input type="radio" name="active" value="No">No
            </td>
        </tr>

        <td colspan=2>
            <input type="submit" name="submit" value="Add Food" class="btn-update">

        </td>
        </tr>
  
    </table>


    </form>



    <?php

    //Check whether the button id clikced or not
    if(isset($_POST['submit']))
    {

        //Add the Food in databse
        //echo "Clicked";

        $title= $_POST['title'];
        $description= $_POST['description'];
        $price = $_POST['price'];
        $category= $_POST['category'];

        //Check whether radio button for featured and active are checked or not'
        if(isset($_POST['featured']))
        {
            $featured = $_POST['featured'];

        }
        else
        {
            $featured = "No"; // Set default value
        }

        if(isset($_POST['active']))
        {
            $active = $_POST['active'];
        }
        else
        {
            $active ="No";  // Set default value
        }
    


        
        //1.Get the data form'
        //2.upload the image if selelctd '
        // Check whether the select image is clicked or not upload the image is selelcted

            if(isset($_FILES['image']['name']))
            {
                
                
                //get the details of the selected image
                $image_name = $_FILES['image']['name'];

                //upload the image if selected
                if($image_name != "")
                {
                    //1. rename the image
                    // Get the extention  of selected image(jpg, png , gif , etc)

                    $ext = end(explode('.',$image_name));
                    // create the now name for image
                    $image_name= "Food_Name_".rand(000,9999).'.'.$ext;

                    //2.upload the image
                    //Get the source path and destination path (source path = current location of the image)

                   
                    $src = $_FILES['image']['tmp_name'];
                    $dst = "../images/food/".$image_name;
                    // Destination path

                    

                 

                    $upload = move_uploaded_file($src ,$dst);

                    

                    if($upload==false)
                    {
                        //failed to upload the image
                        //rederact to add food page with Error Message

                        $_SESSION['upload']="Failed to Upload Image";
                        header('location:'.SITEURL.'admin/manage-food.php');
                        //Stop the process
                        die();

                    }

                }
    
          
            }
            else
            {
              
                $image_name= "";
            }

            // echo $title;
            // echo $description;
            // echo $price;
            // echo $image_name;
            // echo $category;
            // echo $featured;
            // echo $active;

            // die();





            //Insert into databse
            //Create sql Query to save or add food
            $sql2 = "INSERT INTO tbl_food SET 
                title ='$title',
                description ='$description',
                price ='$price',
                image_name ='$image_name',
                category_id ='$category',
                featured ='$featured',
                active ='$active'
            ";
            //  echo "unok";
            //  die();
            //Execute the query
            $res2 = mysqli_query($conn, $sql2);

            
            //check whether data inserted or not
            if( $res2 == true)
            {
                //echo "inserted";
                // data inserted successfully
                $_SESSION['add']="Food Added Successfully!";
                header('location:'.SITEURL.'admin/manage-food.php');

            }else
            {
               // echo " not inserted";
                //Failed to inserted data
                $_SESSION['add']="Failed to Add Food";
                header('location:'.SITEURL.'admin/manage-food.php');

            }


            // 4.Redirect to Message to Manage Food page
    }
    else
    {
            
            // //Failed to inserted data
            // $_SESSION['add']="Failed to Add Foods";
            // header('location:'.SITEURL.'admin/manage-food.php');
    }
        //3.Insert into database'
        //4.Rederect with Message to Manage-food page

    

    
    ?>
</div>
</div>

<?php include('partials/footer.php');?>