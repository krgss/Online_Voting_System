<!DOCTYPE html>
<html lang="en">
<?php session_start(); 
$DispErr=""; ?>

<head>
  <title>Online Voting System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/snackbarcss.css">
	
	<style>
            .error {color: #FF0000;}

		body {
		 
		 background-image: url("map.gif");
		 background-repeat: no-repeat;
		 background-attachment: fixed;
		 background-position: center; 
		}
		h1{
		  text-align: center;
		}
		form{
		 text-align: center;
		  font-size: 20px;
		}
                input{
                    border:2px solid ;
                    margin: 10px;
                }
                label{
                    color: grey;
                }
                #finger{
                    display:none;
                }
        </style>

  


</head>
<body>
    <div class="jumbotron">
        <h1>Online Voting System</h1>
    </div>
    <div id='uid'>
    <form action="" method="post" >
        Enter UID number : <input type="text" name="uid" pattern="(.){12,12}" title="please enter 12-digit aadhar number" maxlength="12" 
                                  onkeypress="return onlynumbers(this, event, digitsOnly);" required autofocus/> 
        <span class="error"> <?php echo "$DispErr" ;?></span> <br>
        <input type="submit" name="submit" value="SUBMIT"/><br>
    </form>  
    </div>
    <div id="finger">
        <form action='match_finger.php' method='post' id="form">
            <label>Finger Print</label><br>
        <img id="imgFinger" width="145px" height="188px"/>
        <input type="textarea" id="txtIsoTemplate" name="fingeriso" hidden="TRUE">
        </form>
    </div>    
  <div id="snackbar">Some text some message..</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="js/inputcheck.js" /> </script>
<script src="jquery-1.8.2.js"></script>
<script src="mfs100-9.0.2.6.js"></script>
        
<script>
function myFunction(disp) {
    var x = document.getElementById("snackbar")
    x.className = "show";
    x.innerHTML = disp;
    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
}
	
	var quality = 60;
       	var timeout = 10;

function Capture() 
	{
            try {
                document.getElementById('imgFinger').src = "data:image/bmp;base64,";
                document.getElementById('txtIsoTemplate').value = "";
                var res = CaptureFinger(quality, timeout);
                if (res.httpStaus) 
                {
                    if (res.data.ErrorCode == "0") {
                        document.getElementById('imgFinger').src = "data:image/bmp;base64," + res.data.BitmapData;
                        document.getElementById('txtIsoTemplate').value = res.data.IsoTemplate;
                        document.getElementById("form").submit();
                    }
                }
                else {
                    alert(res.err);
                }
            }
            catch (e) {
                alert(e);
            }
            return false;
        }

</script>
   <?php 
	if($_SERVER['REQUEST_METHOD'] == 'POST')
	{
            $uid=test_input($_POST["uid"]);
            if(checkUsername($uid) ){         

                $db=mysqli_connect('localhost','root',null,'onlinevoting' );

                if ($db->connect_error){
		    die("Connection failed: " . $db->connect_error);
		} 
 	        $sql="SELECT * FROM aadhaar WHERE uid='$uid'"; 
                        
                $result=mysqli_query($db,$sql);
	        if($row = mysqli_fetch_array($result)){    
                    
                    $name=$row["name"];
                    $dob=$row["dob"];	
                    $pin=$row["pincode"];
                    
                    $sql2="select vstatus from voter where uid='$uid'";
                    $result2=mysqli_query($db,$sql2);
                    $row= mysqli_fetch_array($result2);
                    $votestatus=$row["vstatus"];

                    if($votestatus == 0){

                        if(validateAge($dob, 18)){
                            //go to next page & continue.
                            
                            $_SESSION['uid']=$uid;
                            $_SESSION['pin']=$pin;
                            $_SESSION['name']=$name;
                            
                            $sql="SELECT constituency FROM conpin WHERE pincode='$pin';"; 
                            $result=mysqli_query($db,$sql);
                            if($row = mysqli_fetch_array($result)){
                                
                                 $_SESSION['consti'] = $row['constituency'];
                                 
                                 //
                                 
                                 echo "<script>"
                                 . "document.getElementById('uid').style.display='none';"
                                 . "document.getElementById('finger').style.display='block';"
                                         . "Capture();"
                                         . "</script>";
                            
                            }else{
                                //no pincode
                                echo "<script>myFunction('no candidates in your zone')</script>";   

                            }
                            
                            //header('Location:homwaite.php');
                            //header('Location:sample.php');
                        }else{	
                             echo "<script>myFunction('You are not eligible to cast vote')</script>";   
                        }


                    }else{
                        echo "<script>myFunction('Your vote had already casted')</script>";
                        
                    }
                    
                }else{
                    echo "<script>myFunction('UID not found. Please try again')</script>";   
                }
                $db->close();
            }else{
                header('Location:security.php');
            }
	
	}

        function checkUsername($uid) {
            $uid = trim($uid);
            if (empty($uid)) {
                    echo "<script>myFunction('UID cannot be empty')</script>";   
                    false;
            }elseif (strlen($uid) != 12) {
                 echo "<script>myFunction('please enter 12 - digit UID.')</script>";   
                 return false;
            }elseif(!preg_match('/^[\d]{12}$/', $uid)){
                 echo "<script>myFunction('please enter a valid UID')</script>";   
                 return false;
            }
            return true;
        } 

        function test_input($luid) {
            return htmlspecialchars(stripslashes(trim($luid)));
        }
        
	function validateAge($birthday, $age)
	{
            // $birthday can be UNIX_TIMESTAMP or just a string-date.
            if(is_string($birthday)){
                $birthday = strtotime($birthday);
            }
	
            if(time() - $birthday < $age * 31536000){
                return false;
            }
		
            return true;
	}

?>
 
</body>
</html>
