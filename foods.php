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



<!-- fOOD MEnu Section Starts Here -->
<section class="food-menu">
<div class="container">
<h2 class="text-center">Food Menu</h2>
<?php

//create SQL  Query to display categories from database
$sql2 = "SELECT * FROM tbl_food WHERE active='Yes' AND featured='Yes' LIMIT 6";
//execute the query
$res2=mysqli_query($conn, $sql2);
//count rows to check whether the 
//category is available or not
$count2 = mysqli_num_rows($res2);

if($count2>0)
{
    while($row = mysqli_fetch_assoc($res2))
    {

        $id = $row['id'];
        $title =$row['title'];
        $price =$row['price'];
        $description=$row['description'];
        $image_name =$row['image_name'];


        ?>
        <div class="food-menu-box">
        <div class="food-menu-img">

        
            <img src="<?php echo SITEURL;?>images/food/<?php echo $image_name?>" alt="Chicke Hawain Pizza" class="img-responsive img-curve">
        
        </div>

        <div class="food-menu-desc">
            <h4><?php echo $title;?></h4>
            <p class="food-price">Rs. <?php echo $price;?>.00</p>
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
