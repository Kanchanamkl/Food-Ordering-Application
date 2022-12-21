<?php include 'partials/menu.php'?>


<div class="main-content">
    <div class="wrapper">

        <h1>Manage Food</h1>
        <br>
        <?php
        
        if(isset($_SESSION['add']))
        {
            echo $_SESSION['add'];
            unset($_SESSION['add']);

        }
        ?>
        <?php
        
        if(isset($_SESSION['upload']))
        {
            echo $_SESSION['upload'];
            unset($_SESSION['upload']);

        }

        if(isset($_SESSION['failed-remove']))
        {
            echo $_SESSION['failed-remove'];
            unset($_SESSION['failed-remove']);

        }
        if(isset($_SESSION['delete']))
        {
            echo $_SESSION['delete'];
            unset($_SESSION['delete']);

        }
        if(isset($_SESSION['remove']))
        {
            echo $_SESSION['remove'];
            unset($_SESSION['remove']);

        }


        ?>

        <br>

        <button   class="btn-primary" type ="button" onclick="window.location.href='add-food.php';">Add Food</button>  
    




    <table   class="tbl-full" >
        <tr >
            <th>S.N</th>
            <th>Title</th>
            <th>Discription</th>
            <th>Price</th>
            <th>Image</th>
            <th>Category</th>
            <th>featured</th>
            <th>Active</th>
            <th>Actions</th>
            </tr>

            <?php 
            //Create a SQL Query to Get all the food
            $sql = "SELECT *FROM tbl_food";

            // Execute the Query
            $res = mysqli_query($conn , $sql);

            //Count Rows to check whether available food or not
            $count = mysqli_num_rows($res);

            $sn=1;

            if($count>0)
            {
                // we have data in database
                //get the data and display
                while($row=mysqli_fetch_assoc($res))
                {
                    $id= $row['id'];
                    $title=$row['title'];
                    $description=$row['description'];
                    $price =$row['price'];
                    $image_name=$row['image_name'];
                    $category_id=$row['category_id'];
                    $featured = $row['featured'];
                    $active=$row['active'];

                    ?>
                    <tr>
                    <td><?php echo $sn++ ?></td>
                    <td><?php echo $title?></td>
                    <td><?php echo $description?></td>
                    <td><?php echo $price?></td>
                    <td>              <?php 
                            //check weather image name is availble or not
                            if($image_name != "")
                            {
                                //display the image
                                //echo $image_name;
                                ?>
                                <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name;?>"  width="100px">
                                <?php


                            }else
                            {
                                //display the message
                                echo "Image not Added";
                            }
                            
                            

                            
                            ?></td>
                    <td><?php echo $category_id?></td>

                    <td><?php echo $featured?></td>
                    <td><?php echo $active?></td>
                    
                    <td>
                           <button class="btn-update" type ="button" onclick="window.location.href='update-food.php?id=<?php echo $id;?>';">Update Food</button>  
                           <button class="btn-delete" type ="button" onclick="window.location.href='<?php echo SITEURL;?>admin/delete-food.php?id=<?php echo $id;?>&image_name=<?php echo $image_name;?>';">Delete Food</button>  
                    
                    </td> 

                    </tr>
                    <?php
                    




                }
            
            }
            else
            {
               echo "Food not Added Yet"; 
            }

            ?>

      
    </table>

    </div>

</div>



<?php include 'partials/footer.php'?>

