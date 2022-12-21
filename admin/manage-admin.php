<?php include('partials/menu.php')?>




    <div class="main-content">
       <div class="wrapper">
       <h1>Manage Admin</h1>

       <br>

       <?php
       if(isset($_SESSION['add'])){

        echo $_SESSION['add'];     // Displaying session message
        unset($_SESSION['add']);   // removing session message

       }
       if(isset($_SESSION['delete'])){

        echo $_SESSION['delete'];     // Displaying session message
        unset($_SESSION['delete']);   // removing session message

       }
       if(isset($_SESSION['update']))
       {
        echo $_SESSION['update'];
        unset($_SESSION['update']);

       }
       if(isset($_SESSION['user-not-found']))
       {
        echo $_SESSION['user-not-found'];
        unset($_SESSION['user-not-found']);

       }

       if(isset($_SESSION['pwd-not-match']))
       {
        echo $_SESSION['pwd-not-match'];
        unset($_SESSION['pwd-not-match']);
       }

       if(isset($_SESSION['change-pwd']))
       {
        echo $_SESSION['change-pwd'];
        unset($_SESSION['change-pwd']);
       }






       ?>

       <br><br>

       <!--  button to Add admin-->

    <button   class="btn-primary" type ="button"  value ="New Tab" onclick="window.location.href='add-admin.php';">Add Admin</button>
    <br><br>  
    




    <table   class="tbl-full" >
        <tr >
            <th>S.N</th>
            <th>Full Name</th>
            <th>Username</th>
            <th>Actions</th>


            <?php
            //Query to Get Admin
            $sql = "SELECT *FROM tbl_admin";
            //Execute the Query
            $res = mysqli_query($conn, $sql);

            //Check whether the query is Executed of host

            if($res == TRUE)
            {
                // Count Rows to check whether we have data in database or not

                $count = mysqli_num_rows($res);

                $sn =1; //Create a variable and Assign the value

                if($count>0)
                {
                    //we have data in database
                    while($rows = mysqli_fetch_assoc($res))
                    {
                        //Using while loop to get the data database
                        //And while loop run as long as data in database

                        // Get individual data
                        $id = $rows['id'];
                        $full_name = $rows['full_name'];
                        $username = $rows['username'];

                        // Display the values in our Table

                    
                        ?>

                            <tr>
                                <td><?php echo $sn++?></td>
                                <td><?php echo $full_name?></td>
                                <td><?php echo $username?></td>
                                <td>
                                <button class="btn-changepw" type ="button" onclick="window.location.href='update-password.php?id=<?php echo $id; ?>';">Change Passward</button>

                                <button class="btn-update" type ="button" onclick="window.location.href='update-admin.php?id=<?php echo $id; ?>';">Update Admin</button>
                                
                                <button class="btn-delete" type ="button" onclick="window.location.href='delete-admin.php?id=<?php echo $id; ?>';">Delete Admin</button> 
                                
                                
                                
                                </td>

                            </tr>

                        <?php
                        

                    }
                }
                else
                {
                    // we dont have data in database
                }


            }


        
            ?>
 


        </tr>
    </table>





       <div class="clearfix"> </div>

       </div>
       
    </div>

    <!-- Main content end -->


<?php include 'partials/footer.php'?>

