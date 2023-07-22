<?php
//Admin add new product + upload img to the server
require_once('config/config.php');
include_once('config/db.php');

$Msg = '';

// File upload path
$targetDir = "images/";
$Image = basename($_FILES["fileToUpload"]["name"]);
$targetFilePath = $targetDir . $Image;
$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
$pname =htmlspecialchars($_POST['Pname']);
$psize =htmlspecialchars( $_POST['Psize']);
$pprice = htmlspecialchars((int)$_POST['Price']);
$pamount =htmlspecialchars( $_POST['Amount']);
$pdesc = htmlspecialchars($_POST['Pdesc']);



if(isset($_POST["submit"]) && !empty($_FILES["fileToUpload"]["name"])){
    // Allow certain file formats
    $allowTypes = array('jpg','png','jpeg','gif');
    if(in_array($fileType, $allowTypes)){
        // Upload file to server
        // Check if file already exists
      if (!file_exists($targetFilePath)) {

        if(move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $targetFilePath)){
            // Insert image file name into database + with product details
            $insert_query = "INSERT INTO products(pname, psize, price, pdesc, img, stock) VALUES(?,?,?,?,?,?)"; 
            $stmti = $conn->prepare($insert_query);
            $stmti->bind_param('ssdssi',$pname, $psize, $pprice, $pdesc, $Image ,$pamount);
            $stmti->execute();
            if($stmti){
                $Msg = "The file (".$Image. ") has been uploaded successfully.";
            }else{
                $Msg = "File upload failed, please try again.";
            } 
        }else{
            $Msg = "Sorry, there was an error uploading your file.";
        }
    
        }else{
            $Msg = 'Sorry, The file already exist. Try to change file name.';
        }
        
    }else{
        $Msg = 'Sorry, only JPG, JPEG, PNG, GIF files are allowed to upload.';
    }
}else{
    $Msg = 'Please select a file to upload.';
}

// Display message
echo $Msg;
echo '<a href="AdminPage.php">Go Back</a>';
