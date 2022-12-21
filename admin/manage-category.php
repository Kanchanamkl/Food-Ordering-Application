<?php include 'partials/menu.php'?>


    
<div class="main-content">
    <div class="wrapper">

        <h1>Manage Category</h1>
        <br><br>

        <?php
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);

        }

        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);

        }

        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);
        }

        if(isset($_SESSION['no-category-found']))
        {
            echo $_SESSION['no-category-found'];
            unset($_SESSION['no-category-found']);
        }


        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);
        }
        
        if(isset($_SESSION['update']))
        {
            echo $_SESSION['update'];
            unset($_SESSION['update']);
        }

        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);
        }
        

        ?>

        <br>
        <br>

        <button class="btn-primary" type ="button" onclick="window.location.href='<?php echo SITEURL;?>admin/add-category.php'">Add Category</button>
        <br><br>  
    




    <table   class="tbl-full" >
        <tr >
            <th>S.N</th>
            <th>Title</th>
            <th>Image</th>
            <th>featured</th>
            <th>Active</th>
            <th>Actions</th>


            <?php 
            $sql= "SELECT * FROM tbl_category ";

            //execute the query
            $res= mysqli_query($conn, $sql);

            // count raws
            $count = mysqli_num_rows($res);
            $sn =1; //Create a variable and Assign the value

            //Check weather data available or not
            if($count>0){
                //if data available
                //get the data to display
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title =$row['title'];
                    $image_name =$row['image_name'];
                    $featured = $row['active'];
                    $active =$row['active'];
                 

                    ?>

                    <tr>
                        <td><?php echo $sn++?></td>
                        <td><?php echo $title;?></td>
                        <td>
                            <?php 
                            //check weather image name is availble or not
                            if($image_name != "")
                            {
                                //display the image
                                //echo $image_name;
                                ?>
                                <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name;?>"  width="100px">
                                <?php


                            }else
                            {
                                //display the message
                                echo "Image not Added";
                            }
                            
                            

                            
                            ?>
                        </td>
                        <td><?php echo $featured;?></td>
                        <td><?php echo $active;?></td>
                        <td>
                           <button class="btn-update" type ="button" onclick="window.location.href='update-category.php?id=<?php echo $id;?>';">Update Category</button>  
                           <button class="btn-delete" type ="button" onclick="window.location.href='<?php echo SITEURL;?>admin/delete-category.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>';">Delete Category</button>  
                    
                    </td> 

                    </tr>


                    <?php
                    


                }



            }
            else{
                //if data not available
                // Display the message inside table

                ?>

                <tr>
                    <td colspan="6 "><div>No Category Added</div> </td>
                </tr>
                   
                <?php

                  
            }

            ?>
        
  

        </tr>
    </table>

    </div>

</div>


<?php include 'partials/footer.php'?>

