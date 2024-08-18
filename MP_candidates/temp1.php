<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="css/snackbarcss.css">
        <style>
            table{
               /* align-content: center; */
                margin: 8% auto;
                align-content: center;
                background: #00264b;
                opacity: 0.9;
                padding: 10px;
            }
            td{
                color: whitesmoke;
                font-size: 20px;
            }
        </style>
    </head>
    <script>
         function myFunction(disp) {
                 var x = document.getElementById("snackbar");
                x.className = "show";
                x.innerHTML = disp;
                setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }
    </script>
<body>
<?php require_once 'menu.html';?>
<form action="" method="post" enctype="multipart/form-data">
    <table cellpadding="10">
    <tr>
    <td>Enter party name</td>
    <td><input type='text' name='partyname'></td>
    </tr>
    <tr>
    <td>Select image to upload</td>
    <td>
        <input type="file" name="fileToUpload" onchange="readURL(this);" id="fileToUpload"></td>
    </tr>
    <tr><td colspan="2" align="center"><img src="" id="imgPerson" width="145px" height="188px" alt="Your Image" /></td></tr>
    <tr><td colspan="2" align="center"><input type="submit" value="Upload Image" name="submit"></td></tr>
    </table>
</form>
 <div id="snackbar"></div>
</body>
<script>
function readURL(input) {
       if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                        document.getElementById('imgPerson').src = e.target.result;
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
    

</script>
</html>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
$target_dir = "../MainProject/partyImages/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "<script>myFunction('File is not an image.');</script>";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "<script>myFunction('Sorry, file already exists.');</script>";
    $uploadOk = 0;
}
/* Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "<script>myFunction('Sorry, your file is too large.');</script>";
    $uploadOk = 0;
}*/

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "<script>myFunction('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "<script>myFunction('Sorry, your file was not uploaded.');</script>";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
       // echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
                echo "<script>myFunction(' your file uploaded successfully');</script>";

    } else {
        echo "<script>myFunction('Sorry, there was an error uploading your file.');</script>";
    }
}

$db=mysqli_connect('localhost','root',null,'onlinevoting' );
    $img = $_FILES["fileToUpload"]["name"];
    $partyname=$_POST['partyname'];
    //echo "<img src='uploadss/$img' height='150px' width='300px' alt='$img'>";
        
                if ($db->connect_error){
		    die("Connection failed: " . $db->connect_error);
		} 
 	        $sql="insert into  party values ('$partyname','$img');"; 
                        
                $result=mysqli_query($db,$sql);
   
               // $sql="select partysymbol from party WHERE partyname='$partyname';"; 
                        
                //if($result=mysqli_query($db,$sql)){
                //    echo "true<br>";
                //} else {
                 //   echo 'false<br>';
                //}
    
                
    //while($row = mysqli_fetch_array($result)) {
      //   $r=$row["partysymbol"];
        // echo "<img src='uploads/$r' height='150px' width='300px' alt='$r'>";
        
    //}
}
?>