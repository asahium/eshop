<?php
require_once('config/config.php');
include_once('config/db.php');
include('inc/header.php'); ?>
<?php
// session_start();
if (isset($_SESSION["id"])) {
    $id = $_SESSION['id'];
    // Use of prepared statement
    $query = 'SELECT * FROM users WHERE id =?';
    $stmt = $conn->prepare($query);
    $stmt->bind_param('i', $id);
    $stmt->execute();
    $result = $stmt->get_result(); // get the mysqli result
    $user = $result->fetch_assoc();
}


if (isset($_POST['update'])) {
    // Get form data //Input Validation/Sanitization
    $uname = htmlspecialchars($_POST['uname']);
    $fname = htmlspecialchars($_POST['fname']);
    $lname = htmlspecialchars($_POST['lname']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $address1 = htmlspecialchars($_POST['address1']);
    $postcode = htmlspecialchars($_POST['postcode']);
    $bday = htmlspecialchars($_POST['bday']);
    $country = htmlspecialchars($_POST['country']);
    $gender = htmlspecialchars($_POST['gender']);

    // Use of prepared statement

    $query = "UPDATE users SET 
    uname =?,
    fname = ?,
    lname = ?,
    email = ?,
    phone = ?,
    address1 = ?,
    postcode = ?,
    bday = ?,
    country = ?,
    gender = ?
          WHERE id = {$id}";
    $stmti = $conn->prepare($query);
    $stmti->bind_param('ssssssssss', $uname, $fname, $lname, $email, $phone, $address1, $postcode, $bday, $country, $gender);
    $stmti->execute();
    $stmti->close();
    header('Location: #');
}

?>




<head>
    <title>Smile Slimes | Edit Profile</title>
</head>
<!-- Main -->
<div id="main">
    <div class="inner">
        <span class="image left"><img src="images/profileLogo.png" alt="profile logo" width="120" height="120" /></span>
        <h1>Hi, <br><?php echo $user['fname']; ?></h1>
        <!-- Code for profile -->
        <h3>Edit my account</h3>
        <div>
            <form method="POST" action="<?php $_SERVER['PHP_SELF']; ?>">
                <div class="row gtr-uniform">
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="fname" id="fname" value="<?php echo $user['fname']; ?>" placeholder="First Name" />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="lname" id="lname" value="<?php echo $user['lname']; ?>" placeholder="Last Name" />
                    </div>
                    <div class="col-12">
                        <input type="text" name="uname" id="uname" value="<?php echo $user['uname']; ?>" placeholder="Username" required />
                    </div>

                    <div class="col-12">
                        <input type="email" name="email" id="email" value="<?php echo $user['email']; ?>" placeholder="Email" required />
                    </div>
                    <div class="col-12">
                        <input type="tel" name="phone" id="phone" pattern="[0-9]+" title="number only" value="<?php echo $user['phone']; ?>" placeholder="Phone" />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="country" id="country" value="<?php echo $user['country']; ?>" placeholder="Country" />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="address1" id="address1" value="<?php echo $user['address1']; ?>" placeholder="Address" />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <input type="text" name="postcode" id="postcode" pattern="[0-9]+" title="number only" value="<?php echo $user['postcode']; ?>" placeholder="Postcode" />
                    </div>
                    <div class="col-6 col-12-xsmall">
                        <label>Birthday
                            <input type="date" id="bday" value="<?php echo $user['bday']; ?>" name="bday"></label>
                    </div>
                    <div class="col-6 col-12-small">
                        <input type="radio" id="female" name="gender" value="female" <?php if ($user['gender'] == 'female') {
                                                                                            echo "checked";
                                                                                        } ?>>
                        <label for="female">Female</label>
                    </div>

                    <div class="col-6 col-12-small">
                        <input type="radio" id="male" name="gender" value="male" <?php if ($user['gender'] == 'male') {
                                                                                        echo "checked";
                                                                                    } ?>>
                        <label for="male">Male</label>
                    </div>
                    <div class="col-12">
                        <ul class="actions">
                            <li><input type="submit" name="update" value="submit" class="primary" /></li>
                            <li><input type="reset" value="Reset" class="primary" /></li>
                            <li><input type="button" onclick="history.back()" value="Back to Account" /></li>
                        </ul>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php include('inc/footer.php'); ?>