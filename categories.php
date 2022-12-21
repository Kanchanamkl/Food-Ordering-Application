<?php include('partials-front/menu.php')?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Food.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->
    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>


            <?php 
            // Display all the categories that are active
            //sql query
            $sql ="SELECT * FROM tbl_category WHERE active='Yes'";
            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if($count>0)
            {
                while($row=mysqli_fetch_assoc($res))
                {
                    $id = $row['id'];
                    $title =$row['title'];
                    $image_name =$row['image_name'];
                 

                    ?>

                    <a href="category-foods.php ">
                    <div class="box-3 float-container">

                    <?php 

                    if($image_name=="")
                    {

                        //Display Message
                        echo "Image not Available";

                    }
                    else
                    {
                        //Image Available
                        ?>
                     <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve ">


                        <?php

                    }
                    ?>
                    

                    <h3 class="float-text text-white"><?php echo $title?></h3>
                  </div>
                   </a>

                   <?php
                }

            }
            else
            {
                
            } 


            
            ?>

      

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php')?>
