<?php
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php');

?>

<?php
//check if SESSION id is set AND SESSION user role is ("A" ->Admin) then display admin info
if (isset($_SESSION['id']) && $_SESSION['user_role'] == "A") {
    $id = $_SESSION['id'];
    $query = 'SELECT * FROM users WHERE id =?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc();
    //otherwisr normal user DO NOT have access to this page
} else {
    exit('<div class="inner" align="center" ><h2> you do not have access to this section </h2></div>');
}
?>






<?php
//admin delete product
if (isset($_POST['deletepro'])) {
    // Get form data
    $delete_product_id = htmlspecialchars((int)$_POST['Pid']);

    $delete_query = "DELETE FROM products WHERE id=?";
    $stmti = $conn->prepare($delete_query);
    $stmti->bind_param('i', $delete_product_id);
    $stmti->execute();
    //$stmti->close();
}

?>





<head>
    <title> Smile Slimes | Admin page</title>

</head>

<!-- Main -->
<div id="main">
    <div class="inner">
        <h1>Welcome Admin <?php echo $user['fname']; ?></h1>
        <div>
            <div class="row gtr-uniform">
                <div class="col-6 col-12-medium">
                    <ul class="alt" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px #888888;">
                        <li>First name: <b><?php echo $user['fname']; ?></b></li>
                        <li>Last name:<b> <?php echo $user['lname']; ?></b></li>
                        <li>username: <b><?php echo $user['uname']; ?></b></li>
                        <li>Phone: <b><?php echo $user['phone']; ?></b></li>
                        <li>Email: <b><?php echo $user['email']; ?></b></li>
                        <li>Gender: <b><?php echo $user['gender']; ?></b></li>
                    </ul>
                </div>
                <div class="col-6 col-12-medium">
                    <ul class="alt" style="border: 1px solid; padding: 10px; box-shadow: 5px 10px #888888;">
                        <li>Birthday: <b><?php echo $user['bday']; ?></b></li>
                        <li>Country:<b> <?php echo $user['country']; ?></b></li>
                        <li>Address: <b><?php echo $user['address1']; ?></b></li>
                        <li>Postcode: <b><?php echo $user['postcode']; ?></b></li>
                        <li><br><input type="button" class="button fit" onclick="location.href='editAccount.php';" value="Edit Account" /></li>
                    </ul>
                </div>




                <div class="col-12">
                    <h2>Control Panel:</h2>
                    <ul class="actions fit">
                        <li><button class="button fit" onclick="addProduct()">Add Product</button></li>
                        <li><button class="button fit" onclick="deleteProduct()">Delete Product</button></li>
                        <li><button class="button fit" onclick="showMsg()">View Messages</button></li>
                    </ul>
                </div>

                <!-- add product redirect the proccess to upload.php -->
                <form id="addProd" action="upload.php" method="post" enctype="multipart/form-data" style="display:none" required>
                    <h3>Add new product</h3>
                    <div class="row gtr-uniform">
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="Pname" id="Pname" value="" placeholder="Product Name" required />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" pattern="[-+]?[0-9]*[.,]?[0-9]+" title="number only" name="Price" id="Price" value="" placeholder="Price" required />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="text" name="Psize" id="Size" value="" placeholder="Size" required />
                        </div>
                        <div class="col-6 col-12-xsmall">
                            <input type="number" name="Amount" id="Amount" value="" placeholder="Amount" min="0" step="1" style="width: 7em" required />
                        </div>

                        <div class="col-6 col-12-xsmall">
                            <label for="img">Select Product image:</label>
                            <input type="file" name="fileToUpload" id="fileToUpload" required>
                        </div>
                        <div class="col-12">
                            <textarea name="Pdesc" id="Pdesc" placeholder="Product description" rows="5" required></textarea>
                        </div>
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" name="submit" value="Submit" class="primary" /></li>
                                <li><input type="reset" value="Reset" /></li>
                            </ul>
                        </div>
                    </div>
                </form>

                <div id="showMsg" style="display:none">
                    <h3>Show Messages from customers</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Message</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = 'SELECT name,email,message FROM contact';
                            $result = mysqli_query($conn, $query);
                            $msgs = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach ($msgs as $msg) : ?>
                                <tr>
                                    <td name="name"><?php echo $msg['name']; ?></td>
                                    <td name="email"><?php echo $msg['email']; ?></td>
                                    <td name="message"><?php echo $msg['message']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

                <form id="deleteProd" method="POST" action="" style="display:none">
                    <h3>Delete product</h3>
                    <table>
                        <thead>
                            <tr>
                                <th>Product ID</th>
                                <th>Product Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            //show all products name with id to the admin to choose one to delete
                            $query = 'SELECT id,pname FROM products';
                            $result = mysqli_query($conn, $query);
                            $products = mysqli_fetch_all($result, MYSQLI_ASSOC);
                            foreach ($products as $product) : ?>

                                <tr>
                                    <td name="id"><?php echo $product['id']; ?></td>
                                    <td name="name"><?php echo $product['pname']; ?></td>

                                </tr>

                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <div class="row gtr-uniform">
                        <div class="col-6 col-12-xsmall">
                            <label> Enter the Product ID you want to Delete:</label>
                            <input type="number" name="Pid" id="Pid" value="" placeholder="Product ID" style="width: 7em" />
                        </div>
                        <div class="col-12">
                            <ul class="actions">
                                <li><input type="submit" name="deletepro" value="Delete" class="primary" /></li>
                                <li><input type="reset" value="Cancel" /></li>
                            </ul>
                        </div>
                    </div>
                </form>
                <script>
                    function addProduct() {
                        document.getElementById('deleteProd').style.display = 'none';
                        document.getElementById('addProd').style.display = 'block';
                        document.getElementById('showMsg').style.display = 'none';

                    }

                    function deleteProduct() {
                        document.getElementById('addProd').style.display = 'none';
                        document.getElementById('deleteProd').style.display = 'block';
                        document.getElementById('showMsg').style.display = 'none';

                    }

                    function showMsg() {
                        document.getElementById('deleteProd').style.display = 'none';
                        document.getElementById('addProd').style.display = 'none';
                        document.getElementById('showMsg').style.display = 'block';
                    }
                </script>
            </div>
        </div>
    </div>
</div>


<?php include('inc/footer.php'); ?>