<?php include('partials-front/menu.php')?>


<?php 
//check whether id is passed or not
if(isset($_GET['category_id']))
{
    $category_id = $_GET['category_id'];
    $category_title=$_GET['category_title'];
}
else
{

    //category not passd and redirect to homepage
    header('location:'.SITEURL.'index.php');
}
?>

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-center">
        <div class="container">
            
            <h2>Foods on <a href="#" class="text-white"><?php echo $category_title;?></a></h2>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->



    <!-- fOOD MEnu Section Starts Here -->
    <section class="food-menu">
        <div class="container">
            <h2 class="text-center">Food Menu</h2>


            <?php 

            // create SQL to get foods based on cateogry
            $sql2="SELECT * FROM tbl_food WHERE category_id = $category_id";

            //Execute the query 
            $res2 = mysqli_query($conn , $sql2);

            $count2 = mysqli_num_rows($res2);

            
            //check the food is available or not
            if($count2>0)
            {
                while($row=mysqli_fetch_assoc($res2))
                {
                    $id =$row['id'];
                    $title = $row['title'];
                    $price =$row['price'];
                    $description =$row['description'];
                    $image_name =$row['image_name'];



                    ?>
                    
                    <div class="food-menu-box">
                        <div class="food-menu-img">
                    
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
                            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Pizza" class="img-responsive img-curve ">


                                <?php

                            }
                        ?>

                
                        </div>

                        <div class="food-menu-desc">
                            <h4><?php echo $title;?></h4>
                            <p class="food-price"><?php echo $price;?></p>
                            <p class="food-detail">
                                <?php echo $description;?>
                            </p>
                            <br>

                            <a href="<?php echo SITEURL;?>order.php?food_id=<?php echo $id;?>" class="btn btn-primary">Order Now</a>
                        </div>
                    </div>



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
    <!-- fOOD Menu Section Ends Here -->
    <?php include('partials-front/footer.php')?>
