<?php include('partials/menu.php');?>


<div class="main-content">
    <div class="wrapper">
        <h1>Update Order</h1>

        <br><br>

        <?php
        //1.Get the Id of Selected Admin

        $id=$_GET['id'];

        //2.Create SQL Query to Get the Details
        $sql= "SELECT * FROM tbl_order WHERE id=$id";

        //Execute the Query
        $res=mysqli_query($conn,$sql);

        //check whether the query is executed or not
        

            //Check whether the data is Avaliable or no
            $count = mysqli_num_rows($res);
            //Check whether we have admin data or not
            if($count == 1)
            {
                //Get the details
                //echo "Admin Available";
                $row =mysqli_fetch_assoc($res);

                $food_name= $row['food'];
                $price =$row['price'];
                $qty =$row['qty'];
                $status =$row['status'];
                $customer_name=$row['customer_name'];
                $customer_contact=$row['customer_contact'];
                $customer_email=$row['customer_email'];
                $customer_address=$row['customer_address'];

               

                



            }
            else
            {
                //Redirect to Manage Admin Page
                header('location:'.SITEURL.'admin/manage-order.php');

            }


        

        
        
        ?>

        <form action="" method="POST">

       <br>

            <table class="tbl-addAdmin">

           <tr>
           <td>Food Name : </td>
            <td><b><?php echo $food_name?></b></td>
            </tr>
            <tr>
                <td>Price :</td>
                <td><b><?php echo $price?></b></td>

            </tr>
             <tr>
            <td> Qty :  </td>
            <td> <input type="number" name ="qty" value="<?php echo $qty?>"></td>

            </tr>
             <tr>
            <td>
            Status :  
            </td>
            <td>
            <select name="status" >
                <option <?php if($status=="Ordered"){echo "selected";}?> value="Ordered">Ordered</option>
                <option <?php if($status=="On Delevery"){echo "selected";}?>value="On Delivery">On Delevery</option>
                <option <?php if($status=="Delivered"){echo "selected";}?> value="Delivered">Delivered</option>
                <option <?php if($status=="Cancelled"){echo "selected";}?> value="Cancelled">Cancelled</option>
                

            </select>
            </td>

            </tr>
            <tr>
                <td>Customer Name:</td>
                <td><input type="text" name="customer_name" value="<?php echo $customer_name?>"></td>
            </tr>

            <tr>
                <td>Customer Contact:</td>
                <td><input type="text" name= "customer_contact" value="<?php echo $customer_contact?> "> </td>
            </tr>
            <tr>
                <td>Customer Email:</td>
                <td><input type="text" name= "customer_email" value="<?php echo $customer_email?> "> </td>
            </tr>
            <tr>
                <td>Customer Address:</td>
                <td>
                    <textarea name="customer_address" id="" cols="30" rows="5" ?><?php echo $customer_address;?></textarea>

                </td>
            </tr>
 
            <td colspan="2">
                <input type="hidden" name="id" value="<?php echo $id?>">
                <input type="hidden" name="price" value="<?php echo $price?>">
                <input type="hidden" name="food_name" value="<?php echo $food_name?>" >
                <input type="submit" name="submit" value="Update Order" class="btn-update">

            </td>
        </tr>
      </tr>


      </table>
    
    
       <br>
     </form>
    </div>
</div>


<?php
if(isset($_POST['submit']))
{

        // echo "Button Clicked";
        // Get all the value form form
        $id = $_POST['id'];
        $food= $_POST['food_name'];
        $price =$_POST['price'];
        $qty =$_POST['qty'];
        $total = $qty*$price;
        $status =$_POST['status'];
        $customer_name=$_POST['customer_name'];
        $customer_contact=$_POST['customer_contact'];
        $customer_email=$_POST['customer_email'];
        $customer_address=$_POST['customer_address'];





        //Create a SQL Query to Update Admin

        $sql2="UPDATE tbl_order SET 
        
        qty='$qty',
        total='$total',
        status='$status',
        customer_name='$customer_name',
        customer_contact='$customer_contact',
        customer_email='$customer_email',
        customer_address='$customer_address'

        WHERE id=$id
        ";

        

        //Execute the Query
        $res2 = mysqli_query($conn,$sql2);

        //Create whether the Query executed successfully or not


        if($res2==true){


            //Query Executed and Admin Updated
            $_SESSION['update'] = "Order updated successfully.";
            //Rederect to Mange Admin Page
            header('location:'.SITEURL.'admin/manage-order.php');

        }else
        {


            //Failed to update Admin
            $_SESSION['update'] = "<div class='error'> Failed to Update Order . <div/>";
            //Rederect to Mange Admin Page  
            header('location:'.SITEURL.'admin/manage-order.php');

        }

}

?>

<?php include('partials/footer.php');?>