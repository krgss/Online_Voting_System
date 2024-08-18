<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
$DispErr="";
?>
<head>
  <title>Online Voting System</title>
<h1><center>Admin Portal</center></h1>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/snackbarcss.css">
	<style>
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
                #finger{
                    display:none;
                }
	</style>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


<script type="text/javascript">
/* code from qodo.co.uk */
// create as many regular expressions here as you need:
var digitsOnly = /[1234567890]/g;
var integerOnly = /[0-9\.]/g;
var alphaOnly = /[A-Za-z]/g;

function restrictCharacters(myfield, e, restrictionType) {
    if (!e) var e = window.event
    if (e.keyCode) code = e.keyCode;
    else if (e.which) code = e.which;
    var character = String.fromCharCode(code);

    // if they pressed esc... remove focus from field...
    if (code==27) { this.blur(); return false; }
    
    // ignore if they are press other keys
    // strange because code: 39 is the down key AND ' key...
    // and DEL also equals .
    if (!e.ctrlKey && code!=9 && code!=8 && code!=36 && code!=37 && code!=38 && (code!=39 || (code==39 && character=="'")) && code!=40) {
        if (character.match(restrictionType)) {
            return true;
        } else {
            return false;
        }
        
    }
}
</script>

</head>
<body>
    <div class="jumbotron">
        <h1>Online Voting System</h1>
    </div>
    <div id='uid'>
    <form action="" method="post" >
        Enter UID number : <input type="text" name="uid" pattern="(.){12,12}" title="please enter 12-digit aadhar number" maxlength="12" 
                                  onkeypress="return onlynumbers(this, event, digitsOnly);" required autofocus/> 
        <span class="error"> <?php echo "$DispErr" ;?></span> <br><br>
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
  <div id="snackbar"></div>

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
		//echo "haha it works";
	
		     $_SESSION["uid"]=$_POST["uid"];
                     $uid=$_POST["uid"];
                      $db=mysqli_connect('localhost','root',null,'onlinevoting' );

                if ($db->connect_error){
		    die("Connection failed: " . $db->connect_error);
		} 
		     $sql="select uid from admin where uid='$uid'";
                     $result=mysqli_query($db,$sql);
                      $row = mysqli_fetch_array($result);
                      $uuid=$row['uid'];
                      if($uid === $uuid){
                          $sql1="select * from aadhaar where uid='$uid'";
                           $result1=mysqli_query($db,$sql1);
	        if($row1 = mysqli_fetch_array($result1)){    
                    
                    $_SESSION["name"]=$row1["name"];
                        echo "<script>"
                                 . "document.getElementById('uid').style.display='none';"
                                 . "document.getElementById('finger').style.display='block';"
                                         . "Capture();"
                                         . "</script>";
                    }
                           
        } else {
            echo "<script>myFunction('You are not a valid admin')</script>"; 
        }                           
                           
        }

	
	
	
?>
</html>
