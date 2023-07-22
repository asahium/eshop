<?php 
require_once('config/config.php');
include_once('config/db.php');

?>


<head><title>Smile Slimes | Shopping Cart</title>
<link rel="stylesheet" href="css/main.css" >
</head>

<?php include('inc/header.php');?>



<?php


$total = 0.0;
//Check if session id is set, meaning that the user CAN NOT view the cart unless he/she is logged in 
//if set continou view the cart item
if(isset($_SESSION['id'])){
    $user_id = $_SESSION['id'];
    $session_unique=$_SESSION['session_uniqeID'];
    
    $query = "SELECT * FROM cart WHERE session_uniqeID='$session_unique' AND user_id= '$user_id'";
    $result = mysqli_query($conn,$query);
    $rows= mysqli_fetch_all($result, MYSQLI_ASSOC);
    mysqli_free_result($result);

    
   
    if (!$rows) {
        // Simple error to display if the id for the product doesn't exists (array is empty)
        
        
        exit('<div class="inner" align="center" ><h2> Cart Is Empty! </h2></div>');}
//else if no set session id then user CAN NOT view the cart unless he/she is logged in
//exit with disply this message
}else{
    exit('<div class="inner" align="center" ><h2> Let\'s make sure you have the best user experience possible. Click the login button and let\'s get started on this fun journey together! 😊 </h2></div>');
}
// mysqli_close($conn);

?>


<?php
//Check for submit to remove item from the cart
if(isset($_SESSION['id'],$_POST['delete'])){
    $user_id = $_SESSION['id'];
    $session_unique=$_SESSION['session_uniqeID'];
    //Get form data
    $delete_id = $_POST['delete_id'];
    //delete based in 3 things (user id, session_uniqeID, product_id) since the cart table is shared
    // so we need to make sure that for the specific user id and spcific session_uniqeID which is the most important 
    $query = "DELETE FROM cart WHERE session_uniqeID='$session_unique' AND product_id='$delete_id' AND user_id='$user_id'";
    if(mysqli_query($conn, $query)){
        header('Location: shoppingcart.php');
    } else {
        exit('<div class="inner" align="center" ><h2> Error While Removing A Product! </h2></div>');
    }
}

?>

<div>
<div class="centering">

    <div class="inner">

         <h2>SHOPPING CART</h2>
				<div class="table-wrapper">
                <section>

				    <table>

						<thead>
				            <tr>
								<th>Item</th>
                                <th>Quantity</th>
								<th>Price</th>
                                <!-- <th align='right'>Remove</th> -->
				            </tr>
				        </thead>
				        <tbody>
                        <?php foreach($rows as $row):?>
    
                            <tr>

								<td name="item"><?php echo $row['itemname']; ?></td>
                                <td name="quantity"><?php echo $row['quantity']; ?></td>
								<td  name="price"><?php echo $row['price']*$row['quantity']." SAR";?></td>
                                <!-- calculate total for each item -->
                                <?php $total = $total +  ($row['price'] * $row['quantity']);?>                                      
                                <td align='right' >
                                    <form  method="POST" action="">
                                        <input type="hidden" name="delete_id" value="<?php echo $row['product_id']; ?>">
                                        <input type="submit" name="delete" value="Remove">
                                    </form>
                                </td>
                                

                            </tr>

                         <?php endforeach; ?>

								</tbody>
											<tfoot>
												<tr>
													<td colspan="3"></td>
                                                    <td><h2>Total Price</h2><h3>
                                                    <?php echo $total.".00  SAR";?>
                                                        </h3></td>
												</tr>
											</tfoot>

										</table>
                                                    <td><a href="#" id="btn" class="button primary fit" type="submit">CHECKOUT</a>
                                            <script type="text/javascript">
                                                document.getElementById("btn").onclick = function () {
                                                location.href = "checkout.php"; };
                                            </script>
                                                    </td>
				
                </section>

				</div>
                                                </div>            

</div>
    </div>
	<?php include('inc/footer.php'); ?>
