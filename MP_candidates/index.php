<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>Candidates Zone</title>
  <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">

  
      <link rel="stylesheet" href="css/style.css">

      <link rel="stylesheet" href="css/snackbarcss.css">
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

  <div class="form">
      
      <ul class="tab-group">
        <li class="tab active"><a href="#add">Add Candidate</a></li>
        <li class="tab"><a href="#remove">Remove Candidate</a></li>
      </ul>
      
      <div class="tab-content">
        <div id="add">   
          
          <form action="" method="post">
          
            <div class="field-wrap">
              <label>
                UID<span class="req">*</span>
              </label>
              <input type="text" name="uid" pattern="(.){12,12}" title="please enter 12-digit aadhar number" maxlength="12" 
                          onkeypress="return restrictCharacters(this, event, digitsOnly);" required autofocus/> 
            </div>
          
          <div class="field-wrap">
            <label>
              Party/Symbol<span class="req">*</span>
            </label>
            <input type="text" name="party" required />
            
          </div>
          
          <div class="field-wrap">
            <label>
              Constituency<span class="req">*</span>
            </label>
            <input type="text" name="constituency" required />
          </div>
          
          <button type="submit" name="action" value="addc" class="button button-block"/>Add candidate</button>
          
          </form>

        </div>
        
        <div id="remove">   
          
          
          <form action="" method="post">
          
            <div class="field-wrap">
            <label>
              UID<span class="req">*</span>
            </label>
            <input type="text" name="uidr" pattern="(.){12,12}" title="please enter 12-digit aadhar number" maxlength="12" 
                          onkeypress="return restrictCharacters(this, event, digitsOnly);" required />
          </div>
          
         <div class="field-wrap">
            <label>
              Constituency<span class="req">*</span>
            </label>
            <input type="text" name="constr" required />
          </div> 
          
          
          <button type="submit" name="action" value="removec" class="button button-block"/>Remove Candidate</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
  <div id="snackbar">Some text some message..</div>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
 {
    if($_POST['action'] == 'addc'){
        
    
  $uid=$_POST["uid"];
  //$name=$_POST["name"];
  $party=$_POST["party"];
  $const=$_POST["constituency"];
  //echo " ".$uid." ".$name." ";
  if($uid <> NULL && $party <> NULL && $const <> NULL)
  { 
  	$db=mysqli_connect('localhost','root',null,'onlinevoting' );
            
		          if ($db->connect_error) 
		            {
			          die("Connection failed: " . $db->connect_error);
		            } 
                            
        $sql="select dob from aadhaar where uid='$uid'";
        if($result = mysqli_query($db, $sql))
                {
                $row= mysqli_fetch_array($result);
                $dobn = $row['dob'];
                if(validateAge($dobn, 25)){
                    
                    $query="select * from candidate where partyname='$party' and constituency='$const'";
                    if($result = mysqli_query($db, $query)){
                        if(mysqli_num_rows($result) == 0){
                            
                            $sql="insert into candidate values('$uid', '$party', '$const', NULL)";
                            if (mysqli_query($db, $sql) )
                            { 
                            echo "<script>myFunction('candidate added successfully')</script>";   
                                        
                            }
                            else
                            {      
                                //echo "There was an error .Try once again";
                                        //echo "Error: " . $sql . "<br>" . $db->error;
                                        echo "<script>myFunction('You are not a valid candidate')</script>";

                            }

                         
                        }else{
                        
                                echo "<script>myFunction('Only one candidate per party')</script>";
                        
                        }
                    }
                    
                       
                }else{
                    echo "<script>myFunction('min.  25 yrs required')</script>";   

                }
        }
        else{
            echo "<script>myFunction('You are not a valid candidate')</script>";
        }
	
		$db->close(); 
}
else
{
	echo "<script>myFunction('please enter all the details')</script>";

}

}

//removing candidate..
if($_POST['action'] == 'removec')
 {
  $ruid=$_POST["uidr"];
  $rconst = $_POST["constr"];
  if($ruid <> NULL && $rconst <> NULL)
  {
  	$db=mysqli_connect('localhost','root',null,'onlinevoting' );

		          if ($db->connect_error) 
		            {
			          die("Connection failed: " . $db->connect_error);
		            } 
	$sql="delete from candidate where uid='$ruid' and constituency='$rconst'";
        if (mysqli_query($db, $sql))
	{ 
            echo "<script>myFunction('Candidate removed successfully')</script>";
		
	}
	else
	{      
            echo "<script>myFunction('Candidate not found .Try once again')</script>";
		    
            
        }
		$db->close(); 
  }
  else
  {
  	echo "<script>myFunction('please enter UID and constituency')</script>";
	//header("Refresh:2;url=index.php");
  }
 }

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
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <script src="js/index.js"></script>
<script >
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

</body>
</html>
