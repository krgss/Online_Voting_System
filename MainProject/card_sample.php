<!DOCTYPE html>
<?php 
session_start();
if(!isset($_SESSION['uid'])){
    header('Location:index5.php');
}
?>
<html>
<head>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body{
        align-self: center;
        background-color:  gray;
        
    }
.card {
  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
  max-width: 25%;
  margin: 3%;
  font-family: arial;
  float: left;
  
  background-color: #ffffff;
}
table{
    width: 100%;
}
table .d{
    width: 60%;
    text-align: center;
}
.container {
  padding: 0 16px;
}

.container::after {
  content: "";
  clear: both;
  display: table;
}

.title {
  color: grey;
  font-size: 18px;
}

button {
  border: none;
  outline: 0;
  display: inline-block;
  padding: 8px;
  color: white;
  background-color: #000;
  text-align: center;
  cursor: pointer;
  width: 100%;
  font-size: 18px;
}

.candside{
	float:left;
        margin: 2.5%;
        width:45%;
        height:150px;
}
button:hover, a:hover {
  opacity: 0.7;
}
</style>
</head>
<body>

<?php

    $db=mysqli_connect('localhost','root',null,'onlinevoting' );
    if ($db->connect_error){
	die("Connection failed: " . $db->connect_error);
    } 
		     
    $candcon=$_SESSION['consti'];
    
    //$sql="select uid, name, party, ci from candidate where constituency='$candcon';";
    $sql="select uid, partyname from candidate where constituency='$candcon';";
    if($result = mysqli_query($db,$sql)){
        //add dynamically
        while($row = mysqli_fetch_array($result)) {
            $uid = $row['uid'];
           
            $pn = $row['partyname'];
            //$ci = $row['cimage'];
            $sql2="select name,image from aadhaar where uid='$uid'";
             $result1=mysqli_query($db,$sql2);
                            if($roww = mysqli_fetch_array($result1)){
                                
                                 $cn = $roww['name'];
                                 $ci = $roww['image'];
                            }
            
            $sq="select * from party where partyname='$pn';";
            //$query="select"
            if($res = mysqli_query($db, $sq)){
                if( $ro = mysqli_fetch_array($res))
                    $pi=$ro['partysymbol'];
                else{
                    $pi="default.png";
                }
            }else{
                $pi="default.png";
            }   
            
          echo "<div class='card'>
            <img class='candside' src='partyImages/$pi' alt='Party_Image' >
            <img class='candside' src='passport photo/$ci' alt='Candidate_Image' >
            <div class='container'>
              <table border='0'>
                <tr>
                    <td class='s'><b>Party:</b></td>
                    <td class='d'>$pn</td>
                </tr>
                <tr>
                    <td><b>Candidate:</b></td>
                    <td class='d'>$cn</td>
                </tr>    
              </table>
              <p><button id='$uid' onclick='updat($uid)' >Vote</button></p>
            </div>
          </div>";

    }
    }
    else{
        //if something went wrong..
        echo "";   
    }
    $db->close();
?>
    <script>
        function updat(uid){
          window.location.href = "last.php?uuid=" + uid; 
    }
    </script>
</body>
</html>
