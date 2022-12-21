<?php include 'partials/menu.php'?>

<div class="main-content">
    <div class="wrapper_mng_order">

        <h1>Manage Orders</h1>

    <br><br>
    <?php
    if(isset($_SESSION['update']))
    {
        echo $_SESSION['update'];
        unset($_SESSION['update']);

    }
    ?>

    <br><br>
 
  

    <table   class="tbl_mng_order" >
        <tr >
            <th>S.N</th>
            <th>Food</th>
            <th>Price</th>
            <th>Qty.</th>
            <th>Total</th>
            <th>Order Date</th>
            <th>Status</th>
            <th>Customer Name</th>
            <th>Contact</th>
            <th>Email</th>
            <th>Address</th>
            <th>Actions</th>

            </tr> 
            
            <?php 
                // Get all the data form database
                $sql ="SELECT * FROM tbl_order  " ;

                $res = mysqli_query($conn , $sql);

                $count = mysqli_num_rows($res);

                $sn =1;

                if($count>0)
                {
                    // Data Available in database
                    while($row= mysqli_fetch_assoc($res))
                    {

                        $id=$row['id'];
                        $food=$row['food'];
                        $price=$row['price'];
                        $qty=$row['qty'];
                        $total=$row['total'];
                        $order_date =$row['order_date'];
                        $status =$row['status'];
                        $customer_name=$row['customer_name'];
                        $contact=$row['customer_contact'];
                        $email =$row['customer_email'];
                        $address = $row['customer_address'];

                        ?>
                        

                        <tr>
                        <td><?php echo $sn++;?></td>
                        <td><?php echo $food;?></td>
                        <td><?php echo $price;?></td>
                        <td><?php echo $qty;?></td>
                        <td><?php echo $total;?></td>
                        <td><?php echo $order_date;?></td>
                        <td><?php echo $status;?></td>
                        <td><?php echo $customer_name;?></td>
                        <td><?php echo $contact;?></td>
                        <td><?php echo $email;?></td>
                        <td><?php echo $address;?></td>
                        <td>
                        <button class="btn-update" type ="button" onclick="window.location.href='update-order.php?id=<?php echo $id; ?>';">Update Order</button>
                                        
                        </td>

        
                    </tr>
                    <?php
                   



                    }
                }
                else
                {

                }
                

            ?>


           
        

        
    </table>

    </div>

</div>


<?php include 'partials/footer.php'?>

