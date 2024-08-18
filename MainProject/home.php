<!DOCTYPE html>
<html lang="en">
<?php session_start(); ?>
<head>
  <title>Online Voting System</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <style>
        html, body { height: 100%; padding: 0; margin: 0; }
        div { width: 100%; height: 100%; float: left; }
        #perdetails { width: 20%; height: 100%; background: #AAA; }
        #canddetails { width: 80%; height: 100%; background: #777; 
        padding: 25px;}
        .perside{
            margin:5%;
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
<div id="perdetails">
    <img class="perside" src="download.png" align="left" height="200px" width="90%">
  <h2><b>Name</b></h2>
</div>
<div id="canddetails">
    <?php

    $db=mysqli_connect('localhost','root',null,'ovs' );
    if ($db->connect_error){
	die("Connection failed: " . $db->connect_error);
    } 
		     
    $candcon=$_SESSION['consti'];
    
    //$sql="select uid, name, party, ci from candidate where constituency='$candcon';";
    $sql="select uid, name, party from candidate where constituency='$candcon';";
    if($result = mysqli_query($db,$sql)){
        //add dynamically
        while($row = mysqli_fetch_array($result)) {
            $uid = $row['uid'];
            $cn = $row['name'];
            $pn = $row['party'];
            //$ci = $row['cimage'];
            
            $sq="select * from partyni where partyname='$pn';";
            if($res = mysqli_query($db, $sq)){
                if( $ro = mysqli_fetch_array($res))
                    $pi=$ro['symbol'];
                else{
                    $pi="default.png";
                }
            }else{
                $pi="default.png";
            }   
            
          echo "<div class='card'>
            <img class='candside' src='partyImages/$pi' alt='Party_Image' >
            <img class='candside' src='partyImages/$pi' alt='Candidate_Image' >
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

    
</div>
</body>

</html>
<script>
    function updat(uid){
          window.location.href = "last.php?uuid=" + uid; 
    }
$(function(){
    

    $('button[name=button]').click(function(){
        var id= $(this).attr("id");
        //some action here
        //ex:
//        alert("C Name = "+id);
        //or an ajax fungtion
          window.location.href = "last.php?uuid=" + id; 

    });
});
</script>