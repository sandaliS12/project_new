<?php
        $active='Cart';
        include("includes/header.php");
?>


    <div id="content"><!--content begin  -->
        <div class="container"><!--container begin  -->
            <div class="col-md-12"><!--col-md-12 begin  -->

                <ul class="breadcrumb"><!--breadcrumb begin  -->
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        Cart
                    </li>
                </ul><!--breadcrumb finish  -->
            </div><!--col-md-12 finish  -->

            <div id="cart" class="col-md-9"><!--col-md-9 begin  -->
                <div class="box"><!--box begin  -->
                    <form action="cart.php" method="post" enctype="multipart/form-data"><!--form begin  -->
                        <h1>Shopping Cart</h1>

                        <?php 
                       
                       $ip_add = getR();
                       
                       $select_cart = "select * from custom_cart where item_p='$ip_add'";
                       
                       $run_cart = mysqli_query($con,$select_cart);
                       
                       $count = mysqli_num_rows($run_cart);
                       
                       ?>

                        <p class="text-muted">  <?php echo $count; ?> items are in your shopping cart</p>
                        <div class="table-responsive"><!--table-responsive begin  -->

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Product</th>
                                        <th>Quantity</th>
                                        <th>Unit Price</th>
                                        <th>Size</th>
                                        <th >Delete</th>
                                        <th >Sub-Total</th>
                                    </tr>
                                </thead>
                            
                                <tbody>
                                <?php 
                                   
                                   $total = 0;
                                   
                                   while($row_cart = mysqli_fetch_array($run_cart)){
                                       
                                     $pro_id = $row_cart['p_id'];
                                       
                                     $pro_size = $row_cart['size'];
                                       
                                     $pro_qty = $row_cart['quantity'];
                                       
                                       $get_products = "select * from products where product_id='$pro_id'";
                                       
                                       $run_products = mysqli_query($con,$get_products);
                                       
                                       while($row_products = mysqli_fetch_array($run_products)){
                                           
                                           $product_title = $row_products['product_title'];
                                           
                                           $product_img1 = $row_products['product_img1'];
                                           
                                           $only_price = $row_products['product_price'];
                                           
                                           $sub_total = $row_products['product_price']*$pro_qty;
                                           
                                           $total += $sub_total;
                                           
                                   ?>
                                   
                                   <tr><!-- tr Begin -->
                                       
                                       <td>
                                           
                                           <img class="img-responsive" src="admin_area/product_images/<?php echo $product_img1; ?>" alt="Product 3a">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <a href="details.php?pro_id=<?php echo $pro_id; ?>"> <?php echo $product_title; ?> </a>
                                           
                                       </td>
                                       
                                       <td>
                                          
                                           <?php echo $pro_qty; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $only_price; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <?php echo $pro_size; ?>
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           <input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>">
                                           
                                       </td>
                                       
                                       <td>
                                           
                                           Rs.<?php echo $sub_total; ?>
                                           
                                       </td>
                                       
                                   </tr><!-- tr Finish -->
                                   
                                   <?php } } ?>
                                   
                               </tbody><!-- tbody Finish -->

                                <tfoot>
                                    <tr>
                                        <th colspan="6">Total</th>
                                        <th colspan="2">RS. <?php echo $total; ?></th>


                                    </tr>

                                </tfoot>


                            </table>

                        </div><!--table-responsive finish  -->

                        <div class="box-footer">
                            <div class="pull-left">
                                <a href="index.php" class="btn btn-default">
                                    <i class="fa fa-chevron-left"></i> Continue Shopping

                                </a>
                            </div><!--pull-left finish  -->

                            <div class="pull-right">
                                <button type="submit" name="update" value="Update Cart" class="btn btn-default">
                                    <i class="fa fa-refresh"></i> Delete Items






                                </button>

                                
                                <a href="order.php ?>" class="btn btn-primary">
                                    Proceed Checkout <i class="fa fa-chevron-right"></i> 

                                </a>
                            </div><!--pull-left finish  -->


                        </div><!--box-footer finish  -->

                    </form><!--form finish  -->


                </div><!--box finish  -->

                <?php

                function Myc_update(){
                    
                    global $con;
                    
                    if(isset($_POST['update'])){
                        
                        foreach($_POST['remove'] as $remove_id){
                            
                            $delete_product = "delete from custom_cart where p_id='$remove_id'";
                            
                            $run_delete = mysqli_query($con,$delete_product);
                            
                            if($run_delete){
                                
                                echo "<script>window.open('cart.php','_self')</script>";
                                
                            }
                            
                        }
                        
                    }
                    
                }
               
               echo @$up_cart = Myc_update();
               
               ?>

                <div id="row same-heigh-row"><!--row same-heigh-row begin  -->
                    <div class="col-md-3 col-sm-6"><!--col-md-3 col-sm-6 begin  -->
                        <div class="box same-height headline"><!--box same-height headline begin  -->
                            <h3 class="text-center">Product You Like</h3>
                            </div><!--box same-height headline finish  -->
                    </div><!--col-md-3 col-sm-6 finish  -->


                    <div class="col-md-3 col-sm-6 center-responsive"><!--col-md-3 col-sm-6 center-responsive begin  -->
                        <div class="product same-height "><!--product same-height begin  -->
                            <a href="details.php">
                            <img class="img-responsive" src="admin_area/product_images/p2_a.jpg" alt="product 1"  >
                            </a>

                            <div class="text"><!--text begin  -->
                                <h3><a href="details.php">Casual women</a></h3>

                                <p class="price">$40</p>
                            </div><!--text finish  -->
                        </div><!--product same-height finish  -->
                    </div><!--col-md-3 col-sm-6 center-responsive finish  -->

                    <div class="col-md-3 col-sm-6 center-responsive"><!--col-md-3 col-sm-6 center-responsive begin  -->
                        <div class="product same-height "><!--product same-height begin  -->
                            <a href="details.php">
                            <img class="img-responsive" src="admin_area/product_images/p2_a.jpg" alt="product 1"  >
                            </a>

                            <div class="text"><!--text begin  -->
                                <h3><a href="details.php">Casual women</a></h3>

                                <p class="price">$40</p>
                            </div><!--text finish  -->
                        </div><!--product same-height finish  -->
                    </div><!--col-md-3 col-sm-6 center-responsive finish  -->

                    <div class="col-md-3 col-sm-6 center-responsive"><!--col-md-3 col-sm-6 center-responsive begin  -->
                        <div class="product same-height "><!--product same-height begin  -->
                            <a href="details.php">
                            <img class="img-responsive" src="admin_area/product_images/p2_a.jpg" alt="product 1"  >
                            </a>

                            <div class="text"><!--text begin  -->
                                <h3><a href="details.php">Casual women</a></h3>

                                <p class="price">$40</p>
                            </div><!--text finish  -->
                        </div><!--product same-height finish  -->
                    </div><!--col-md-3 col-sm-6 center-responsive finish  -->



                </div><!--row same-heigh-row finish  -->

            </div><!--col-md-9 finish  -->

            <div class="col-md-3  "><!--col-md-3  center-responsive begin  -->
                <div id="order-summary" class="box">
                    <div class="box-header">
                        <h3>Order Summary</h3>
                    </div><!--box-header finish  -->
                    <p class="text-muted">
                        Shipping and additional costs are calculated 
                    </p>
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td> Order Sub-Total </td>
                                    <th> RS. <?php echo $total;?> </th>
                                </tr>
                                <tr>
                                    <td> Delivery fee </td>
                                    <th> RS. 250 </th>
                                </tr>
                                <tr>
                                    <td> Tax (RS.) </td>
                                    <th> 0 </th>
                                </tr>
                                <tr class="total">
                                    <td> Total </td>
                                    <th> RS. <?php echo $total + 250;?> </th>
                                </tr>

                            </tbody>

                        </table>
                        
                    </div><!--table-responsive finish  -->
                </div><!--box finish  -->
            </div><!--col-md-3 finish  -->


            </div><!--container finish  -->
    </div><!--content finish  -->



    <?php

        include("includes/footer.php");
    ?>

<script src="js/jquery-331.min.js"></script>
<script src="js/bootstrap-337.min.js"></script>

</body>
</html>